<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    require_once APPPATH . 'controllers/operator_base.php';
    
class data_operator extends operator_base {

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
        if ($this->input->post('simpan') != NULL) {
            //load library form validation
            $this->load->library('form_validation');
            //set validasi form
            $this->form_validation->set_rules('id_level', 'Level', 'required');
            $this->form_validation->set_rules('nama_operator', 'Nama Operator', 'required|numeric');
            $this->form_validation->set_rules('status_operator', 'Status Operator', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required|matches[kata_sandi_2]');
            $this->form_validation->set_rules('ulangi_password', 'Konfirmasi Password', 'required');
            $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
            $this->form_validation->set_rules('telephone', 'Telephone', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
            $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
            $this->form_validation->set_rules('tanggal', 'Tanggal Lahir', 'required|numeric');
            $this->form_validation->set_rules('email', 'Email', 'required');
            

           if ($this->form_validation->run() === FALSE) {
                $pesan['css'] = 'alert-error';
                $pesan['psn'] = validation_errors();
                $this->session->set_flashdata('pesan', $pesan);
                parent::display('tambah_data_operator');
            } else {
                $this->load->model('m_data_operator');
                $parameter = array(
                    $this->input->post('level', TRUE),
                    $this->input->post('nama_operator', TRUE),
                    $this->input->post('status_operator', TRUE),
                    $this->input->post('username', TRUE),
                    md5($this->input->post('kata_sandi_1', TRUE)),
                    $this->input->post('gender', TRUE),
                    $this->input->post('telepon', TRUE),
                    $this->input->post('alamat', TRUE),
                    $this->input->post('tempat', TRUE),
                    $this->input->post('tanggal_lahir', TRUE),
                    $this->input->post('email', TRUE),
                    );
                if ($this->m_data_informasi->tambah_data_informasi($parameter)) {
                    //jika berhasil insert
                    //pesan sukses untuk ditampilkan dalam view
                    $pesan['css'] = 'alert-success';
                    $pesan['psn'] = 'Operator berhasil ditambahkan!';
                } else {
                    //jika gagal
                }
                $this->session->set_flashdata('pesan', $pesan);
                redirect('data_operator');
                }
            }
        else {
            //jika tidak dipencet
            parent::display('tambah_data_operator');
        }
    }
}

?>
