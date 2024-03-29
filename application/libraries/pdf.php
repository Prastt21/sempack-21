<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
require_once APPPATH . 'third_party/tcpdf/tcpdf' . EXT;

class Pdf extends TCPDF {

    function __construct() {
        parent::__construct();
    }

    public function Header() {
        $this->SetFont('times', 'B', 12);
        // Title
        $this->Cell(0, 8, 'SEKOLAH TINGGI MANAJEMEN INFORMATIKA DAN KOMPUTER', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->ln(4);
        $this->SetFont('times', '', 12);
        $this->Cell(0, 8, 'AMIKOM', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->ln(4);
        $this->Cell(0, 8, 'YOGYAKARTA', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('times', 'B', 10);
        $this->ln(4);
        $this->Cell(0, 8, 'BIDANG KEMAHASISWAAN', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('times', '', 10);
        $this->ln(3);
        $this->Cell(0, 8, 'Jl. Ring Road Utara Condong Catur, Depok, Sleman, Yogyakarta 551283 telp (0274) 88283 ', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        
    }

}

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */
?>
