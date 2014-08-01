<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class pendaftar_beasiswa extends operator_base {

    public function __construct() {
        parent::__construct();
    }

    var $batas = 15;

    function index($offset = 0) {
        $this->_set_page_role('r');
        $this->load->model('m_pendaftar_beasiswa');
        $this->load->library('bagi_halaman');
        $data['rs_pendaftar_beasiswa'] = $this->m_pendaftar_beasiswa->ambil_pendaftar_beasiswa(array(intval($offset), $this->batas));
        $data['total_data'] = $this->m_pendaftar_beasiswa->count_all_data();
        $data['jml_data'] = count($data['rs_pendaftar_beasiswa']);
        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($data['total_data'], $this->batas, 'pendaftar_beasiswa/index');
        $data['rs_jenis_beasiswa'] = $this->m_pendaftar_beasiswa->ambil_jenis_beasiswa();
        //get data jurusan
        $data['rs_jurusan'] = $this->m_pendaftar_beasiswa->ambil_jurusan();
        parent::display('tampil_pendaftar_beasiswa', $data);
    }
}