<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class kalender extends operator_base {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        $this->_set_page_role('r');
        $this->load->model('m_kalender');
        $this->load_css('assets/css/fullcalendar/fullcalendar.css');
        $this->load_css('assets/css/fullcalendar/fullcalendar.print.css');
        $this->load_js('assets/js/plugins/fullcalendar/fullcalendar.min.js');       
        parent::display('tampil_kalender');
    }
}