<?php

/*
 * By : Praditya Kurniawan
 * website : http://masiyak.com
 * email : aku@masiyak.com
 * 
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class autentifikasi extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if ($this->sesi->sudah_login())
            redirect($this->sesi->get_data_login('portal'));
        else
            $this->login();
    }

    function login() {
        $this->load->view('login');
    }

    function proses_login() {
        if ($this->input->post() != null) {
            //load library form validation
            $this->load->library('form_validation');

            $this->form_validation->set_rules('username', 'username', 'required|trim');
            $this->form_validation->set_rules('password', 'password', 'required|trim');
            if ($this->form_validation->run() !== false) {
                //load model
                $this->load->model('m_autentifikasi');
                $pengguna = $this->input->post('username', true);
                $kunci = md5($this->input->post('password', true));
                $r_login = $this->m_autentifikasi->cek_pengguna(array($pengguna, $kunci));
                if (is_array($r_login)) {
                    $this->sesi->set_nama_lengkap('Nama Lengkap');
                    $this->sesi->set_nama_pengguna('Nama Pengguna');
                    $this->sesi->set_id($r_login['Id_Login']);
                    $this->sesi->set_level('ADMINISTRATOR');
                    $this->sesi->set_nama_level('Nama Level');
                    $this->sesi->set_portal($r_login['Portal_Level']);
                    $this->sesi->do_login();
                    redirect($r_login['Portal_Level']);
                } else {
                    $data['pesan'] = '<span class="alert-login">Autentifikasi gagal.<br>Nama Pengguna dan Kata Kunci tidak terdaftar dalam sistem.</span>';
                    $this->session->set_flashdata('msg', $data);
                    redirect('autentifikasi');
                }
            } else {
                redirect('autentifikasi');
            }
        } else {
            redirect('autentifikasi');
        }
    }

    function proses_logout() {
        $this->sesi->keluar();
        redirect('autentifikasi');
    }

}
