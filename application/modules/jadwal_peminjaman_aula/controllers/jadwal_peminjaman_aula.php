<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class jadwal_peminjaman_aula extends operator_base {

    var $batas = 15;

    public function index($offset = 0) {
        //control hak akses read
        $this->_set_page_role('r');
        //load model
        $this->load->model('m_jadwal_peminjaman_aula');
        //load library
        $this->load->library('bagi_halaman');

        $data['rs_jadwal_peminjaman_aula'] = $this->m_jadwal_peminjaman_aula->ambil_jadwal_peminjaman_aula(array(intval($offset), $this->batas));
        $data['total_data'] = $this->m_jadwal_peminjaman_aula->count_all_data();
        $data['jml_data'] = count($data['rs_jadwal_peminjaman_aula']);
        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($data['total_data'], $this->batas, 'jadwal_peminjaman_aula/index');

        parent::display('tampil_jadwal_peminjaman_aula', $data);
    }  
    function cari($offset = 0) {
        $this->_set_page_role('r');
        //load library untuk pagination
        $this->load->library('bagi_halaman');
        //load model
        $this->load->model('m_jadwal_peminjaman_aula');
        if ($this->input->post() != null) {
            $keyword = $this->input->post('keyword_text', true);
            $this->session->set_userdata('keyword_cari', $keyword);
        } else {
            $keyword = $this->session->userdata('keyword_cari');
        }
        $parameter = array('%' . $keyword . '%', $offset, $this->batas);
        //ambil data dari database
        $rs_jadwal_peminjaman_aula = $this->m_jadwal_peminjaman_aula->get_list_data($parameter);
        //menghitung jumlah data tabel keseluruhan
        $rs_total = $this->m_jadwal_peminjaman_aula->count_search_data($parameter);

        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($rs_total, $this->batas, 'jadwal_peminjaman_aula/index');
        $data['rs_jadwal_peminjaman_aula'] = $rs_jadwal_peminjaman_aula;
        $data['total_data'] = $rs_total;
        $data['jml_data'] = count($rs_jadwal_peminjaman_aula);
        $data['awal'] = $offset;
        $data['keyword'] = $keyword;
        parent::display('tampil_jadwal_peminjaman_aula', $data);
    }
}