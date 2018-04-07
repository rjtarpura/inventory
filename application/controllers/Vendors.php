<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendors extends My_Controller {
	
	public function __construct(){
		parent::__construct();
	}

	public function listing(){
		echo 'a';exit;
		// $this->debug($this->data["products"]);
		$this->load_view('products_listing');
	}

	public function add($product_id=NULL){
			
		if($this->input->server('REQUEST_METHOD') == "POST"){
			$this->debug($_POST);
		}

		$this->load_view('vendors_add');
	}
}