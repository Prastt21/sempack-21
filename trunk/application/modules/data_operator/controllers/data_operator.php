<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class data_operator extends operator_base {

    public function index() {
        parent::display('v_data_operator');
    }

}
