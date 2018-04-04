<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$index_page = $this->config->item('index_page');
		$base_url	=	($index_page)?base_url().$index_page.'/':base_url();

		$product_photo = 'assets/public/images/products/';
		$qr_code = 'assets/public/qr/';

		$this->product_image_url	=	$base_url.$product_photo;
		$this->qr_image_url		=	$base_url.$qr_code;

		$this->status_code		=	200;	//OK
		$this->status_msg		=	'OK';
		$this->data				=	array();
	}

	public function identify_product(){
		
		$identifier		=	$this->input->get('identifier');

		$sku_id			=	'';
		$febric			=	'';
		$tag			=	'';
		$consignment_id	=	'';
		$name			=	'';

		$result = array();

		if($identifier){
			$identifier_arr = explode('-',$identifier);
			$sku_id			=	$identifier_arr[0].'-'.$identifier_arr[1];
			$febric			=	$identifier_arr[1];
			$tag			=	substr($identifier_arr[2],0,2);
			$consignment_id	=	substr($identifier_arr[2],2,1);

			// echo "Identifier ",$identifier,"<br/>","<pre>";print_r($identifier_arr);
			// echo "sku_id ",$sku_id,"<br/>","febric ",$febric,"<br/>","tag ",$tag,"<br/>","consignment_id ",$consignment_id,"<br/>";exit;
			
			$rs = $this->model->get_product_for_api($sku_id,$tag,$consignment_id);

			if($rs){
				$rs = $rs[0];
				$data['product_name']	=	$rs['name'];				
				$data['product_febric']	=	$this->model->get_febric_array()["$febric"];			
				$data['product_tag']	=	$this->model->get_tag_array()["$tag"];
				$data['product_photo']	=	$this->product_image_url.$rs['photo'];
				$data['product_stock']	=	$rs['quantity'];

				$data['consignment_id']	=	$consignment_id;
				$data['consignment_date']	=	$rs['consignment_date'];
				$data['vendor_name']	=	$rs['vendor_name'];				

				$result['error']	=	FALSE;
				$result['message']	=	"Product Found";
				$result['data']		=	$data;

			}else{
				$result['error']	=	TRUE;
				$result['message']	=	"Product not Found";
				$result['data']		=	array();
			}

		}else{

			$this->status_code	=	400;$this->status_msg	=	"Bad Request";

			$result['error']	=	TRUE;
			$result['message']	=	"Invalid Request";
			$result['data']		=	array();
		}

		$this->serve_client($result);
	}

	public function place_order(){

		$identifier		=	$this->input->get('identifier');
		$order_quantity	=	$this->input->get('quantity');

		//get client details
		
		$sku_id			=	'';
		$tag			=	'';
		
		$result = array();

		if($identifier && $order_quantity){

			$identifier_arr = explode('-',$identifier);
			$sku_id			=	$identifier_arr[0].'-'.$identifier_arr[1];
			$tag			=	substr($identifier_arr[2],0,2);

			$rs = $this->model->get_product_for_api($sku_id,$tag);

			if($rs){
				$available_stock	=	$rs[0]['quantity'];

				$new_stock = $available_stock-$order_quantity;
				
				if($new_stock >=0){
					// add client details
					// add order and order details master data
					// add update stock table
					// $this->status_code	=	201;$this->status_msg	=	"Created";
				}else{
					$result['error']	=	TRUE;
					$result['message']	=	"Insufficient Stock";
					$result['data']		=	array("product_stock"=>$available_stock);
				}
			}else{

				$this->status_code	=	500;$this->status_msg	=	"Internal Server Error";
				
				$result['error']	=	TRUE;
				$result['message']	=	"Internal Server Error";
				$result['data']		=	array();
			}
		}else{

			$this->status_code	=	400;$this->status_msg	=	"Bad Request";

			$result['error']	=	TRUE;
			$result['message']	=	"Invalid Request";
			$result['data']		=	array();
		}

		$this->serve_client($result);
	}

	public function serve_client($content){

		// echo "<pre>";print_r($result);exit;
		header("Content-Type : application/json");
		header("HTTP/1.1 $this->status_code $this->status_msg");
		echo json_encode($content);

	}
}