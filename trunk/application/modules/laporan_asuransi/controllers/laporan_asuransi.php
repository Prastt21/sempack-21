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

    public function index() {
        //control hak akses read
        $this->_set_page_role('r');
        //load model
        $this->load->model('m_laporan_asuransi');
        $this->m_laporan_asuransi->ambil_laporan_asuransi();
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

    function download() {
        $this->load->model('m_laporan_asuransi');
        $rs_laporan_asuransi->$this->m_laporan_asuransi->ambil_laporan_asuransi($id);
        //load our new PHPExcel library
        $this->load->library('excel');
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('LAPORAN RUJUKAN ASURANSI');

        $this->excel->getActiveSheet()->setCellValue('B8', 'NO');
        $this->excel->getActiveSheet()->setCellValue('C8', 'JENIS ASURANSI');
        $this->excel->getActiveSheet()->setCellValue('D8', 'NAMA PERUJUK');
        $this->excel->getActiveSheet()->setCellValue('E8', 'NAMA RUMAH SAKIT');
        $this->excel->getActiveSheet()->setCellValue('F8', 'ALAMAT RUMAH SAKIT');
        $this->excel->getActiveSheet()->setCellValue('G8', 'KRONOLOGI');
        $this->excel->getActiveSheet()->setCellValue('H8', 'TANGGAL DAFTAR');
        $this->excel->getActiveSheet()->setCellValue('I8', 'TANGGAL MASUK');
        $this->excel->getActiveSheet()->setCellValue('J8', 'TANGGAL KELUAR');
        $this->excel->getActiveSheet()->setCellValue('K8', 'TOTAL BIAYA');
        $this->excel->getActiveSheet()->setCellValue('L8', 'SANTUNAN');
        $this->excel->getActiveSheet()->setCellValue('M8', 'STATUS ASURANSI');

        if (isset($rs_laporan_asuransi)) {
            $a = isset($awal) ? $awal : 0;
            foreach ($rs_laporan_asuransi as $dt_laporan_asuransi):
                $this->excel->getActiveSheet()->setCellValue('B' . ++$a);
                $this->excel->getActiveSheet()->setCellValue('C' . $dt_laporan_asuransi['Jenis_Asuransi']);
                $this->excel->getActiveSheet()->setCellValue('D' . $dt_laporan_asuransi['NAMA_PENGGUNA']);
                $this->excel->getActiveSheet()->setCellValue('E' . $dt_laporan_asuransi['Nama_RS']);
                $this->excel->getActiveSheet()->setCellValue('F' . $dt_laporan_asuransi['Alamat_RS']);
                $this->excel->getActiveSheet()->setCellValue('G' . $dt_laporan_asuransi['Kronologi']);
                $this->excel->getActiveSheet()->setCellValue('H' . $dt_laporan_asuransi['Tanggal_Daftar']);
                $this->excel->getActiveSheet()->setCellValue('I' . $dt_laporan_asuransi['Tanggal_Masuk']);
                $this->excel->getActiveSheet()->setCellValue('J' . $dt_laporan_asuransi['Tanggal_Keluar']);
                $this->excel->getActiveSheet()->setCellValue('K' . $dt_laporan_asuransi['Total_Biaya']);
                $this->excel->getActiveSheet()->setCellValue('L' . $dt_laporan_asuransi['Santunan']);
                $this->excel->getActiveSheet()->setCellValue('M' . $dt_laporan_asuransi['Status_Asuransi']);
            endforeach;
        }

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