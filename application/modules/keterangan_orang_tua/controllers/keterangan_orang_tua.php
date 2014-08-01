<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class keterangan_orang_tua extends operator_base {

    var $batas = 15;

    public function index($offset = 0) {
        //control hak akses read
        $this->_set_page_role('r');
        //load model
        $this->load->model('m_keterangan_orang_tua');
        //load library
        $this->load->library('bagi_halaman');

        $data['rs_keterangan_orang_tua'] = $this->m_keterangan_orang_tua->ambil_keterangan_orang_tua(array(intval($offset), $this->batas));
        $data['total_data'] = $this->m_keterangan_orang_tua->count_all_data();
        $data['jml_data'] = count($data['rs_keterangan_orang_tua']);
        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($data['total_data'], $this->batas, 'keterangan_orang_tua/index');

        parent::display('tampil_keterangan_orang_tua', $data);
    }
    function cari($offset = 0) {
        $this->_set_page_role('r');
        //load library untuk pagination
        $this->load->library('bagi_halaman');
        //load model
        $this->load->model('m_keterangan_orang_tua');
        if ($this->input->post() != null) {
            $keyword = $this->input->post('keyword_text', true);
            $this->session->set_userdata('keyword_cari', $keyword);
        } else {
            $keyword = $this->session->userdata('keyword_cari');
        }
        $parameter = array('%' . $keyword . '%', $offset, $this->batas);
        //ambil data dari database
        $rs_keterangan_orang_tua = $this->m_keterangan_orang_tua->get_list_data($parameter);
        //menghitung jumlah data tabel keseluruhan
        $rs_total = $this->m_keterangan_orang_tua->count_search_data($parameter);

        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($rs_total, $this->batas, 'keterangan_orang_tua/index');
        $data['keterangan_orang_tua'] = $rs_keterangan_orang_tua;
        $data['total_data'] = $rs_total;
        $data['jml_data'] = count($rs_keterangan_orang_tua);
        $data['awal'] = $offset;
        $data['keyword'] = $keyword;
        parent::display('tampil_keterangan_orang_tua', $data);
    }
}