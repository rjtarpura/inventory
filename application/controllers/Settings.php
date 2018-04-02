<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends My_Controller {
	
	public function __construct(){
		parent::__construct();
	}

	public function ajax_update(){
		$field_name = $this->input->post('field_name');
		$value		= $this->input->post('value');
		if($this->model->update("settings",array("$field_name"=>"$value"),"1=1")){			
			$this->set_settings();
			echo json_encode(true);
		}else{
			echo json_encode(false);
		}		
	}
}
