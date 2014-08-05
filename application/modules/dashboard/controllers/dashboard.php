<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class dashboard extends operator_base {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('m_dashboard');
    }

    public function index() {
        //set privasi
        $this->_set_page_role('r');
        //load file js
        $this->load_js('assets/js/raphael-min.js');
        $this->load_js('assets/js/plugins/morris/morris.min.js');
        //load js validasi
        $this->load_js('assets/js/plugins/jvalidator/jquery.validate.min.js');
        //load model
        $this->load->model('m_dashboard');
        $data['rs_pengumuman'] = $this->m_dashboard->get_pengumuman_sistem();
        $data['total_peminjaman_aula_by_day'] = $this->m_dashboard->get_total_peminjaman_aula_by_day(array(date('m'), date('Y'), $this->sesi->get_data_login('id_pengguna')));
        $data['total_peminjaman_aula_by_month'] = $this->m_dashboard->get_total_peminjaman_aula_by_month(array(date('m'), date('Y'), $this->sesi->get_data_login('id_pengguna')));
        $data['rs_last_login'] = $this->m_dashboard->get_list_last_login();
        $data['id_pengguna'] = $this->sesi->get_data_login('id_pengguna');
        $this->load->library('Form_validation');
        //$data['tpl_footer'] = 'footer_dashboard';
        parent::display('tampil_dashboard',$data);
    }
    
    function get_total_peminjaman_aula_harian() {
        $this->_set_page_role('r');
        //validasi url
        if ($this->input->post() == null)
            redirect('dashboard');
        //tanggal hari ini
        $tanggal_sekarang = date('Y-m-d');
        $tanggal_awal = date('Y-m-d', strtotime('-9 day', strtotime($tanggal_sekarang)));
        $tanggal_aktif = strtotime($tanggal_awal);
        $sent_data = array();
        while ($tanggal_aktif <= strtotime($tanggal_sekarang)) {
            $data['y'] = date('Y-m-d', $tanggal_aktif);
            $data['item1'] = $this->m_dashboard->get_total_peminjaman_aula_by_day(array($data['y'], $this->sesi->get_data_login('id_pengguna')));
            $sent_data[] = $data;
            $tanggal_aktif = strtotime('+1 day', $tanggal_aktif);
        }
        $this->output->set_output(json_encode($sent_data));
    }

    function get_total_peminjaman_aula_bulanan() {
        $this->_set_page_role('r');
        //validasi url
        if ($this->input->post() == null)
            redirect('dashboard');
        //tanggal hari ini
        $tanggal_sekarang = date('Y-m');
        $tanggal_awal = date('Y-m', strtotime('-9 month', strtotime($tanggal_sekarang)));
        $tanggal_aktif = strtotime($tanggal_awal);
        $sent_data = array();
        while ($tanggal_aktif <= strtotime($tanggal_sekarang)) {
            $data['a'] = date('Y-m', $tanggal_aktif);
            $data['item2'] = $this->m_dashboard->get_total_peminjaman_aula_by_month(array(date('m', strtotime($data['a'])), date('Y', strtotime($data['a'])), $this->sesi->get_data_login('id_pengguna')));
            $sent_data[] = $data;
            $tanggal_aktif = strtotime('+1 month', $tanggal_aktif);
        }
        $this->output->set_output(json_encode($sent_data));
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
