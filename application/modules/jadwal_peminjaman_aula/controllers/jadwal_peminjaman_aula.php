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
}