<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class manajemen_basisdata extends operator_base {

    public function index() {  
        $this->_set_page_role('r');
        //load model
        $this->load->model('m_manajemen_basisdata');
        
        parent::display('v_manajemen_data');
    }
    
    function backup() {
        $this->load->helper('download');
        $tanggal = 'Backup_Sempak'.date('Ymd');
        $namaFile = $tanggal . '.sql.zip';
        $this->load->dbutil();
        $backup = & $this->dbutil->backup();
        force_download($namaFile, $backup);
    }
    function deleteAllTable() {
        //control hak akses delete
        $this->_set_page_role('d');       
        //load model
        $this->load->model('m_manajemen_basisdata');
        if ($this->m_manajemen_basisdata->deleteAllTable()) {
            //jika berhasil menghapus
            $this->notification('success', 'Tabel Operasional berhasil diKosongkan');
        } else {
            //jika gagal menghapus
            $this->notification('error', 'Tabel Operasional gagal diKosongkan');
        }
        //kembalikan ke halaman list informasi
        redirect('manajemen_basisdata');
    }

}