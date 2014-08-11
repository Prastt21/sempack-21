<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class pengguna extends operator_base {

    var $batas = 15;

    public function index($offset = 0) {
        //control hak akses read
        $this->_set_page_role('r');
        //load model
        $this->load->model('m_pengguna');
        //load library
        $this->load->library('bagi_halaman');

        $data['rs_pengguna'] = $this->m_pengguna->ambil_pengguna(array(intval($offset), $this->batas));
        $data['total_data'] = $this->m_pengguna->count_all_data();
        $data['jml_data'] = count($data['rs_pengguna']);
        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($data['total_data'], $this->batas, 'pengguna/index');

        parent::display('tampil_pengguna', $data);
    }
    function cari($offset = 0) {
        $this->_set_page_role('r');
        //load library untuk pagination
        $this->load->library('bagi_halaman');
        //load model
        $this->load->model('m_pengguna');
        if ($this->input->post() != null) {
            $keyword = $this->input->post('keyword_text', true);
            $this->session->set_userdata('keyword_cari', $keyword);
        } else {
            $keyword = $this->session->userdata('keyword_cari');
        }
        $parameter = array('%' . $keyword . '%', $offset, $this->batas);
        //ambil data dari database
        $rs_pengguna = $this->m_pengguna->get_list_data($parameter);
        //menghitung jumlah data tabel keseluruhan
        $rs_total = $this->m_pengguna->count_search_data($parameter);

        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($rs_total, $this->batas, 'pengguna/index');
        $data['rs_pengguna'] = $rs_pengguna;
        $data['total_data'] = $rs_total;
        $data['jml_data'] = count($rs_pengguna);
        $data['awal'] = $offset;
        $data['keyword'] = $keyword;
        parent::display('tampil_pengguna', $data);
    }
}