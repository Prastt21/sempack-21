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
        $this->Cell(0, 8, 'KEMENTERIAN KESEHATAN REPUBLIK INDONESIA', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->ln(4);
        $this->SetFont('times', '', 12);
        $this->Cell(0, 8, 'DIREKTORAT JENDERAL PENGENDALIAN PENYAKIT DAN PENYELAMATAN LINGKUNGAN', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->ln(4);
        $this->Cell(0, 8, 'LABORATORIUM PENGUJI DAN KALIBRASI', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('times', 'B', 10);
        $this->ln(4);
        $this->Cell(0, 8, 'BALAI BESAR TEKNIK KESEHATAN LINGKUNGAN DAN PENGENDALIAN PENYAKIT YOGYAKARTA', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('times', '', 10);
        $this->ln(3);
        $this->Cell(0, 8, 'Jl. Wonosari KM 7, Wiyoro Lor No. 21, Baturetno, Banguntapan, Bantul, Yogyakarta 551597 telp (0274) 371588 ', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        
    }

}

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */
?>
