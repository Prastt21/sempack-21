<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class laporan_beasiswa extends operator_base {

    public function __construct() {
        parent::__construct();
        //load model
        $this->load->model('m_laporan_beasiswa');
    }

    public function index() {
        //control hak akses read
        $this->_set_page_role('r');
        //load model
        $this->load->model('m_laporan_beasiswa');
        $this->m_laporan_beasiswa->ambil_laporan_beasiswa();
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
        $pencarian_laporan_beasiswa = $this->session->userdata('cari_laporan_beasiswa');
        //get tahun beasiswa
        $data['tahun'] = $this->m_laporan_beasiswa->get_tahun_beasiswa();
        $data['bulan_skr'] = $pencarian_laporan_beasiswa['bulan'] != '' ? $pencarian_laporan_beasiswa['bulan'] : date('m');
        $data['tahun_skr'] = $pencarian_laporan_beasiswa['tahun'] != '' ? $pencarian_laporan_beasiswa['tahun'] : date('Y');
        $parameter = array($data['bulan_skr'], $data['tahun_skr']);
        //get total pembelian bulan sebelumnya
        $data['result_total'] = $this->m_laporan_beasiswa->get_total_beasiswa($parameter);
        parent::display('tampil_laporan_beasiswa', $data);
    }

    function cari_data() {
        if ($this->input->post() == '')
            redirect('laporan_beasiswa');
        if ($this->input->post('cari') == 'reset') {
            $this->session->unset_userdata('cari_laporan_beasiswa');
        } else {
            $parameter = array(
                'bulan' => $this->input->post('bulan'),
                'tahun' => $this->input->post('tahun')
            );
            $this->session->set_userdata('cari_laporan_beasiswa', $parameter);
        }
        redirect('laporan_beasiswa');
    }

    function download() {
        $this->load->model('m_laporan_beasiswa');
        $rs_laporan_beasiswa->$this->m_laporan_beasiswa->ambil_laporan_beasiswa($id);
        //load our new PHPExcel library
        $this->load->library('excel');
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('LAPORAN PENDAFTARAN BEASISWA');

        $this->excel->getActiveSheet()->setCellValue('B8', 'NO');
        $this->excel->getActiveSheet()->setCellValue('C8', 'JENIS BEASISWA');
        $this->excel->getActiveSheet()->setCellValue('D8', 'NAMA PENDAFTAR');
        $this->excel->getActiveSheet()->setCellValue('E8', 'JURUSAN');
        $this->excel->getActiveSheet()->setCellValue('F8', 'JENJANG');
        $this->excel->getActiveSheet()->setCellValue('G8', 'ALAMAT SEKARANG');
        $this->excel->getActiveSheet()->setCellValue('H8', 'PERGURUAN TINGGI');
        $this->excel->getActiveSheet()->setCellValue('I8', 'SEMESTER');
        $this->excel->getActiveSheet()->setCellValue('J8', 'IPK');
        $this->excel->getActiveSheet()->setCellValue('K8', 'PRESTASI');
        $this->excel->getActiveSheet()->setCellValue('L8', 'ALASAN');
        $this->excel->getActiveSheet()->setCellValue('M8', 'NAMA BANK');
        $this->excel->getActiveSheet()->setCellValue('N8', 'NO REKENING');
        $this->excel->getActiveSheet()->setCellValue('O8', 'TANGGAL DAFTAR');
        $this->excel->getActiveSheet()->setCellValue('P8', 'STATUS BEASISWA');

        if (isset($rs_laporan_asuransi)) {
            $a = isset($awal) ? $awal : 0;
            foreach ($rs_laporan_asuransi as $dt_laporan_asuransi):
                $this->excel->getActiveSheet()->setCellValue('B' . ++$a);
                $this->excel->getActiveSheet()->setCellValue('C' . $dt_laporan_asuransi['Jenis_Beasiswa']);
                $this->excel->getActiveSheet()->setCellValue('D' . $dt_laporan_asuransi['Nama_Pengguna']);
                $this->excel->getActiveSheet()->setCellValue('E' . $dt_laporan_asuransi['Jurusan']);
                $this->excel->getActiveSheet()->setCellValue('F' . $dt_laporan_asuransi['Jenjang']);
                $this->excel->getActiveSheet()->setCellValue('G' . $dt_laporan_asuransi['Alamat_Sekarang']);
                $this->excel->getActiveSheet()->setCellValue('H' . $dt_laporan_asuransi['Perguruan Tinggi']);
                $this->excel->getActiveSheet()->setCellValue('I' . $dt_laporan_asuransi['Semester']);
                $this->excel->getActiveSheet()->setCellValue('J' . $dt_laporan_asuransi['IPK']);
                $this->excel->getActiveSheet()->setCellValue('K' . $dt_laporan_asuransi['Prestasi']);
                $this->excel->getActiveSheet()->setCellValue('L' . $dt_laporan_asuransi['Alasan']);
                $this->excel->getActiveSheet()->setCellValue('M' . $dt_laporan_asuransi['BANK']);
                $this->excel->getActiveSheet()->setCellValue('N' . $dt_laporan_asuransi['No_Rekening']);
                $this->excel->getActiveSheet()->setCellValue('O' . $dt_laporan_asuransi['Tanggal_Daftar']);
                $this->excel->getActiveSheet()->setCellValue('P' . $dt_laporan_asuransi['Status_Beasiswa']);
            endforeach;
        }

        $filename = 'Laporan Beasiswa.xlsx'; //save our workbook as this file name
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