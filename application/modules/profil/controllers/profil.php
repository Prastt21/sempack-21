<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class profil extends operator_base {

    public function __construct() {
        parent::__construct();
    }

    var $batas = 15;

    function index($offset = 0,$id='') {
        $this->_set_page_role('r');
        $this->load->model('m_profil');
        //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');
        //load form validation
        $this->load->library('form_validation');
        $data['rs_profil'] = $this->m_profil->ambil_profil(array(intval($offset), $this->batas));
        $data['result_profil'] = $this->m_profil->get_profil_by_id($id);
        parent::display('ubah_profil', $data);
    }
    function ubah_profil($id = '') {
        $this->_set_page_role('u');
        if (empty($id))
            redirect('profil');
        //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');
        //load form validation
        $this->load->library('form_validation');
        //load model
        $this->load->model('m_profil');        
        //get data operator by id
        $data['result_profil'] = $this->m_profil->get_profil_by_id($id);
        parent::display('ubah_profil', $data);
    }

    function proses_ubah_profil() {
        if ($this->input->post('simpan') == null)
            redirect('profil');
        //load library form validation
        $this->load->library('form_validation');
        //set validasi form
        $this->form_validation->set_rules('nama_pengguna', 'Nama Pengguna', 'required');
        $this->form_validation->set_rules('status', 'Status pengguna', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('telephone', 'Telephone', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        //jika password diisi , berarti ada perubahan password
        if ($this->input->post('password') != null && $this->input->post('ulangi_password') != null) {
            $this->form_validation->set_rules('password', 'Password', 'required|matches[ulangi_password]');
            $this->form_validation->set_rules('ulangi_password', 'Konfirmasi Password', 'required');
        }

        if ($this->form_validation->run() === FALSE) {
            //set notifikasi
            $this->notification('error', validation_errors());
            //simpan data yang sudah diisi
            $this->form_validation->keep_data();
            redirect('profil/ubah_profil/' . $this->input->post('id_pengguna'));
        } else {
            $this->load->model('m_profil');
            $parameter = array(
                $this->input->post('nama_pengguna', TRUE),
                $this->input->post('status', TRUE),
                $this->input->post('username', TRUE),
                $this->input->post('jenis_kelamin', TRUE),
                $this->input->post('telephone', TRUE),
                $this->input->post('alamat', TRUE),
                $this->input->post('tempat_lahir', TRUE),
                $this->input->post('tanggal', TRUE),
                $this->input->post('email', TRUE),
                $this->sesi->get_data_login('ID_PENGGUNA')
            );
            //jika password diisi , berarti ada perubahan password
            if ($this->input->post('password') != null && $this->input->post('ulangi_password') != null) {
                if ($this->m_profil->update_password_profil(array(md5($this->input->post('password')), $this->input->post('id_pengguna')))) {
                    //set notifikasi berhasil
                    $this->notification('success', 'Data berhasil dirubah');
                } else {
                    //set notifikasi gagal
                    $this->notification('error', 'Data gagal dirubah');
                }
            }
            //perubahan data
            if ($this->m_profil->update_profil($parameter)) {
                //set notifikasi berhasil
                $this->notification('success', 'Data berhasil dirubah');
            } else {
                //set notifikasi gagal
                $this->notification('error', 'Data gagal dirubah');
            }
            redirect('profil/ubah_profil/' . $this->input->post('id_pengguna'));
        }
    }
}