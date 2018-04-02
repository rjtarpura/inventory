<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends My_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('products_m');
	}

	public function listing(){
		$this->data["products"]		=	$this->products_m->get_stock("products");
		// $this->debug($this->data["products"]);
		$this->load_view('products_listing');
	}

	public function add($product_id=NULL){
			
		if($product_id){

			$editing_product	=	$this->model->get("products","product_id = $product_id");
			$editing_product	=	($editing_product)?$editing_product[0]:array();
			$this->data['editing_product'] = $editing_product;
		}

		if($this->input->server('REQUEST_METHOD') == "POST"){
			
			// $this->debug($_POST,0);

			$validation_rules = array();
			if($product_id){
				$validation_rules = $this->get_product_validation_rule_edit();
			}else{
				$validation_rules = $this->get_product_validation_rule_add();
			}
			
			
			$this->form_validation->set_rules($validation_rules);
			
			if($this->form_validation->run() === true){
				$child = array();

				$dataToAdd["name"]	=	$this->input->post("name");
				$dataToAdd["status"]=	$this->input->post("status");				
				
				if(!$product_id){
					$dataToAdd["sku"]	=	$this->input->post("sku");				
					$dataToAdd["febric"]=	$this->input->post("febric");				
					$dataToAdd["sku_id"]=	$this->input->post("sku_id");

					foreach($this->data['tag_array'] as $k=>$t){
						$child["$k"]["quantity"]	=	($this->input->post("$t"))?$this->input->post("$t"):0;
						$child["$k"]["tag_name"]	=	$t;
						$child["$k"]["status"]	=	ACTIVE;
					}
				}

				// $this->debug($child);

				$uploadElement		=	"photo";
				if($_FILES[$uploadElement]['name'] !=''){
					$stat = $this->model->upload_single_file($uploadElement,true,$this->product_image_fs_url);

					if($stat["errorCount"] ==0){
						
						$dataToAdd["photo"] = $stat['success'][0]['file_name'];

						if($product_id){
							$rs2		=	$this->model->update("products",$dataToAdd,"product_id = $product_id");
							if($rs2){
								$this->session->set_flashdata("success",$this->lang->line('product_update_success'));
								redirect('products/listing');
							}else{								
								unlink($this->product_image_fs_url.$dataToAdd["photo"]);
								$this->session->set_flashdata("error",$this->lang->line('product_update_error'));
							}
						}else{
							$rs2	=	$this->products_m->add($dataToAdd,$child);
							if($rs2){
								$this->session->set_flashdata("success",$this->lang->line('product_add_success'));
								redirect('products/listing');					
							}else{
								unlink($this->product_image_fs_url.$dataToAdd["photo"]);
								$this->session->set_flashdata("error",$this->lang->line('product_add_error'));
							}
						}
					}else{
						$fileErrorArray			=	array_column($stat["error"],"errorMsg","file_name");
						$this->session->set_flashdata("fileerror",$fileErrorArray);
					}
				}else{

					if($product_id){
						$rs2		=	$this->model->update("products",$dataToAdd,"product_id = $product_id");
						if($rs2){
							$this->session->set_flashdata("success",$this->lang->line('product_update_success'));
							redirect('products/listing');
						}else{
						
							$this->session->set_flashdata("error",$this->lang->line('product_update_error'));			
						}
					}else{
						$rs2	=	$this->products_m->add($dataToAdd,$child);
						if($rs2){
							$this->session->set_flashdata("success",$this->lang->line('product_add_success'));
							redirect('products/listing');					
						}else{
						
							$this->session->set_flashdata("error",$this->lang->line('product_add_error'));
						}
					}
				}
				
			}else{
				// $this->debug($_POST,0);
				// $this->debug($this->form_validation->error_array());
			}
		}
		$this->load_view('products_add');
	}

	public function get_product_validation_rule_add(){
		return	array(
						array(
									"field"	=>	"sku",
									"label"	=>	"SKU",
									"rules"	=>	"required"
							),
						array(
									'field'	=>	'name',
									'label'	=>	'Product Name',
									'rules'	=>	'required'
							),
						array(
									'field'	=>	'febric',
									'label'	=>	'Febric',
									'rules'	=>	'required'
							),
						array(
									'field'	=>	'status',
									'label'	=>	'Status',
									'rules'	=>	'required'
							)
					);
	}
	public function get_product_validation_rule_edit(){
		return	array(
						array(
									'field'	=>	'name',
									'label'	=>	'Product Name',
									'rules'	=>	'required'
							),
						array(
									'field'	=>	'status',
									'label'	=>	'Status',
									'rules'	=>	'required'
							)
					);
	}
}
