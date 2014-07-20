<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class config_pengumuman extends operator_base {

    public function index() {
        parent::display('v_config_pengumuman');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
