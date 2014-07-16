<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class peminjaman_aula extends operator_base {

    public function index() {
        parent::display('v_peminjaman_aula');
    }

}
