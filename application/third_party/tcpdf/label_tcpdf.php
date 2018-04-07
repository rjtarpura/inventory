<?php
include "tcpdf.php";

class label_tcpdf extends TCPDF {
	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-09.08);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
		// $this->SetX(-50);
		// $this->Cell(0, 10, 'Date '.date('d-m-Y'), 0, false, 'L', 0, '', 0, false, 'T', 'M');
	}
}