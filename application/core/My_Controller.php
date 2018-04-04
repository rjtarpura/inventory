<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
	
	protected $data = array();
	protected $sess_name = '_sess_dashee';
	private $allowed_uri = array(			
								"login",
								"login/index",
								"login/login",
								"login/logout",
								"login/forgot",
								"api/identify_product"
								);
	private $website_settings = array();

	public function __construct(){

		parent::__construct();

		// Load necessary models and libraries here.
			$this->lang->load('custom_messages', 'english');

		// Configurable Variables
			$product_photo = 'assets/public/images/products/';
			$qr_code = 'assets/public/qr/';

		// Set App Specific variables

			$project_root_folder_name = pathinfo($this->config->item('base_url'), PATHINFO_BASENAME).'/';
			
			$index_page = $this->config->item('index_page');
			$base_url	=	($index_page)?base_url().$index_page.'/':base_url();

			$this->data['base_url'] = $base_url;

			$this->data['public_assets_url']	=	$base_url.'assets/public/plugins/';				
			$this->data['product_no_image_url']	=	$base_url.'assets/public/avtars/no-product.png';
			
			
			$this->data['server_root_url']		=	$_SERVER['DOCUMENT_ROOT'].$project_root_folder_name;
			
			$this->product_image_fs_url			=	$_SERVER['DOCUMENT_ROOT'].$project_root_folder_name.$product_photo;
			$this->data['product_image_fs_url']	=	$this->product_image_fs_url;
			$this->data['product_image_url']	=	$base_url.$product_photo;
			
			$this->qr_image_fs_url				=	$_SERVER['DOCUMENT_ROOT'].$project_root_folder_name.$qr_code;
			$this->data['qr_image_fs_url']		=	$this->qr_image_fs_url;
			$this->data['qr_image_url']			=	$base_url.$qr_code;

			$this->data['themes']				=	$this->get_theme_array();
			$this->data['theme_primary_colors']	=	$this->get_theme_primary_color();
			$this->data['module']				=	$this->router->fetch_class();
			$this->data['current_page_url']		=	$this->router->fetch_class()."/".$this->router->fetch_method();

			// $this->data['CI']					=	&get_instance();
			
		if($this->session->_settings){

			$this->website_settings = $this->session->_settings;

		}else{

			$rs = $this->set_settings();			

			if(!$rs){
				show_error("Website settings are not defined",404,"Settings Missing");
			}
			$this->website_settings = $rs;
		}

		$this->data['js_variables']	=	json_encode(

							array(
								'notification_display_duration_ms'=> intval($this->session->_settings['notification_display_duration_ms']),
								'allowed_file_extensions'=> $this->session->_settings['allowed_file_extensions'],
								'file_upload_size_bytes'=> intval($this->session->_settings['file_upload_size_bytes']),
								'autologout'=> ($this->session->_settings['autologout'] == AUTOLOGOUT_ON)?true:false,
								'autologout_mins'=> intval($this->session->_settings['autologout_mins']),
								'profile_pic_extensions' => $this->session->_settings['profile_pic_extensions'],
								'profile_pic_size_bytes' => intval($this->session->_settings['profile_pic_size_bytes'])
							)
						);


		// if(!in_array(uri_string(), $this->allowed_uri)) {
		if($this->uri->segment(1) != "login"){

			if(!$this->model->is_loged_in()){

				redirect("login");

			}else{

				$current_timestamp = strtotime(date('Y-m-d h:i:s'));

				if($this->session->_settings['autologout'] == AUTOLOGOUT_ON){

					$time = ($this->session->_settings['autologout_mins'])?$this->session->_settings['autologout_mins']:AUTOLOGOUT_MINS_DEFAULT;

					if($current_timestamp - $this->session->_last_login > $time*60){	//Seconds
						$this->model->logout();
					}

					$this->session->set_userdata("_last_login", strtotime(date('Y-m-d h:i:s')));
				}

				$this->user_id_sess = $this->session->_user_session["user_id"];
				$this->user_role_sess = $this->session->_user_session["role"];
				$this->data['user_role_sess'] = $this->user_role_sess;
				$this->data['user_id_sess'] = $this->user_id_sess;
				$this->data['febric_array']			=	$this->model->get_febric_array();
				$this->data['tag_array']			=	$this->model->get_tag_array();
				$this->data['current_theme']		=	$this->session->_settings['theme_name'];
				$this->data['current_theme_primary_color']		=	$this->session->_settings['theme_primary_color'];

				if(!$this->uri->segment(1)){
					redirect($this->get_home_page());
				}
			}
		}
	}

	public function load_view($sub_view,$layout=null){
		if($sub_view){
			if($layout){
				$this->data['sub_view'] = $sub_view;
				$this->load->view($layout,$this->data);
			}else{
				$module = $this->data['module'].'/';
				$this->data['sub_view'] = $module.$sub_view;
				$this->load->view('layouts/layout',$this->data);
			}			
		}
	}

	protected function is_admin(){
		return ($this->user_role_sess == ADMIN)?true:false;
	}

	// public function get_febric_array(){
	// 	$febric_arr = [];
	// 	$febric_list = explode('|',$this->session->_settings['febrics']);
	// 	foreach($febric_list as $fl){
	// 		$f = explode("-",$fl);
	// 		$febric_arr["$f[1]"] = $f[0];			
	// 	}
	// 	return $febric_arr;
	// }

	// public function get_tag_array(){
	// 	$tag_arr = [];
	// 	$tag_list = explode('|',$this->session->_settings['tags']);
	// 	foreach($tag_list as $k=>$tl){
	// 		$t = explode("-",$tl);
	// 		$tag_arr["$t[1]"] = $t[0];				
	// 	}
	// 	return $tag_arr;
	// }

	public function get_theme_array(){		
		return array(
			'theme-1-active'	=>	'Theme 1',
			'theme-2-active'	=>	'Theme 2',
			'theme-3-active'	=>	'Theme 3',
			'theme-4-active'	=>	'Theme 4',
			'theme-5-active'	=>	'Theme 5',
			'theme-6-active'	=>	'Theme 6',
		);
	}

	public function get_theme_primary_color(){
		return array(
			'pimary-color-red'		=>	'Red',
			'pimary-color-blue'		=>	'Blue',
			'pimary-color-green'	=>	'Green',
			'pimary-color-yellow'	=>	'Yellow',
			'pimary-color-pink'		=>	'Pink',
			'pimary-color-orange'	=>	'Orange',
			'pimary-color-gold'		=>	'Gold',
			'pimary-color-silver'	=>	'Silver',
		);
	}

	public function set_settings(){
		$rs = $this->model->get("settings");
		if($rs){
			$this->session->set_userdata("_settings",$rs[0]);
			return $rs[0];
		}else{
			return false;
		}
		
	}

	public function get_home_page(){
		return 'products/listing';
	}

	public function debug($var=NULL,$die=1){
		echo "<pre>";
		print_r($var);
		echo "</pre>";
		
		if($die){
			exit;
		}
	}
}