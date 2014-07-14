<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class InformasiCrud extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('input');
        $this->load->model('modules/informasi/models/m_informasicrud');
    }

// bagian pengelolaan agenda
    public function index() {
        $data['daftar_agenda'] = $this->agenda_model->select_all()->result();
        $this->load->view('modules/informasi/views/tampil_informasicrud', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */