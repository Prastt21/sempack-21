<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class jenis_beasiswa extends operator_base {

    var $batas = 15;

    public function index($offset = 0) {
        //control hak akses read
        $this->_set_page_role('r');
        //load model
        $this->load->model('m_jenis_beasiswa');
        //load library
        $this->load->library('bagi_halaman');

        $data['rs_jenis_beasiswa'] = $this->m_jenis_beasiswa->ambil_jenis_beasiswa(array(intval($offset), $this->batas));
        $data['total_data'] = $this->m_jenis_beasiswa->count_all_data();
        $data['jml_data'] = count($data['rs_jenis_beasiswa']);
        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($data['total_data'], $this->batas, 'jenis_beasiswa/index');

        parent::display('tampil_jenis_beasiswa', $data);
    }

    function tambah_jenis_beasiswa() {
        //control hak akses create
        $this->_set_page_role('c');
        $this->load->library('Form_validation');
        //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');
        parent::display('tambah_jenis_beasiswa');
    }

    function proses_tambah_jenis_beasiswa() {
        //validasi tombol simpan, jika tidak ditekan maka redirect ke tampilan tambah informasi
        if ($this->input->post('simpan') == null)
            redirect('jenis_beasiswa/tambah_jenis_beasiswa');
        //load form validation
        $this->load->library('Form_validation');
        //set aturan validasi
        $this->form_validation->set_rules('jenis_beasiswa', 'Jenis Beasiswa', 'required|trim');
        $this->form_validation->set_rules('warna_beasiswa', 'Warna Beasiswa', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
        
        //menjalankan validasi
        if ($this->form_validation->run() === FALSE) {
            //jika validasi ada yang eror, kirim notifikasi ke view
            $this->notification('error', validation_errors());
            $this->form_validation->keep_data();
            //redirect ke tampilan tambah data informasi
            redirect('jenis_beasiswa/tambah_jenis_beasiswa');
        } else {
            //load model
            $this->load->model('m_jenis_beasiswa');
            //set parameter array
            $parameter = array(
                //$this->sesi->get_data_login('ID_PENGGUNA'),
                $this->input->post('jenis_beasiswa'),
                $this->input->post('warna_beasiswa'),
                $this->input->post('keterangan')
            );
            if ($this->m_jenis_beasiswa->tambah_jenis_beasiswa($parameter)) {
                //jika sukses kirim pesan ke view
                $this->notification('success', 'Jenis beasiswa berhasil ditambahkan');
            } else {
                //jika gagal kirim pesan ke view
                $this->notification('error', 'Jenis beasiswa gagal ditambahkan');
            }
        }
        //redirect ke list informasi
        redirect('jenis_beasiswa');
    }

    function ubah_jenis_beasiswa($id = '') {
        //control hak akses update
        $this->_set_page_role('u');
        //set validasi id
        if (empty($id))
            redirect('jenis_beasiswa');
        //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');
        //load library form validation
        $this->load->library('form_validation');
        //load model
        $this->load->model('m_jenis_beasiswa');
        //ambil data informasi berdasarkan id informasi
        $data['result_jenis_beasiswa'] = $this->m_jenis_beasiswa->get_jenis_beasiswa_by_id($id);
        //jika tidak dipencet
        parent::display('ubah_jenis_beasiswa', $data);
    }

    function proses_ubah_jenis_beasiswa() {
        //set validasi tombol simpan
        if ($this->input->post('simpan') == null)
            redirect('jenis_beasiswa');
        //load library form validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('jenis_beasiswa', 'Jenis Beasiswa', 'required|trim');
        $this->form_validation->set_rules('warna_beasiswa', 'Warna Beasiswa', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
        $this->form_validation->set_rules('id_jenis_beasiswa', 'ID Jenis Beasiswa', 'required');

        if ($this->form_validation->run() === FALSE) {
            //set pesan notifikasi eror
            $this->notification('error', validation_errors());
            //data form disimpan biar nanti user ga masukin lagi
            $this->form_validation->keep_data();
            //kembalikan lagi ke form ubah data dengan parameter id_informasi
            redirect('jenis_beasiswa/ubah_jenis_beasiswa/' . $this->input->post('id_jenis_beasiswa'));
        } else {
            //jika validasi sukses
            $this->load->model('m_jenis_beasiswa');
            $parameter = array(
                //$this->sesi->get_data_login('ID_PENGGUNA'),
                $this->input->post('jenis_beasiswa'),
                $this->input->post('warna_beasiswa'),
                $this->input->post('keterangan'),
                $this->input->post('id_jenis_beasiswa')
            );
            if ($this->m_jenis_beasiswa->ubah_jenis_beasiswa($parameter)) {
                //jika berhasil insert
                $this->notification('success', 'Data berhasil dirubah');
                //arahkan kembali ke form edit
                redirect('jenis_beasiswa/ubah_jenis_beasiswa/' . $this->input->post('id_jenis_beasiswa'));
            } else {
                //jika gagal
                $this->notification('error', 'Data gagal dirubah');
                //arahkan kembali ke form edit
                redirect('jenis_beasiswa/ubah_jenis_beasiswa/' . $this->input->post('id_jenis_beasiswa'));
            }
            redirect('jenis_beasiswa');
        }
    }

    function hapus_jenis_beasiswa($id = '') {
        //control hak akses delete
        $this->_set_page_role('d');
        if (empty($id))
            redirect('jenis_beasiswa');
        //load model
        $this->load->model('m_jenis_beasiswa');
        if ($this->m_jenis_beasiswa->hapus_jenis_beasiswa($id)) {
            //jika berhasil menghapus
            $this->notification('success', 'Data berhasil dihapus');
        } else {
            //jika gagal menghapus
            $this->notification('error', 'Data gagal dihapus');
        }
        //kembalikan ke halaman list informasi
        redirect('jenis_beasiswa');
    }
    function cari($offset = 0) {
        $this->_set_page_role('r');
        //load library untuk pagination
        $this->load->library('bagi_halaman');
        //load model
        $this->load->model('m_jenis_beasiswa');
        if ($this->input->post() != null) {
            $keyword = $this->input->post('keyword_text', true);
            $this->session->set_userdata('keyword_cari', $keyword);
        } else {
            $keyword = $this->session->userdata('keyword_cari');
        }
        $parameter = array('%' . $keyword . '%', $offset, $this->batas);
        //ambil data dari database
        $rs_jenis_beasiswa = $this->m_jenis_beasiswa->get_list_data($parameter);
        //menghitung jumlah data tabel keseluruhan
        $rs_total = $this->m_jenis_beasiswa->count_search_data($parameter);

        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($rs_total, $this->batas, 'jenis_beasiswa/index');
        $data['jenis_beasiswa'] = $rs_jenis_beasiswa;
        $data['total_data'] = $rs_total;
        $data['jml_data'] = count($rs_jenis_beasiswa);
        $data['awal'] = $offset;
        $data['keyword'] = $keyword;
        parent::display('tampil_jenis_beasiswa', $data);
    }

}