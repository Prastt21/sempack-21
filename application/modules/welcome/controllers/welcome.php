<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class Welcome extends operator_base {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        parent::display();
    }

    function coba() {
        $this->load->helper('form');
//        $this->load->model('model_umum');

        echo form_open('welcome/coba_submit');
        for ($i = 1; $i <= 5; $i++) {
            $data = array('name' => 'nama[]');
            echo form_input($data);
        }
        echo form_submit();
        echo form_close();
//        echo $this->model_umum->ambil_data_tabel('iki');
    }

    function coba_submit() {
        foreach ($this->input->post('nama') as $nama) {
            echo $nama;
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */