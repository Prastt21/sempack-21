<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class config_sistem extends operator_base {

    public function index() {
        $this->_set_page_role('c');
        $this->load->model('m_config_sistem');       
        $data['rs_periode'] = $this->m_config_sistem->ambil_data_periode();        
        parent::display('v_config_sistem', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
