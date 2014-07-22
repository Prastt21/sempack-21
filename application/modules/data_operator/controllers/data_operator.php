<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class data_operator extends operator_base {

    public function __construct() {
        parent::__construct();
    }

    var $batas = 15;

    function index($offset = 0) {
        $this->_set_page_role('r');
        $this->load->model('m_data_operator');
        $this->load->library('bagi_halaman');
        $data['rs_operator'] = $this->m_data_operator->ambil_data_operator(array(intval($offset), $this->batas));
        $data['total_data'] = $this->m_data_operator->count_all_data();
        //$data['rs_level'] = $this->m_data_operator->ambil_data_level();
        $data['jml_data'] = count($data['rs_operator']);
        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($data['total_data'], $this->batas, 'data_operator/index');

        parent::display('tampil_data_operator', $data);
    }

    function tambah_data_operator() {
        $this->_set_page_role('c');
        //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');
        //load form validation
        $this->load->library('form_validation');
        //load model
        $this->load->model('m_data_operator');
        //get data level operator
        $data['rs_level'] = $this->m_data_operator->ambil_data_level();
        parent::display('tambah_data_operator', $data);
    }

    function proses_tambah_data_operator() {
        if ($this->input->post('simpan') == null)
            redirect('data_operator');
        //load library form validation
        $this->load->library('form_validation');
        //set validasi form
        $this->form_validation->set_rules('level', 'Level', 'required');
        $this->form_validation->set_rules('nama_operator', 'Nama Operator', 'required');
        $this->form_validation->set_rules('status', 'Status Operator', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|matches[ulangi_password]');
        $this->form_validation->set_rules('ulangi_password', 'Konfirmasi Password', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('telephone', 'Telephone', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');


        if ($this->form_validation->run() === FALSE) {
            //set notifikasi
            $this->notification('error', validation_errors());
            //simpan data yang sudah diisi
            $this->form_validation->keep_data();
            redirect('data_operator/tambah_data_operator');
        } else {
            $this->load->model('m_data_operator');
            $parameter = array(
                $this->input->post('level', TRUE),
                $this->input->post('nama_operator', TRUE),
                $this->input->post('status', TRUE),
                $this->input->post('username', TRUE),
                md5($this->input->post('password', TRUE)),
                $this->input->post('jenis_kelamin', TRUE),
                $this->input->post('telephone', TRUE),
                $this->input->post('alamat', TRUE),
                $this->input->post('tempat_lahir', TRUE),
                $this->input->post('tanggal', TRUE),
                $this->input->post('email', TRUE),
            );
            if ($this->m_data_operator->tambah_data_operator($parameter)) {
                //set notifikasi berhasil
                $this->notification('success', 'Data berhasil ditambahkan');
            } else {
                //set notifikasi gagal
                $this->notification('error', 'Data gagal ditambahkan');
            }
            redirect('data_operator');
        }
    }

    function ubah_data_operator($id = '') {
        $this->_set_page_role('u');
        if (empty($id))
            redirect('data_operator');
        //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');
        //load form validation
        $this->load->library('form_validation');
        //load model
        $this->load->model('m_data_operator');
        //get data level operator
        $data['rs_level'] = $this->m_data_operator->ambil_data_level();
        //get data operator by id
        $data['result_operator'] = $this->m_data_operator->get_data_operator_by_id($id);
        parent::display('ubah_data_operator', $data);
    }

    function proses_ubah_data_operator() {
        if ($this->input->post('simpan') == null)
            redirect('data_operator');
        //load library form validation
        $this->load->library('form_validation');
        //set validasi form
        $this->form_validation->set_rules('id_pengguna', 'ID Pengguna', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');
        $this->form_validation->set_rules('nama_operator', 'Nama Operator', 'required');
        $this->form_validation->set_rules('status', 'Status Operator', 'required');
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
            redirect('data_operator/ubah_data_operator/' . $this->input->post('id_pengguna'));
        } else {
            $this->load->model('m_data_operator');
            $parameter = array(
                $this->input->post('level', TRUE),
                $this->input->post('nama_operator', TRUE),
                $this->input->post('status', TRUE),
                $this->input->post('username', TRUE),
                $this->input->post('jenis_kelamin', TRUE),
                $this->input->post('telephone', TRUE),
                $this->input->post('alamat', TRUE),
                $this->input->post('tempat_lahir', TRUE),
                $this->input->post('tanggal', TRUE),
                $this->input->post('email', TRUE),
                $this->input->post('id_pengguna')
            );
            //jika password diisi , berarti ada perubahan password
            if ($this->input->post('password') != null && $this->input->post('ulangi_password') != null) {
                if ($this->m_data_operator->update_password_operator(array(md5($this->input->post('password')), $this->input->post('id_pengguna')))) {
                    //set notifikasi berhasil
                    $this->notification('success', 'Data berhasil dirubah');
                } else {
                    //set notifikasi gagal
                    $this->notification('error', 'Data gagal dirubah');
                }
            }
            //perubahan data
            if ($this->m_data_operator->update_data_operator($parameter)) {
                //set notifikasi berhasil
                $this->notification('success', 'Data berhasil dirubah');
            } else {
                //set notifikasi gagal
                $this->notification('error', 'Data gagal dirubah');
            }
            redirect('data_operator/ubah_data_operator/' . $this->input->post('id_pengguna'));
        }
    }
    
    function hapus_data_operator($id = '') {
        //control hak akses delete
        $this->_set_page_role('d');
        if (empty($id))
            redirect('data_operator');
        //load model
        $this->load->model('m_data_operator');
        if ($this->m_data_operator->delete_operator($id)) {
            //jika berhasil menghapus
            $this->notification('success', 'Data berhasil dihapus');
        } else {
            //jika gagal menghapus
            $this->notification('error', 'Data gagal dihapus');
        }
        //kembalikan ke halaman list informasi
        redirect('data_operator');
    }

}