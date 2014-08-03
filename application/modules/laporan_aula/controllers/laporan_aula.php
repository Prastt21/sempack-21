<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class laporan_aula extends operator_base {

    public function __construct() {
        parent::__construct();
        //load model
        $this->load->model('m_laporan_aula');
    }

    public function index() {
        //control hak akses read
        $this->_set_page_role('r');
        //load model
        $this->load->model('m_laporan_aula');
        $this->m_laporan_aula->ambil_laporan_aula();
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
        $pencarian_laporan_aula = $this->session->userdata('cari_laporan_aula');
        //get tahun asuransi
        $data['tahun'] = $this->m_laporan_aula->get_tahun_aula();
        $data['bulan_skr'] = $pencarian_laporan_aula['bulan'] != '' ? $pencarian_laporan_aula['bulan'] : date('m');
        $data['tahun_skr'] = $pencarian_laporan_aula['tahun'] != '' ? $pencarian_laporan_aula['tahun'] : date('Y');
        $parameter = array($data['bulan_skr'], $data['tahun_skr']);
        //get total pembelian bulan sebelumnya
        $data['result_total'] = $this->m_laporan_aula->get_total_aula($parameter);
        parent::display('tampil_laporan_aula', $data);
    }

    function cari_data() {
        if ($this->input->post() == '')
            redirect('laporan_aula');
        if ($this->input->post('cari') == 'reset') {
            $this->session->unset_userdata('cari_laporan_aula');
        } else {
            $parameter = array(
                'bulan' => $this->input->post('bulan'),
                'tahun' => $this->input->post('tahun')
            );
            $this->session->set_userdata('cari_laporan_aula', $parameter);
        }
        redirect('laporan_aula');
    }

    function download() {
        $this->load->model('m_laporan_aula');
        $rs_laporan_aula->$this->m_laporan_aula->ambil_laporan_aula($id);
        //load our new PHPExcel library
        $this->load->library('excel');
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('LAPORAN PEMINJAMAN AULA BSC');

        $this->excel->getActiveSheet()->setCellValue('B8', 'NO');
        $this->excel->getActiveSheet()->setCellValue('C8', 'NAMA PEMINJAM');
        $this->excel->getActiveSheet()->setCellValue('D8', 'NAMA KEGIATAN');
        $this->excel->getActiveSheet()->setCellValue('E8', 'KETUA ORGANISASI');
        $this->excel->getActiveSheet()->setCellValue('F8', 'PESERTA');
        $this->excel->getActiveSheet()->setCellValue('G8', 'JUMLAH PESERTA');
        $this->excel->getActiveSheet()->setCellValue('H8', 'TANGGAL DAFTAR');
        $this->excel->getActiveSheet()->setCellValue('I8', 'TANGGAL PINJAM');
        $this->excel->getActiveSheet()->setCellValue('J8', 'WAKTU PINJAM');
        $this->excel->getActiveSheet()->setCellValue('K8', 'TANGGAL SELESAI');
        $this->excel->getActiveSheet()->setCellValue('L8', 'WAKTU SELESAI');
        $this->excel->getActiveSheet()->setCellValue('M8', 'STATUS PEMINJAMAN');

        if (isset($rs_laporan_aula)) {
            $a = isset($awal) ? $awal : 0;
            foreach ($rs_laporan_aula as $dt_laporan_aula):
                $this->excel->getActiveSheet()->setCellValue('B' . ++$a);
                $this->excel->getActiveSheet()->setCellValue('C' . $dt_laporan_aula['Nama_Pengguna']);
                $this->excel->getActiveSheet()->setCellValue('D' . $dt_laporan_aula['Nama_Kegiatan']);
                $this->excel->getActiveSheet()->setCellValue('E' . $dt_laporan_aula['Ketua_Orma']);
                $this->excel->getActiveSheet()->setCellValue('F' . $dt_laporan_aula['Peserta']);
                $this->excel->getActiveSheet()->setCellValue('G' . $dt_laporan_aula['Jml_Peserta']);
                $this->excel->getActiveSheet()->setCellValue('H' . $dt_laporan_aula['Tanggal_Daftar']);
                $this->excel->getActiveSheet()->setCellValue('I' . $dt_laporan_aula['Tanggal_Pinjam']);
                $this->excel->getActiveSheet()->setCellValue('J' . $dt_laporan_aula['Waktu_Pinjam']);
                $this->excel->getActiveSheet()->setCellValue('K' . $dt_laporan_aula['Tanggal_Selesai']);
                $this->excel->getActiveSheet()->setCellValue('L' . $dt_laporan_aula['Waktu_Selesai']);
                $this->excel->getActiveSheet()->setCellValue('M' . $dt_laporan_aula['Status_Penggunaan']);
            endforeach;
        }

        $filename = 'Laporan Peminjaman Aula.xlsx'; //save our workbook as this file name
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