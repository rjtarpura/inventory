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
			$frame_size = 3;	//Fram around QR Code (Default:4)

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
		
		// $this->load->view('labels/consignments_label_print2',$this->data);
		$this->print_label($qr_list);
		// $this->load_view('consignments_label_print');
	}

	public function consignment_label(){

		// redirect("api/identify_product?identifier=SPS-PS-WI1");exit;
		
		$this->data["vendors"]		=	$this->model->get("vendors");
		$this->load_view('consignments_label');
	}

	public function print_label($data){

		// $this->debug($data,0);
		// require_once (realpath('tcpdf/tcpdf.php'));

		include APPPATH.'third_party/tcpdf/tcpdf.php';

		// create new PDF document
		$orientation = 'L';
		$pdf = new TCPDF($orientation, 'pt', 'A4', true, 'UTF-8', false);

		// remove default header/footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		// $pdf->SetFooterMargin(5.08);

		//set default monospaced font
		$pdf->SetDefaultMonospacedFont('courier');

		// set margins
		$left_margin = 36;
		$right_margin = $left_margin;
		$top_margin = 15;
		$bottom_margin = $top_margin;	
		$pdf->SetMargins($left_margin, $top_margin, $right_margin,true);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, $bottom_margin);

		// set font
		$pdf->SetFontSize(7);

		// set image scale factor
		$pdf->setImageScale(1.25);

		// add a page
		$pdf->AddPage();

		$vertical_pitch = 9;

		$horizontal_label_count = 13;
		$each_width = ($pdf->getPageWidth()-($left_margin+$right_margin))/$horizontal_label_count;
		$vertical_label_count = 5;
		$each_height = (($pdf->getPageHeight()-($top_margin+$bottom_margin+(4 * $vertical_pitch)) )/$vertical_label_count)+0.199;		//adjustment in hight;

		$total_elements = count($data);
		$rows = floor($total_elements/$horizontal_label_count);
		$cols = $total_elements-($rows*$horizontal_label_count);		
		$txt = "<table border=\"0\">";

		$lbl_start	=	0;
		// $skip_rows	=	ceil($lbl_start/$horizontal_label_count);

		// $each_height += ($skip_rows)?($skip_rows*3):0;

		for($i=0;$i<$total_elements;){
			$txt .= "<tr>";
			for($j=1;$j<=$horizontal_label_count && $i<$total_elements;$j++){

					$sku_arr	=	explode("{}",chunk_split($data[$i]['sku_id'],7,"<br/>{}"));
					$p_str		=	'';

					for($x=0;$x<count($sku_arr)-1;$x++){
						$p_str .= $sku_arr[$x];
					}

					$p_str = substr($p_str,0,strlen($p_str)-5);


					$style = "width:{$each_width}pt;height:{$each_height}pt;";
					$img_style = "width:".($each_width-15)."pt;";
					$p_style = "text-align:center;font-size:10px;vertical-align:center;";
					$pitch_style = "height:{$vertical_pitch}pt;";

					// $style .= "border: 1px dashed black;";
					if($i%2==0){
						$style .= "background-color:gray;";
					}else{
						$style .= "background-color:pink;";
					}
					$pitch_style .= "background-color:pink;";

					if($lbl_start==0){
						$txt .= "<td style=\"$style\">
									<table border=\"0\" align=\"center\">
									<tr>
										<td>DESHEE</td>
									</tr>
									<tr>
										<td>
											<img src=\"".$this->data['qr_image_url'].$data["$i"]["file_name"]."\" style=\"$img_style\"/>
										</td>
									</tr>
									<tr>
										<td></td>
									</tr>
									<tr>
										<td>
											<p style=\"$p_style\">".$p_str."</p>
										</td>
									</tr>
									</table>
								</td>";
								$i++;
					}else{
						$txt .= "<td style=\"$style\"></td>";
						$lbl_start--;
					}					
			}

			$txt .= "</tr>";

			if(! ( $i % $vertical_label_count == 0 ) ){				
				$txt .= "<tr style=\"pitch_style\"><td colspan=\"$horizontal_label_count\"></td></tr>";
			}
		}
		$txt .= "</table>";		

		$pdf->WriteHTML($txt, false, false, false, false, 'L');
		$pdf->Output('example_001.pdf', 'I');
	}
}