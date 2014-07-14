<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/base/admin_base.php';

class informasi extends admin_base {

    private $batas = 15;

    public function __construct() {
        parent::__construct();
    }

    function index($offset = 0) {
        $this->_set_page_role('r');
        //load library untuk pagination
        $this->load->library('bagi_halaman');
        //load model
        $this->load->model('m_informasi');
        $this->load->model('m_umum');
        //set value untuk limit
        $batas = 10;
        //ambil data dari database
        $rs_informasi = $this->m_informasi->get_list_data(array('%', (int)$offset, $this->batas));
        //menghitung jumlah data tabel keseluruhan
        $rs_total = $this->m_umum->hitung_data_tabel('informasi');

        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($rs_total, $this->batas, 'informasi/index');
        $data['informasi'] = $rs_informasi;
        $data['total_data'] = $rs_total;
        $data['jml_data'] = count($rs_informasi);
        $data['awal'] = $offset;
        parent::display('tampil_data_informasi', $data, 'footer_tampil_data_informasi');
    }

    function cari($offset = 0) {
        $this->_set_page_role('r');
        //load library untuk pagination
        $this->load->library('bagi_halaman');
        //load model
        $this->load->model('m_informasi');
        if ($this->input->post() != null) {
            $keyword = $this->input->post('keyword_text', true);
            $this->session->set_userdata('keyword_cari', $keyword);
        } else {
            $keyword = $this->session->userdata('keyword_cari');
        }
        //set parameter
        $parameter_cari = array('%' . $keyword . '%', (int)$offset, $this->batas);
        //ambil data dari database
        $rs_informasi = $this->m_informasi->get_list_data($parameter_cari);
        //menghitung jumlah data tabel keseluruhan
        $rs_total = $this->m_informasi->count_search_data($parameter_cari);

        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($rs_total, $this->batas, 'informasi/cari');
        $data['informasi'] = $rs_informasi;
        $data['total_data'] = $rs_total;
        $data['jml_data'] = count($rs_informasi);
        $data['awal'] = $offset;
        $data['keyword'] = $keyword;
        parent::display('tampil_data_informasi', $data, 'footer_tampil_data_informasi');
    }

    function tambah_informasi() {
        $this->_set_page_role('c');
        //load js validasi
        $this->load_js('assets/js/plugins/jvalidator/jquery.validate.min.js');
        //load model pelanggan
        $this->load->model('m_informasi');

        parent::display('tambah_data_informasi', $data, 'footer_tambah_data_informasi');
    }

    function proses_tambah_pelanggan() {
        if ($this->input->post() != null) {
            $this->load->library('form_validation');
            //set rule
            $this->form_validation->set_rules('judul_info', 'Judul Informasi', 'required|min_lenght[3]|max_lenght[200]');
            $this->form_validation->set_rules('isi_info', 'Isi Informasi', 'required');
            $this->form_validation->set_rules('jenis_info', 'Jenis Informasi', 'required');
            $this->form_validation->set_rules('tanggal_info', 'Tanggal Publish', 'required');
            //run form validationF
            if ($this->form_validation->run() === false) {
                $hasil['status'] = 0;
                $hasil['pesan'] = validation_errors();
            } else {
                $informasi['id_login'] = $this->input->post('id_login', true);
                $informasi['judul_info'] = $this->input->post('judul_info', true);
                $informasi['isi_info'] = $this->input->post('isi_info', true);
                $informasi['jenis_info'] = $this->input->post('jenis_info', true);
                $informasi['tanggal_info'] = date('Y-m-d H:i:s');
                // load model umum
                $this->load->model('m_umum');
                if ($this->m_umum->tambah_data_tabel('data_pelanggan', $pelanggan) > 0) {
                    $hasil['status'] = 1;
                    $hasil['pesan'] = 'Informasi ' . $pelanggan['judul_info'] . ' berhasil disimpan.';
                } else {
                    $hasil['status'] = 0;
                    $hasil['pesan'] = 'Informasi ' . $pelanggan['judul_info'] . ' gagal disimpan.';
                }
            }
            //set output
            $this->output->set_output(json_encode($hasil));
        } else {
            redirect('informasi');
        }
    }

    function ubah_informasi($id = null) {
        if ($id != null) {
            $this->_set_page_role('u');
            $this->load->model('m_informasi');
            $data['rs_informasi'] = $this->m_informasi->get_detail_informasi(array($id));
            if (count($data['rs_informasi']) > 0) {
                //load js validasi
                $this->load_js('assets/js/plugins/jvalidator/jquery.validate.min.js');
                parent::display('ubah_data_informasi', $data, 'footer_ubah_data_informasi');
            } else {
                redirect('informasi');
            }
        } else {
            
        }
    }

    function proses_ubah_informasi() {
        if ($this->input->post() != null) {
            $this->load->library('form_validation');
            //set rule
            $this->form_validation->set_rules('judul_info', 'Judul Informasi', 'required|min_lenght[3]|max_lenght[200]');
            $this->form_validation->set_rules('isi_info', 'Isi Informasi', 'required');
            $this->form_validation->set_rules('jenis_info', 'Jenis Informasi', 'required');
            $this->form_validation->set_rules('tanggal_info', 'Tanggal Publish', 'required');
            //run form validationF
            if ($this->form_validation->run() === false) {
                $hasil['status'] = 0;
                $hasil['pesan'] = validation_errors();
            } else {
                $informasi['id_login'] = $this->input->post('id_login', true);
                $informasi['judul_info'] = $this->input->post('judul_info', true);
                $informasi['isi_info'] = $this->input->post('isi_info', true);
                $informasi['jenis_info'] = $this->input->post('jenis_info', true);
                $informasi['tanggal_info'] = date('Y-m-d H:i:s');
                // load model umum
                $this->load->model('m_umum');
                if ($this->m_umum->ubah_data_tabel('informasi', $informasi, 'id_informasi', $this->input->post('id_informasi', true)) > 0) {
                    $this->m_umum->ubah_data_tabel('informasi', array('mdd' => date('Y-m-d H:i:s'), 'mdb' => $this->sesi->get_data_login('id_login')), 'id_informasi', $this->input->post('id_informasi', true));
                    $hasil['status'] = 1;
                    $hasil['pesan'] = 'Data Informasi ' . $pelanggan['judul_info'] . ' berhasil disimpan.';
                } else {
                    $hasil['status'] = 0;
                    $hasil['pesan'] = 'Data Informasi ' . $pelanggan['judul_info'] . ' tidak ada yang diubah.';
                }
            }
            //set output
            $this->output->set_output(json_encode($hasil));
        } else {
            redirect('informasi');
        }
    }

    //hapus
    function proses_hapus_informasi() {
        if ($this->input->post() != null) {
            $id = $this->input->post('id');
            //load model
            $this->load->model('m_informasi');
            //cek relasi
                //penghapusan data
                if ($this->m_pelanggan->hapus_pelanggan_by_id(array($id))) {
                    $hasil['status'] = 1;
                    $hasil['pesan'] = 'Data pelanggan berhasil dihapus.';
                } else {
                    $hasil['status'] = 0;
                    $hasil['pesan'] = 'Data pelanggan gagal dihapus.';
                }
       
            //set output
            $this->output->set_output(json_encode($hasil));
        } else {
            redirect('informasi');
        }
    }

}