<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class dashboard extends operator_base {

    public function index() {
        //set privasi
        $this->_set_page_role('r');
        //load file js
        $this->load_js('assets/js/raphael-min.js');
        $this->load_js('assets/js/plugins/morris/morris.min.js');
        //load js validasi
        $this->load_js('assets/js/plugins/jvalidator/jquery.validate.min.js');
        //load model
        //$this->load->model('m_umum');
        //$data['tpl_footer'] = 'footer_dashboard';
        parent::display('tampil_dashboard');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
