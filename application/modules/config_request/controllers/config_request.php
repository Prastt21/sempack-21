<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class config_request extends operator_base {

    public function index() {
        $this->_set_page_role('u');
        $this->load->model('m_config_request');        
        $this->load->library('Form_validation');

        parent::display('v_config_request');
    }
    function ubah_request() {
        //control hak akses update
        $this->_set_page_role('u');
        //set validasi id        
            redirect('config_request');
        //load library form validation
        $this->load->library('form_validation');
        //load model
        $this->load->model('m_config_request');
        //jika tidak dipencet
        parent::display('v_config_request');
    }

    function proses_ubah_request() {
        //set validasi tombol simpan
        if ($this->input->post('simpan') == null)
            redirect('config_request');
        //load library form validation
        $this->load->library('Form_validation');
        $this->form_validation->set_rules('status_request', 'Status Request', 'required|trim');
        $this->form_validation->set_rules('hapus_request', 'Hapus Request', 'required|trim');
        

        if ($this->form_validation->run() === FALSE) {
            //set pesan notifikasi eror
            $this->notification('error', validation_errors());
            //data form disimpan biar nanti user ga masukin lagi
            $this->form_validation->keep_data();
            //kembalikan lagi ke form ubah data dengan parameter id_informasi
            redirect('config_request/ubah_request/'. $this->input->post('status_request'));
        } else {
            //jika validasi sukses
            $this->load->model('m_config_request');
            $parameter = array(
                $this->input->post('status_request'),
                $this->input->post('hapus_request')
            );
            if ($this->m_config_request->ubah_request($parameter)) {
                //jika berhasil insert
                $this->notification('success', 'Sistem berhasil diaktifkan');
                //arahkan kembali ke form edit
                redirect('config_request/ubah_request/'. $this->input->post('status_request'));
            } else {
                //jika gagal
                $this->notification('error', 'Sistem Gagal diaktifkan');
                //arahkan kembali ke form edit
                redirect('config_request/ubah_request/'. $this->input->post('status_request'));
            }
            redirect('config_request');
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
