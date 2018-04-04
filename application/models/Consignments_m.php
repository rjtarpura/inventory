<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consignments_m extends CI_Model {

	private $table	=	"consignments";

	public function __construct(){
		parent::__construct();
	}

	public function add($parent,$child){
		
		$this->db->trans_start();
		
		$rs = $this->db->insert($this->table,$parent);
		$consignment_id = ($rs)?$this->db->insert_id():null;
		
		$consignment_details = array();		

		foreach($child as $k=>$v){

			$consignment_details[$k]["consignment_id"] = $consignment_id;
			$consignment_details[$k]["product_id"] = $v[0];
			$consignment_details[$k]["tag_name"] = $v[1];
			$consignment_details[$k]["quantity"] = $v[2];			
		}

		$this->db->insert_batch("consignments_detail",$consignment_details);

		foreach($consignment_details as $k=>$arr){
		
		$this->db->select('quantity');
		$this->db->where("product_id = {$arr['product_id']} and tag_name = '{$arr['tag_name']}'");
		$rs = $this->db->get('stock');
		$quantity = array('quantity'=>$arr['quantity']+$rs->row_array()['quantity']);

		$this->db->update("stock",$quantity,"product_id = {$arr['product_id']} and tag_name = '{$arr['tag_name']}'");
		}

		$this->db->trans_complete();		
		return $this->db->trans_status();
	}

	public function get_consignment_quantity($where){
		// $query	= "SELECT
		// 			`products`.`sku_id`,`products`.`name`,SUM(`consignments_detail`.`quantity`) AS `quantity`
		// 			FROM `consignments_detail`
		// 			LEFT JOIN `products` ON `products`.`product_id` = `consignments_detail`.`product_id`";
		// $query	.=	($where)?" WHERE ".$where:'';
		// $query 	.= " GROUP BY `consignments_detail`.`product_id`";

		$query	= "SELECT
					`products`.`sku_id`,`products`.`name`,`consignments_detail`.`tag_name`,`consignments_detail`.`quantity`
					FROM `consignments_detail`
					LEFT JOIN `products` ON `products`.`product_id` = `consignments_detail`.`product_id`";
		$query	.=	($where)?" WHERE ".$where:'';
		$query 	.= " ORDER BY `consignments_detail`.`product_id` ASC, `consignments_detail`.`tag_name` ASC";

		$rs = $this->db->query($query);
		return ($rs)?$rs->result_array():array();
	}
}