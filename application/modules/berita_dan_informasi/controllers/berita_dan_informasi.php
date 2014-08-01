<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class berita_dan_informasi extends operator_base {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('m_berita_dan_informasi');
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
        $this->load->model('m_berita_dan_informasi');
        $data['rs_info_aula'] = $this->m_berita_dan_informasi->get_berita_dan_informasi_by_aula();
        $data['rs_info_beasiswa'] = $this->m_berita_dan_informasi->get_berita_dan_informasi_by_beasiswa();
        $data['rs_info_asuransi'] = $this->m_berita_dan_informasi->get_berita_dan_informasi_by_asuransi();
        $data['id_pengguna'] = $this->sesi->get_data_login('id_pengguna');
        $this->load->library('Form_validation');
        //$data['tpl_footer'] = 'footer_dashboard';
        parent::display('tampil_berita_dan_informasi',$data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
