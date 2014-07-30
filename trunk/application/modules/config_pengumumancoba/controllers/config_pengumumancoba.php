<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class config_pengumumancoba extends operator_base {

    var $batas = 15;

    public function index($offset = 0) {
        //control hak akses read
        $this->_set_page_role('r');
        //load model
        $this->load->model('m_config_pengumuman');
        $this->load->library('Form_validation');
        
        parent::display('v_config_pengumuman');
    }
    
    function ubah_config_pengumuman($id = '') {
        //control hak akses update
        $this->_set_page_role('u');
        //set validasi id
        if (empty($id))
            redirect('config_pengumumancoba');
        //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');
        //load library form validation
        $this->load->library('Form_validation');
        //load model
        $this->load->model('m_config_pengumuman');
        //ambil data informasi berdasarkan id informasi
        $data['result_config_pengumuman'] = $this->m_config_pengumuman->get_config_pengumuman_by_id($id);
        //jika tidak dipencet
        parent::display('ubah_config_pengumuman', $data);
    }

    function proses_ubah_config_pengumuman() {
        //set validasi tombol simpan
        if ($this->input->post('simpan') == null)
            redirect('config_pengumumancoba');
        //load library form validation
        $this->load->library('Form_validation');
        $this->form_validation->set_rules('pengumuman_admin', 'Pengumuman Admin', 'required|trim');        

        if ($this->form_validation->run() === FALSE) {
            //set pesan notifikasi eror
            $this->notification('error', validation_errors());
            //data form disimpan biar nanti user ga masukin lagi
            $this->form_validation->keep_data();
            //kembalikan lagi ke form ubah data dengan parameter id_informasi
            redirect('config_pengumumancoba/ubah_config_pengumuman/' . $this->input->post('pengumuman_admin'));
        } else {
            //jika validasi sukses
            $this->load->model('m_config_pengumuman');
            $parameter = array(                
                $this->input->post('pengumuman_admin')                
            );
            if ($this->m_config_pengumuman->ubah_config_pengumuman($parameter)) {
                //jika berhasil insert
                $this->notification('success', 'Data berhasil dirubah');
                //arahkan kembali ke form edit
                redirect('config_pengumuman/ubah_config_pengumuman/' . $this->input->post('pengumuman_admin'));
            } else {
                //jika gagal
                $this->notification('error', 'Data gagal dirubah');
                //arahkan kembali ke form edit
                redirect('config_pengumuman/ubah_config_pengumuman/' . $this->input->post('pengumuman_admin'));
            }
            redirect('config_pengumumancoba');
        }
    }
}