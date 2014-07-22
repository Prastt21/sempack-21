<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class data_informasi extends operator_base {

    var $batas = 15;

    public function index($offset = 0) {
        //control hak akses read
        $this->_set_page_role('r');
        //load model
        $this->load->model('m_data_informasi');
        //load library
        $this->load->library('bagi_halaman');

        $data['rs_informasi'] = $this->m_data_informasi->ambil_data_informasi(array(intval($offset), $this->batas));
        $data['total_data'] = $this->m_data_informasi->count_all_data();
        $data['jml_data'] = count($data['rs_informasi']);
        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($data['total_data'], $this->batas, 'data_informasi/index');

        parent::display('tampil_data_informasi', $data);
    }

    function tambah_data_informasi() {
        //control hak akses create
        $this->_set_page_role('c');
        $this->load->library('Form_validation');
        //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');
        parent::display('tambah_data_informasi');
    }

    function proses_tambah_data_informasi() {
        //validasi tombol simpan, jika tidak ditekan maka redirect ke tampilan tambah informasi
        if ($this->input->post('simpan') == null)
            redirect('data_informasi/tambah_data_informasi');
        //load form validation
        $this->load->library('Form_validation');
        //set aturan validasi
        $this->form_validation->set_rules('judul_informasi', 'Judul Informasi', 'required|trim');
        $this->form_validation->set_rules('isi_informasi', 'Isi Informasi', 'required|trim');
        $this->form_validation->set_rules('jenis', 'Jenis Informasi', 'required|trim');
        $this->form_validation->set_rules('tanggal', 'Tanggal Informasi', 'required');
        //menjalankan validasi
        if ($this->form_validation->run() === FALSE) {
            //jika validasi ada yang eror, kirim notifikasi ke view
            $this->notification('error', validation_errors());
            $this->form_validation->keep_data();
            //redirect ke tampilan tambah data informasi
            redirect('data_informasi/tambah_data_informasi');
        } else {
            //load model
            $this->load->model('m_data_informasi');
            //set parameter array
            $parameter = array(
                $this->sesi->get_data_login('ID_PENGGUNA'),
                $this->input->post('judul_informasi'),
                $this->input->post('isi_informasi'),
                $this->input->post('jenis'),
                $this->input->post('tanggal')
            );
            if ($this->m_data_informasi->tambah_data_informasi($parameter)) {
                //jika sukses kirim pesan ke view
                $this->notification('success', 'Data informasi berhasil ditambahkan');
            } else {
                //jika gagal kirim pesan ke view
                $this->notification('error', 'Data informasi gagal ditambahkan');
            }
        }
        //redirect ke list informasi
        redirect('data_informasi');
    }

    function ubah_data_informasi($id = '') {
        //control hak akses update
        $this->_set_page_role('u');
        //set validasi id
        if (empty($id))
            redirect('data_informasi');
        //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');
        //load library form validation
        $this->load->library('form_validation');
        //load model
        $this->load->model('m_data_informasi');
        //ambil data informasi berdasarkan id informasi
        $data['result_informasi'] = $this->m_data_informasi->get_data_informasi_by_id($id);
        //jika tidak dipencet
        parent::display('ubah_data_informasi', $data);
    }

    function proses_ubah_data_informasi() {
        //set validasi tombol simpan
        if ($this->input->post('simpan') == null)
            redirect('data_informasi');
        //load library form validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('judul_informasi', 'Judul Informasi', 'required|trim');
        $this->form_validation->set_rules('isi_informasi', 'Isi Informasi', 'required|trim');
        $this->form_validation->set_rules('jenis', 'Jenis Informasi', 'required|trim');
        $this->form_validation->set_rules('tanggal', 'Tanggal Informasi', 'required');
        $this->form_validation->set_rules('id_informasi', 'ID Informasi', 'required');

        if ($this->form_validation->run() === FALSE) {
            //set pesan notifikasi eror
            $this->notification('error', validation_errors());
            //data form disimpan biar nanti user ga masukin lagi
            $this->form_validation->keep_data();
            //kembalikan lagi ke form ubah data dengan parameter id_informasi
            redirect('data_informasi/ubah_data_informasi/' . $this->input->post('id_informasi'));
        } else {
            //jika validasi sukses
            $this->load->model('m_data_informasi');
            $parameter = array(
                $this->sesi->get_data_login('ID_PENGGUNA'),
                $this->input->post('judul_informasi'),
                $this->input->post('isi_informasi'),
                $this->input->post('jenis'),
                $this->input->post('tanggal'),
                $this->input->post('id_informasi')
            );
            if ($this->m_data_informasi->ubah_data_informasi($parameter)) {
                //jika berhasil insert
                $this->notification('success', 'Data berhasil dirubah');
                //arahkan kembali ke form edit
                redirect('data_informasi/ubah_data_informasi/' . $this->input->post('id_informasi'));
            } else {
                //jika gagal
                $this->notification('error', 'Data gagal dirubah');
                //arahkan kembali ke form edit
                redirect('data_informasi/ubah_data_informasi/' . $this->input->post('id_informasi'));
            }
            redirect('data_informasi');
        }
    }

    function hapus_data_informasi($id = '') {
        //control hak akses delete
        $this->_set_page_role('d');
        if (empty($id))
            redirect('data_informasi');
        //load model
        $this->load->model('m_data_informasi');
        if ($this->m_data_informasi->hapus_data_informasi($id)) {
            //jika berhasil menghapus
            $this->notification('success', 'Data berhasil dihapus');
        } else {
            //jika gagal menghapus
            $this->notification('error', 'Data gagal dihapus');
        }
        //kembalikan ke halaman list informasi
        redirect('data_informasi');
    }

}