<?php
include "tcpdf.php";

class label_tcpdf extends TCPDF {
	// Page footer

	private $footer_msg_left = '';

	public function Header() {
		// Position at 15 mm from bottom
		$this->SetY(4);
		// Set font
		$this->SetFont('helvetica', 'I', 7);
		
		$this->Cell(0, 10, $this->footer_msg_left.' { Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages().' }', 0, false, 'L', 0, '', 0, false, 'T', 'M');
		// $this->SetX(-80);
		// $this->Cell(0, 10,$this->footer_msg_left, 0, false, 'L', 0, '', 0, false, 'T', 'M');
	}

	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-12);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

		$this->SetX(-80);
		$this->Cell(0, 10,'Date '.date('d-m-Y'), 0, false, 'L', 0, '', 0, false, 'T', 'M');
	}

	public function set_footer_string($msg){
		$this->footer_msg_left = $msg;
	}
}