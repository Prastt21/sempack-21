<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class laporan_asuransi extends operator_base {

    public function __construct() {
        parent::__construct();
        //load model
        $this->load->model('m_laporan_asuransi');
    }
    var $batas = 15;

    public function index($offset = 0) {
        //control hak akses read
        $this->_set_page_role('r');
        //load model
        $this->load->model('m_laporan_asuransi');
        //set data bulan
        $data['bulan'] = array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        );
        $pencarian_laporan_asuransi = $this->session->userdata('cari_laporan_asuransi');
        //get tahun asuransi
        $data['tahun'] = $this->m_laporan_asuransi->get_tahun_asuransi();
        $data['bulan_skr'] = $pencarian_laporan_asuransi['bulan'] != '' ? $pencarian_laporan_asuransi['bulan'] : date('m');
        $data['tahun_skr'] = $pencarian_laporan_asuransi['tahun'] != '' ? $pencarian_laporan_asuransi['tahun'] : date('Y');
        $parameter = array($data['bulan_skr'], $data['tahun_skr']);
        //get total pembelian bulan sebelumnya
        $data['result_total'] = $this->m_laporan_asuransi->get_total_asuransi($parameter);       
        parent::display('tampil_laporan_asuransi', $data);
    }
    function cari_data() {
        if ($this->input->post() == '')
            redirect('laporan_asuransi');
        if ($this->input->post('cari') == 'reset') {
            $this->session->unset_userdata('cari_laporan_asuransi');
        } else {
            $parameter = array(
                'bulan' => $this->input->post('bulan'),
                'tahun' => $this->input->post('tahun')
            );
            $this->session->set_userdata('cari_laporan_asuransi', $parameter);
        }
        redirect('laporan_asuransi');
    }
    function download($param) {
       //load our new PHPExcel library
        $this->load->library('excel');
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('test worksheet');

        $this->excel->getActiveSheet()->setCellValue('A1', 'Januari');
        $this->excel->getActiveSheet()->setCellValue('B1', '2010');
        $this->excel->getActiveSheet()->setCellValue('A3', 'No');
        $this->excel->getActiveSheet()->setCellValue('B3', 'Transaksi');
        $this->excel->getActiveSheet()->setCellValue('D3', 'Nominal');
        $this->excel->getActiveSheet()->setCellValue('E3', 'Jumlah');

        $saldo = 10500600;
        $pendapatan = 2000000;
        $pendapatan_bulan_ini = 0;
        $b = 5;

        $this->excel->getActiveSheet()->setCellValue('B4', 'Saldo Bulan Lalu');
        $this->excel->getActiveSheet()->setCellValue('E4', $saldo);

        for ($a = 1; $a < 31; $a++):
            $saldo += $pendapatan;
            $pendapatan_bulan_ini += $pendapatan;
            $this->excel->getActiveSheet()->setCellValue('A' . $b, $a);
            $this->excel->getActiveSheet()->setCellValue('B' . $b, 'Transaksi' . $a);
            $this->excel->getActiveSheet()->setCellValue('D' . $b, $pendapatan);
            $this->excel->getActiveSheet()->setCellValue('E' . $b, $saldo);
            $b++;
            $this->excel->getActiveSheet()->setCellValue('B35', 'Pendapatan Bulan Ini');
            $this->excel->getActiveSheet()->setCellValue('D35', $pendapatan_bulan_ini);
            $this->excel->getActiveSheet()->setCellValue('E35', $saldo);
        endfor;

        $filename = 'Laporan Asuransi.xlsx'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }
    
    function cetak($param) {
        //load our new PHPExcel library
        $this->load->library('pdf');
    }

}