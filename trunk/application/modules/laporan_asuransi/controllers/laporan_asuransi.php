<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class laporan_asuransi extends operator_base {

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
    function download_laporan_asuransi($param) {
        $this->load->library('excel');
    }
    
    function cetak_laporan_asuransi($param) {
        //load our new PHPExcel library
        $this->load->library('pdf');
    }

}