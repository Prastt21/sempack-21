<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    require_once APPPATH . 'controllers/operator_base.php';
    
class pengguna extends operator_base {

    var $batas = 15;

    function index($offset = 0) {
        $this->_set_page_role('r');
        $this->load->model('m_pengguna');
        $this->load->library('bagi_halaman');
        $data['rs_pengguna'] = $this->m_pengguna->ambil_pengguna(array(intval($offset), $this->batas));
        $data['total_data'] = $this->m_pengguna->count_all_data();
        $data['jml_data'] = count($data['rs_pengguna']);
        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($data['total_data'], $this->batas, 'pengguna/index');

        parent::display('tampil_pengguna', $data);
    }
}
?>
