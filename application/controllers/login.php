<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends My_Controller {
	
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->load->view('layouts/login',$this->data);
	}
	
	public function login(){
		$username	=	$this->input->post('username');
		$password	=	$this->input->post('password');
		
		$user		=	$this->model->login($username,$password);	// Blank array if user not found
		
		if(!$user){
			redirect('login');
		}
		
		$this->session->set_userdata("_user_session", $user[0]);
		$this->session->set_userdata("_last_login", strtotime(date('Y-m-d h:i:s')));
		
		redirect($this->get_home_page());
	}
	
	public function logout(){
		$this->model->logout();
	}
	
	public function hash_password($password){
		return hash($this->hash_algo,$password.$this->hash_key);		//md5($password);
	}

	public function forgot($reset_hash=NULL){

		if(!$reset_hash){

			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

			if($this->input->server('REQUEST_METHOD') == 'POST' ){	//ajax request
				if($this->form_validation->run() == TRUE )
				{
					$email		= $this->input->post('email');
					$login_details = $this->model->get("users","email = '$email'");
					
					if($login_details){
						$login_details = $login_details[0];
						// $rs = $this->model->get("settings");
						// if($rs){
							$sender_details = $this->session->_settings;	//$rs[0];
						
							//email configuration
							$config = array(
							'protocol'		=>		'smtp',
							'smtp_host'		=>		'ssl://smtp.googlemail.com',
							'smtp_port'		=>		'465',
							'smtp_timeout'	=>		'7',
							'smtp_user'		=>		"{$sender_details['smtp_email']}",
							'smtp_pass'		=>		"{$sender_details['smtp_pass']}",
							'charset'		=>		'utf-8',
							'newline'		=>		"\r\n",
							'send_multipart'	=>	false,
							'mailtype'		=>		'html', // or html
							'validation'	=>		TRUE // bool whether to validate email or not  
							);

							$this->load->library('email',$config);
						
							//setting up and sending email
							// $from_email = $this->
							$this->email->from("{$sender_details['smtp_email']}", "{$sender_details['email_alias']}");
							$this->email->to($login_details['email']);

							$hash = $this->model->hash_password($login_details['user_id'].$login_details['username'].$login_details['password'].mt_rand());
							$message	=	"<h3>Here is the link to reset your password</h3>";
							// $message     .=  "<p>OTP  :  $hash</p>";
							$message	.=	"<p><b><a href=\"".base_url('index.php/login/forgot/').$hash."\">Password reset link</a></b></p>";
							
							$this->email->subject("Login Details of {$sender_details['email_alias']}");
							$this->email->message($message);

							$status = $this->email->send();
							
							if($status){
								if($this->model->update("users",array("reset_hash"=>$hash),"email = '$email'")){
									echo json_encode(array("status"=>'success', "message"=>"Password reset link send to your email"));
								}else{	//Error while updating table (database error)
									echo json_encode(array("status"=>'error', "message"=>"Internal Error - #001"));
								}
							}else{	//Error while sending email.
								echo json_encode(array("status"=>'error', "message"=>"Internal Error - #002"));
							}					
						// }else{	//Error if no data present in setting table
						// 	echo json_encode(array("status"=>'error', "message"=>"Internal Error - #003"));
						// }
					}else{	//Error if no recored found with this email in users table
						echo json_encode(array("status"=>'error', "message"=>"This email is not registered"));
					}
					
				}else{	//Form Validation Error
					echo json_encode($this->form_validation->error_array());
				}
			}else{
				$this->session->set_flashdata("error","Bad Request #001");
				redirect('login');
			}
		}else{	// If reset_hast not provided

			$user_details = $this->model->get("users","reset_hash = '$reset_hash'");

			if($user_details){

				$user_details = $user_details[0];

				if($this->input->server('REQUEST_METHOD') == 'POST' ){

					$this->form_validation->set_rules('password', 'Password', 'required');
					$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|matches[password]');

					if($this->form_validation->run() == TRUE ){
						
						$password = $this->model->hash_password($this->input->post("password"));

						if($this->model->update("users",array("reset_hash" => NULL,"password"=> $password),"email = '{$user_details['email']}'")){
							
							$this->session->set_flashdata("success","Password Reset Successfully");
							redirect('login');

						}else{	//Error while updating table (database error)

							$this->session->set_flashdata("error","Internal Error - #011, Please try after sosme time");
							redirect('login');

						}
					}else{	//Form Validation Error						
						$this->data['reset_hash'] = $reset_hash;
						$this->load->view("components/reset_password",$this->data);						
					}
				}else{
					$this->data['reset_hash'] = $reset_hash;
					$this->load->view("components/reset_password",$this->data);
				}
			}else{	//Error if no recored found with this reset_hash in users table
				$this->session->set_flashdata("error","Invalid reset link");
				redirect('login');
			}			
		}
	}

}
