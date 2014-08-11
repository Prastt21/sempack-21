<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class data_beasiswa extends operator_base {

    public function __construct() {
        parent::__construct();
    }

    var $batas = 15;

    function index($offset = 0) {
        $this->_set_page_role('r');
        $this->load->model('m_data_beasiswa');
        $this->load->library('bagi_halaman');
        $data['rs_data_beasiswa'] = $this->m_data_beasiswa->ambil_data_beasiswa(array(intval($offset), $this->batas));
        $data['total_data'] = $this->m_data_beasiswa->count_all_data();
        $data['jml_data'] = count($data['rs_data_beasiswa']);
        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($data['total_data'], $this->batas, 'data_beasiswa/index');

        parent::display('tampil_data_beasiswa', $data);
    }

    function ubah_data_beasiswa($id = '') {
        $this->_set_page_role('u');
        if (empty($id))
            redirect('data_beasiswa');
        //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');
        //load form validation
        $this->load->library('form_validation');
        //load model
        $this->load->model('m_data_beasiswa');
        //get data jenis beasiswa
        $data['rs_jenis_beasiswa'] = $this->m_data_beasiswa->ambil_jenis_beasiswa();
        //get data jurusan
        $data['rs_jurusan'] = $this->m_data_beasiswa->ambil_jurusan();
        //get beasiswa by id
        $data['result_data_beasiswa'] = $this->m_data_beasiswa->get_data_beasiswa_by_id($id);
        parent::display('ubah_data_beasiswa', $data);
    }

    function proses_ubah_data_beasiswa() {
        if ($this->input->post('simpan') == null)
            redirect('data_beasiswa');
        //load library form validation
        $this->load->library('form_validation');
        //set validasi form
        $this->form_validation->set_rules('status_beasiswa', 'Status Beasiswa', 'required');
        $this->form_validation->set_rules('id_beasiswa', 'ID Beasiswa', 'required');        
       
        if ($this->form_validation->run() === FALSE) {
            //set notifikasi
            $this->notification('error', validation_errors());
            //simpan data yang sudah diisi
            $this->form_validation->keep_data();
            redirect('data_beasiswa/ubah_data_beasiswa/' . $this->input->post('id_beasiswa'));
        } else {
            $this->load->model('m_data_beasiswa');
            $parameter = array(
                $this->input->post('status_beasiswa'),
                $this->input->post('id_beasiswa')
            );
            //perubahan data
            if ($this->m_data_beasiswa->ubah_data_beasiswa($parameter)) {
                //jika berhasil insert
                $this->notification('success', 'Data berhasil dirubah');
                //arahkan kembali ke form edit
                redirect('data_beasiswa/ubah_data_beasiswa/' . $this->input->post('id_beasiswa'));
            } else {
                //jika gagal
                $this->notification('error', 'Data gagal dirubah');
                //arahkan kembali ke form edit
                redirect('data_beasiswa/ubah_data_beasiswa/' . $this->input->post('id_beasiswa'));
            }
            redirect('data_beasiswa');
        }
    }
    
    function hapus_data_beasiswa($id = '') {
        //control hak akses delete
        $this->_set_page_role('d');
        if (empty($id))
            redirect('data_beasiswa');
        //load model
        $this->load->model('m_data_beasiswa');
        if ($this->m_data_beasiswa->hapus_data_beasiswa($id)) {
            //jika berhasil menghapus
            $this->notification('success', 'Data berhasil dihapus');
        } else {
            //jika gagal menghapus
            $this->notification('error', 'Data gagal dihapus');
        }
        //kembalikan ke halaman list informasi
        redirect('data_beasiswa');
    }
    function cari($offset = 0) {
        $this->_set_page_role('r');
        //load library untuk pagination
        $this->load->library('bagi_halaman');
        //load model
        $this->load->model('m_data_beasiswa');
        if ($this->input->post() != null) {
            $keyword = $this->input->post('keyword_text', true);
            $this->session->set_userdata('keyword_cari', $keyword);
        } else {
            $keyword = $this->session->userdata('keyword_cari');
        }
        $parameter = array('%' . $keyword . '%', $offset, $this->batas);
        //ambil data dari database
        $rs_data_beasiswa = $this->m_data_beasiswa->get_list_data($parameter);
        //menghitung jumlah data tabel keseluruhan
        $rs_total = $this->m_data_beasiswa->count_search_data($parameter);

        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($rs_total, $this->batas, 'data_beasiswa/index');
        $data['rs_data_beasiswa'] = $rs_data_beasiswa;
        $data['total_data'] = $rs_total;
        $data['jml_data'] = count($rs_data_beasiswa);
        $data['awal'] = $offset;
        $data['keyword'] = $keyword;
        parent::display('tampil_data_beasiswa', $data);
    }

}