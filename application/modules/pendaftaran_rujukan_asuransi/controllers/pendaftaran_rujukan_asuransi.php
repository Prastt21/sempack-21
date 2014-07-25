<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class pendaftaran_rujukan_asuransi extends operator_base {

    var $batas = 15;

    public function index($offset = 0) {
        //control hak akses read
        $this->_set_page_role('r');
        //load model
        $this->load->model('m_pendaftaran_rujukan_asuransi');        
        //load library
        parent::display('tambah_pendaftaran_rujukan_asuransi');
    }

    function tambah_pendaftaran_rujukan_asuransi() {
        //control hak akses create
        $this->_set_page_role('c');
        $this->load->library('Form_validation');
        //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');
        parent::display('tambah_pendaftaran_rujukan_asuransi');
    }

    function proses_tambah_pendaftaran_rujukan_asuransi() {
        //validasi tombol simpan, jika tidak ditekan maka redirect ke tampilan tambah informasi
        if ($this->input->post('simpan') == null)
            redirect('pendaftaran_rujukan_asuransi/tambah_pendaftaran_rujukan_asuransi');
        //load form validation
        $this->load->library('Form_validation');
        //set aturan validasi
            $this->form_validation->set_rules('jenis_asuransi', 'Jenis Asuransi', 'required|trim');
           // $this->form_validation->set_rules('nama_perujuk', 'Nama Perujuk', 'required|trim');
            $this->form_validation->set_rules('nama_rs', 'Nama Rumah Sakit', 'required|trim');
            $this->form_validation->set_rules('alamat_rs', 'Alamat Rumah Sakit', 'required|trim');
            $this->form_validation->set_rules('kronologi', 'Kronologi', 'required|trim');
            $this->form_validation->set_rules('tanggal_daftar', 'Tanggal Daftar', 'required|trim');
            $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required|trim');
            $this->form_validation->set_rules('tanggal_keluar', 'Tanggal Keluar', 'required|trim');
            $this->form_validation->set_rules('total_biaya', 'Total Biaya', 'required|trim');
            //$this->form_validation->set_rules('santunan', 'Santunan', 'required|trim');
            //$this->form_validation->set_rules('status_asuransi', 'Status Asuransi', 'required|trim');            
        //menjalankan validasi
        if ($this->form_validation->run() === FALSE) {
            //jika validasi ada yang eror, kirim notifikasi ke view
            $this->notification('error', validation_errors());
            $this->form_validation->keep_data();
            //redirect ke tampilan tambah data informasi
            redirect('pendaftaran_rujukan_asuransi/tambah_pendaftaran_rujukan_asuransi');
        } else {
            //load model
            $this->load->model('m_pendaftaran_rujukan_asuransi');
            //set parameter array
            $parameter = array(
                
                $this->input->post('jenis_asuransi'),
                $this->sesi->get_data_login('ID_PENGGUNA'),
                $this->input->post('nama_rs'),
                $this->input->post('alamat_rs'),
                $this->input->post('kronologi'),
                $this->input->post('tanggal_daftar'),
                $this->input->post('tanggal_masuk'),
                $this->input->post('tanggal_keluar'),
                $this->input->post('total_biaya'),
                $this->input->post('santunan'),
                $this->input->post('status_asuransi')
            );
            if ($this->m_pendaftaran_rujukan_asuransi->tambah_pendaftaran_rujukan_asuransi($parameter)) {
                //jika sukses kirim pesan ke view
                $this->notification('success', 'Rujukan Asuransi berhasil ditambahkan');
            } else {
                //jika gagal kirim pesan ke view
                $this->notification('error', 'Rujukan Asuransi gagal ditambahkan');
            }
        }
        //redirect ke list informasi
        redirect('pendaftaran_rujukan_asuransi');
    }
}