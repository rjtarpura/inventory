<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_m extends CI_Model {

	private $table	=	"products";

	public function __construct(){
		parent::__construct();
	}

	public function add($parent,$child){

		$this->db->trans_start();
		
		$rs = $this->db->insert($this->table,$parent);
		$product_id = ($rs)?$this->db->insert_id():null;
		
		$child_arr= array();
		foreach($child as $k=>$v){
			$child_arr[$k]['product_id'] = $product_id;
			$child_arr[$k]['tag_name'] = $v['tag_name'];
			$child_arr[$k]['quantity'] = $v['quantity'];			
			$child_arr[$k]['status'] = $v['status'];
		}		
		// echo "<pre>";print_r($child_arr);exit;

		$this->db->insert_batch("stock",$child_arr);

		$this->db->trans_complete();		
		return $this->db->trans_status();
	}

	public function get_stock(){
		$query = "SELECT
					`products`.*,GROUP_CONCAT(`stock`.`tag_name`,' - ',`stock`.`quantity`) AS `quantities`
					FROM `products`
					LEFT JOIN `stock` ON `products`.`product_id` = `stock`.`product_id`
					GROUP BY `products`.`product_id`
					ORDER BY `products`.`sku_id` ASC, `stock`.`tag_name` ASC";
		$rs = $this->db->query($query);

		return ($rs)?$rs->result_array():array();
	}
}