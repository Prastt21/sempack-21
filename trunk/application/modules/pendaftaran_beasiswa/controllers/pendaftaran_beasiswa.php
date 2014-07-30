<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class pendaftaran_beasiswa extends operator_base {

    public function __construct() {
        parent::__construct();
    }

    var $batas = 15;

    function index($offset = 0) {
        $this->_set_page_role('r');
        $this->load->model('m_pendaftaran_beasiswa');
         //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');
        //load form validation
        $this->load->library('form_validation');
        //get data jenis beasiswa
        $data['rs_jenis_beasiswa'] = $this->m_pendaftaran_beasiswa->ambil_jenis_beasiswa();
        //get data jurusan
        $data['rs_jurusan'] = $this->m_pendaftaran_beasiswa->ambil_jurusan();
        parent::display('tambah_pendaftaran_beasiswa', $data);
    }

    function tambah_pendaftaran_beasiswa() {
        $this->_set_page_role('c');
        //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');
        //load form validation
        $this->load->library('form_validation');
        //load model
        $this->load->model('m_pendaftaran_beasiswa');
        //get data jenis beasiswa
        $data['rs_jenis_beasiswa'] = $this->m_pendaftaran_beasiswa->ambil_jenis_beasiswa();
        //get data jurusan
        $data['rs_jurusan'] = $this->m_pendaftaran_beasiswa->ambil_jurusan();
        parent::display('tambah_pendaftaran_beasiswa', $data);
    }

    function proses_tambah_pendaftaran_beasiswa() {
        if ($this->input->post('simpan') == null)
            redirect('pendaftaran_beasiswa');
        //load library form validation
        $this->load->library('form_validation');
        //set validasi form
        $this->form_validation->set_rules('jenis_beasiswa', 'Jenis Beasiswa', 'required|trim');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required|trim');
        $this->form_validation->set_rules('jenjang', 'Jenjang', 'required|trim');
        $this->form_validation->set_rules('alamat_sekarang', 'Alamat Sekarang', 'required|trim');
        $this->form_validation->set_rules('nama_pt', 'Nama Pergururan Tinggi', 'required|trim');
        $this->form_validation->set_rules('semester', 'Semester', 'required|trim');
        $this->form_validation->set_rules('ipk', 'IPK', 'required|trim');
        $this->form_validation->set_rules('prestasi', 'Prestasi', 'required|trim');
        $this->form_validation->set_rules('alasan', 'Alasan', 'required|trim');
        $this->form_validation->set_rules('bank', 'Bank', 'required|trim');
        $this->form_validation->set_rules('no_rekening', 'No Rekening', 'required|trim');
        $this->form_validation->set_rules('tanggal_daftar', 'Tanggal Daftar', 'required|trim');
        //$this->form_validation->set_rules('status_beasiswa', 'Status Beasiswa', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            //set notifikasi
            $this->notification('error', validation_errors());
            //simpan data yang sudah diisi
            $this->form_validation->keep_data();
            redirect('pendaftaran_beasiswa/tambah_pendaftaran_beasiswa');
        } else {
            $this->load->model('m_pendaftaran_beasiswa');
            $parameter = array(
                $this->input->post('jenis_beasiswa'),
                $this->sesi->get_data_login('ID_PENGGUNA'),
                $this->input->post('jurusan'),
                $this->input->post('jenjang'),
                $this->input->post('alamat_sekarang'),
                $this->input->post('nama_pt'),
                $this->input->post('semester'),
                $this->input->post('ipk'),
                $this->input->post('prestasi'),
                $this->input->post('alasan'),
                $this->input->post('bank'),
                $this->input->post('no_rekening'),
                $this->input->post('tanggal_daftar'),
                $this->input->post('status_beasiswa')
            );
            if ($this->m_pendaftaran_beasiswa->tambah_pendaftaran_beasiswa($parameter)) {
                //set notifikasi berhasil
                $this->notification('success', 'Data berhasil ditambahkan');
            } else {
                //set notifikasi gagal
                $this->notification('error', 'Data gagal ditambahkan');
            }
            redirect('pendaftaran_beasiswa');
        }
    }
}