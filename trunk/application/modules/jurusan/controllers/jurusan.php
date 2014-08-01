<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class jurusan extends operator_base {

    var $batas = 15;

    public function index($offset = 0) {
        //control hak akses read
        $this->_set_page_role('r');
        //load model
        $this->load->model('m_jurusan');
        //load library
        $this->load->library('bagi_halaman');

        $data['rs_jurusan'] = $this->m_jurusan->ambil_jurusan(array(intval($offset), $this->batas));
        $data['total_data'] = $this->m_jurusan->count_all_data();
        $data['jml_data'] = count($data['rs_jurusan']);
        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($data['total_data'], $this->batas, 'jurusan/index');

        parent::display('tampil_jurusan', $data);
    }

    function tambah_jurusan() {
        //control hak akses create
        $this->_set_page_role('c');
        $this->load->library('Form_validation');
        //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');
        parent::display('tambah_jurusan');
    }

    function proses_tambah_jurusan() {
        //validasi tombol simpan, jika tidak ditekan maka redirect ke tampilan tambah informasi
        if ($this->input->post('simpan') == null)
            redirect('jurusan/tambah_jurusan');
        //load form validation
        $this->load->library('Form_validation');
        //set aturan validasi
        $this->form_validation->set_rules('nama_jurusan', 'Nama Jurusan', 'required|trim');
        $this->form_validation->set_rules('singkatan_jurusan', 'Singkatan Jurusan', 'required|trim');
        $this->form_validation->set_rules('warna_jurusan', 'Warna Jurusan', 'required|trim');
        //menjalankan validasi
        if ($this->form_validation->run() === FALSE) {
            //jika validasi ada yang eror, kirim notifikasi ke view
            $this->notification('error', validation_errors());
            $this->form_validation->keep_data();
            //redirect ke tampilan tambah data informasi
            redirect('jurusan/tambah_jurusan');
        } else {
            //load model
            $this->load->model('m_jurusan');
            //set parameter array
            $parameter = array(
                //$this->sesi->get_data_login('ID_PENGGUNA'),
                $this->input->post('nama_jurusan'),
                $this->input->post('singkatan_jurusan'),
                $this->input->post('warna_jurusan')
            );
            if ($this->m_jurusan->tambah_jurusan($parameter)) {
                //jika sukses kirim pesan ke view
                $this->notification('success', 'Data jurusan berhasil ditambahkan');
            } else {
                //jika gagal kirim pesan ke view
                $this->notification('error', 'Data jurusan gagal ditambahkan');
            }
        }
        //redirect ke list informasi
        redirect('jurusan');
    }

    function ubah_jurusan($id = '') {
        //control hak akses update
        $this->_set_page_role('u');
        //set validasi id
        if (empty($id))
            redirect('jurusan');
        //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');
        //load library form validation
        $this->load->library('form_validation');
        //load model
        $this->load->model('m_jurusan');
        //ambil data informasi berdasarkan id informasi
        $data['result_jurusan'] = $this->m_jurusan->get_jurusan_by_id($id);
        //jika tidak dipencet
        parent::display('ubah_jurusan', $data);
    }

    function proses_ubah_jurusan() {
        //set validasi tombol simpan
        if ($this->input->post('simpan') == null)
            redirect('jurusan');
        //load library form validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_jurusan', 'Nama Jurusan', 'required|trim');
        $this->form_validation->set_rules('singkatan_jurusan', 'Singkatan Jurusan', 'required|trim');
        $this->form_validation->set_rules('warna_jurusan', 'Warna Jurusan', 'required|trim');
        $this->form_validation->set_rules('id_jurusan', 'ID Jurusan', 'required');

        if ($this->form_validation->run() === FALSE) {
            //set pesan notifikasi eror
            $this->notification('error', validation_errors());
            //data form disimpan biar nanti user ga masukin lagi
            $this->form_validation->keep_data();
            //kembalikan lagi ke form ubah data dengan parameter id_informasi
            redirect('jurusan/ubah_jurusan/' . $this->input->post('id_jurusan'));
        } else {
            //jika validasi sukses
            $this->load->model('m_jurusan');
            $parameter = array(
                //$this->sesi->get_data_login('ID_PENGGUNA'),
                $this->input->post('nama_jurusan'),
                $this->input->post('singkatan_jurusan'),
                $this->input->post('warna_jurusan'),
                $this->input->post('id_jurusan')
            );
            if ($this->m_jurusan->ubah_jurusan($parameter)) {
                //jika berhasil insert
                $this->notification('success', 'Data berhasil dirubah');
                //arahkan kembali ke form edit
                redirect('jurusan/ubah_jurusan/' . $this->input->post('id_jurusan'));
            } else {
                //jika gagal
                $this->notification('error', 'Data gagal dirubah');
                //arahkan kembali ke form edit
                redirect('jurusan/ubah_jurusan/' . $this->input->post('id_jurusan'));
            }
            redirect('jurusan');
        }
    }

    function hapus_jurusan($id = '') {
        //control hak akses delete
        $this->_set_page_role('d');
        if (empty($id))
            redirect('jurusan');
        //load model
        $this->load->model('m_jurusan');
        if ($this->m_jurusan->hapus_jurusan($id)) {
            //jika berhasil menghapus
            $this->notification('success', 'Data berhasil dihapus');
        } else {
            //jika gagal menghapus
            $this->notification('error', 'Data gagal dihapus');
        }
        //kembalikan ke halaman list informasi
        redirect('jurusan');
    }
    function cari($offset = 0) {
        $this->_set_page_role('r');
        //load library untuk pagination
        $this->load->library('bagi_halaman');
        //load model
        $this->load->model('m_jurusan');
        if ($this->input->post() != null) {
            $keyword = $this->input->post('keyword_text', true);
            $this->session->set_userdata('keyword_cari', $keyword);
        } else {
            $keyword = $this->session->userdata('keyword_cari');
        }
        $parameter = array('%' . $keyword . '%', $offset, $this->batas);
        //ambil data dari database
        $rs_jurusan = $this->m_jurusan->get_list_data($parameter);
        //menghitung jumlah data tabel keseluruhan
        $rs_total = $this->m_jurusan->count_search_data($parameter);

        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($rs_total, $this->batas, 'satuan/index');
        $data['jurusan'] = $rs_jurusan;
        $data['total_data'] = $rs_total;
        $data['jml_data'] = count($rs_jurusan);
        $data['awal'] = $offset;
        $data['keyword'] = $keyword;
        parent::display('tampil_jurusan', $data);
    }

}