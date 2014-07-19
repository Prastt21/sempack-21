<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    require_once APPPATH . 'controllers/operator_base.php';
    
class keterangan_orang_tua extends operator_base {

    var $batas = 15;

    function index($offset = 0) {
        $this->_set_page_role('r');
        $this->load->model('m_keterangan_orang_tua');
        $this->load->library('bagi_halaman');
        $data['rs_keterangan_orang_tua'] = $this->m_keterangan_orang_tua->ambil_keterangan_ortu(array(intval($offset), $this->batas));
        $data['total_data'] = $this->m_keterangan_orang_tua->count_all_data();
        $data['jml_data'] = count($data['rs_keterangan_orang_tua']);
        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($data['total_data'], $this->batas, 'keterangan_orang_tua/index');

        parent::display('tampil_keterangan_orang_tua', $data);
    }
}
?>