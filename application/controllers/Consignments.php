<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consignments extends My_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('consignments_m');
	}

	public function add(){
		
		$this->data["products"]		=	$this->model->get("products");
		$this->data["vendors"]		=	$this->model->get("vendors");
		
		if($this->input->server('REQUEST_METHOD') == "POST"){
			// $this->debug($_POST);
			$this->form_validation->set_rules($this->get_consignment_validation_rule());
			
			if($this->form_validation->run() === true){
				$data["vendor_id"]	=	$this->input->post("vendor_id");
				$data["consignment_date"]	=	$this->input->post("consignment_date");
				$details	=	$this->input->post("details");
			}

			$rs = $this->consignments_m->add($data,$details);			

			if($rs){
				$this->session->set_flashdata("success",$this->lang->line('consignment_add_success'));

			}else{
				$this->session->set_flashdata("error",$this->lang->line('consignment_add_error'));
			}
			redirect('consignments/add');
		}
		$this->load_view('consignments_add');
	}

	public function get_consignment_validation_rule(){
		return	array(
						array(
									"field"	=>	"vendor_id",
									"label"	=>	"Vendor",
									"rules"	=>	"required"
							),
						array(
									'field'	=>	'consignment_date',
									'label'	=>	'Consignment Date',
									'rules'	=>	'required'
							)
					);
	}

	public function ajax_get_consignments(){

		$vendor_id = $this->input->post('vendor_id');
		$consignment_date = $this->input->post('consignment_date');

		$data = $this->model->getField("consignments","consignment_id","vendor_id = $vendor_id AND consignment_date = '$consignment_date'");
		if($data){
			echo json_encode($data);
		}else{
			echo json_encode(false);
		}
	}

	public function ajax_get_consignments_detail(){

		$consignment_id = $this->input->post('consignment_id');

		$data = $this->consignments_m->get_consignment_quantity("consignment_id = $consignment_id");
		if($data){
			foreach($data as $k=>$arr){
				$data[$k]['tag_full_name'] = $this->data['tag_array']["{$arr['tag_name']}"];				
			}
			echo json_encode($data);
		}else{
			echo json_encode(false);
		}
	}
}