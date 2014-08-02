<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class pendaftaran_peminjaman_aula extends operator_base {

    var $batas = 15;

    public function index($offset = 0) {
        //control hak akses read
        $this->_set_page_role('r');
        //load model
        $this->load->model('m_pendaftaran_peminjaman_aula');
        //load library
        $this->load->library('bagi_halaman');
        $this->load->library('Form_validation');
        //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');
        parent::display('tambah_pendaftaran_peminjaman_aula');
    }

    function tambah_pendaftaran_peminjaman_aula() {
        //control hak akses create
        $this->_set_page_role('c');
        $this->load->library('Form_validation');
        //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');
        parent::display('tambah_pendaftaran_peminjaman_aula');
    }

    function proses_tambah_pendaftaran_peminjaman_aula() {
        //validasi tombol simpan, jika tidak ditekan maka redirect ke tampilan tambah informasi
        if ($this->input->post('simpan') == null)
            redirect('pendaftaran_peminjaman_aula/tambah_pendaftaran_peminjaman_aula');
        //load form validation
        $this->load->library('Form_validation');
        //set aturan validasi
            //$this->form_validation->set_rules('nama_peminjam', 'Nama Peminjam', 'required|trim');
            $this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required|trim');
            $this->form_validation->set_rules('ketua_organisasi', 'Ketua Organisasi', 'required|trim');
            $this->form_validation->set_rules('peserta', 'Peserta', 'required|trim');
            $this->form_validation->set_rules('jml_peserta', 'Jumlah Peserta', 'required|trim');
            $this->form_validation->set_rules('tanggal_daftar', 'Tanggal Daftar', 'required|trim');
            $this->form_validation->set_rules('tanggal_pinjam', 'Tanggal Pinjam', 'required|trim');
            $this->form_validation->set_rules('waktu_pinjam', 'Waktu Pinjam', 'required|trim');
            $this->form_validation->set_rules('tanggal_selesai', 'Tanggal Selesai', 'required|trim');
            $this->form_validation->set_rules('waktu_selesai', 'Waktu Selesai', 'required|trim');
            //$this->form_validation->set_rules('status_penggunaan', 'Status Penggunaan', 'required|trim');           
        //menjalankan validasi
        if ($this->form_validation->run() === FALSE) {
            //jika validasi ada yang eror, kirim notifikasi ke view
            $this->notification('error', validation_errors());
            $this->form_validation->keep_data();
            //redirect ke tampilan tambah data informasi
            redirect('pendaftaran_peminjaman_aula/tambah_pendaftaran_peminjaman_aula');
        } else {
            //load model
            $this->load->model('m_pendaftaran_peminjaman_aula');
            //set parameter array
            $parameter = array(
                $this->sesi->get_data_login('ID_PENGGUNA'),
                $this->input->post('nama_kegiatan'),
                $this->input->post('ketua_organisasi'),
                $this->input->post('peserta'),
                $this->input->post('jml_peserta'),
                $this->input->post('tanggal_daftar'),
                $this->input->post('tanggal_pinjam'),
                $this->input->post('waktu_pinjam'),
                $this->input->post('tanggal_selesai'),
                $this->input->post('waktu_selesai'),
                $this->input->post('status_penggunaan')
            );
            if ($this->m_pendaftaran_peminjaman_aula->cek_pendaftaran_aula_by_tglPinjam($parameter)) {
                //jika sukses kirim pesan ke view
                if ($this->m_pendaftaran_peminjaman_aula->tambah_pendaftaran_peminjaman_aula($parameter)) {
                    //jika sukses kirim pesan ke view
                    $this->notification('success', 'Peminjaman Aula berhasil ditambahkan');
                } else {
                    //jika gagal kirim pesan ke view
                    $this->notification('error', 'Peminjaman Aula gagal ditambahkan');
                }
            } else {
                //jika gagal kirim pesan ke view
                $this->notification('error', 'Tanggal Dan Waktu Pinjam Sudah Digunakan, 
                                    Silahkan Ganti Tanggal Dan Waktu Pinjam');                
            }            
        }
        //redirect ke form
        redirect('pendaftaran_peminjaman_aula');
    }
}