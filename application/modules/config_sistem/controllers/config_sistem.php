<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class config_sistem extends operator_base {

    public function index() {
        $this->_set_page_role('u');
        $this->load->model('m_config_sistem');       
        $data['rs_periode_ku'] = $this->m_config_sistem->ambil_data_periode();
        $this->load->library('Form_validation');
        
        parent::display('v_config_sistem', $data);
    }
    
    function ubah_sistem() {
        //control hak akses update
        $this->_set_page_role('u');
        //set validasi id        
            redirect('config_sistem');
        //load library form validation
        $this->load->library('form_validation');
        //load model
        $this->load->model('m_config_sistem');
        $data['rs_periode_ku'] = $this->m_config_sistem->ambil_data_periode();
        //jika tidak dipencet
        parent::display('v_config_sistem',$data);
    }

    function proses_ubah_sistem() {
        //set validasi tombol simpan
        if ($this->input->post('simpan') == null)
            redirect('config_sistem');
        //load library form validation
        $this->load->library('Form_validation');
        $this->form_validation->set_rules('status_sistem', 'Status Sistem', 'required|trim');
        $this->form_validation->set_rules('periode_sistem', 'Periode Sistem', 'required|trim');
        

        if ($this->form_validation->run() === FALSE) {
            //set pesan notifikasi eror
            $this->notification('error', validation_errors());
            //data form disimpan biar nanti user ga masukin lagi
            $this->form_validation->keep_data();
            //kembalikan lagi ke form ubah data dengan parameter id_informasi
            redirect('config_sistem/ubah_sistem/'. $this->input->post('status_sistem'));
        } else {
            //jika validasi sukses
            $this->load->model('m_config_sistem');
            $parameter = array(
                $this->input->post('status_sistem'),
                $this->input->post('periode_sistem')
            );
            if ($this->m_config_sistem->ubah_sistem($parameter)) {
                //jika berhasil insert
                $this->notification('success', 'Sistem berhasil diaktifkan');
                //arahkan kembali ke form edit
                redirect('config_sistem/ubah_sistem/'. $this->input->post('status_sistem'));
            } else {
                //jika gagal
                $this->notification('error', 'Sistem Gagal diaktifkan');
                //arahkan kembali ke form edit
                redirect('config_sistem/ubah_sistem/'. $this->input->post('status_sistem'));
            }
            redirect('config_sistem');
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
