<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Labels extends My_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('consignments_m');
		include APPPATH.'third_party/phpqrcode/qrlib.php';
	}

	public function generate(){
		// $this->debug($_POST,0);
		$details = $this->input->post("details");
		
		// details =array(
		// 				[0]	=>	'sku_id-tag_name-'
		// 				[1]	=>	'quantity'
		// 			)

		$consignment_id =$this->input->post("consignment_id");

		$qr_list = array();

		foreach($details as $k=>$arr){
			$ec_level = "H";	//L,M,Q,H
			$zoom_factor = 4;	//Pixel or Zoom Factor (Default:3) 1 to 10
			$frame_size = 2;	//Fram around QR Code (Default:4)

			$content = $arr[0];	//.'~'.$consignment_id;	//sku_id~consignment_id

			$qr_code_file = md5($content).'.png';
			$qr_file_name = $this->qr_image_fs_url.$qr_code_file;

			// if(!file_exists($qr_file_name)){
				QRcode::png($content,$qr_file_name,$ec_level,$zoom_factor,$frame_size);
			// }
			for($i=1;$i<=$arr[1];$i++){
				array_push($qr_list,array("sku_id"=>$content,"file_name"=>$qr_code_file));
			}
		}
		
		$this->data['label_data'] = $qr_list;		
		// $this->debug($this->data['label_data']);
		// QRcode::png("data to qr","test.png", "H");
		// QRcode::png("Data","file_name","QR EC LEVEL (L,M,Q,H)",Pixel or Zoom Factor 1 to 10 (default 3),Fram Size (default 4)

		// Image Size (px) = (Pixels per Module) × (Module Size + 8)
		// OR
		// (Zoom Factor * (17+8=25))+ (Fram Size * Zoom Factor * 2)
		
		$this->load->view('labels/consignments_label_print',$this->data);
		// $this->load_view('consignments_label_print');
	}

	public function consignment_label(){

		// redirect("api/identify_product?identifier=SPS-PS-WI1");exit;
		
		$this->data["vendors"]		=	$this->model->get("vendors");
		$this->load_view('consignments_label');
	}

}