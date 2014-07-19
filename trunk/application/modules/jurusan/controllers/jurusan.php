<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class jurusan extends operator_base {

    var $batas = 15;

    public function index($offset = 0) {
        $this->_set_page_role('r');
        $this->load->model('m_jurusan');
        $this->load->library('bagi_halaman');
        $data['rs_jurusan'] = $this->m_jurusan->ambil_jurusan(array(intval($offset), $this->batas));
        $data['total_data'] = $this->m_jurusan->count_all_data();
        $data['jml_data'] = count($data['rs_jurusan']);
        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($data['total_data'], $this->batas, 'jurusan/index');

        parent::display('tampil_jurusan', $data);
    }

    function tambah_jurusan() {
        //control hak akses
        $this->_set_page_role('c');
        if ($this->input->post('simpan') != '') {
            //jika tombol simpan dipencet
            $this->load->library('form_validation');
            $this->form_validation->set_rules('nama_jurusan', 'Nama Jurusan', 'required|trim');
            $this->form_validation->set_rules('singkatan_jurusan', 'Singkatan Jurusan', 'required|trim');
            $this->form_validation->set_rules('warna_jurusan', 'Warna Jurusan', 'required|trim');
            
            if ($this->form_validation->run() === FALSE) {
                $pesan['css'] = 'alert-error';
                $pesan['psn'] = validation_errors();
                $this->session->set_flashdata('pesan', $pesan);
                parent::display('tambah_jurusan');
            } else {
                $this->load->model('m_jurusan');
                $parameter = array(
                    $this->sesi->get_data_login('ID_PENGGUNA'),
                    $this->input->post('nama_jurusan'),
                    $this->input->post('singkatan_jurusan'),
                    $this->input->post('warna_jurusan')
                );
                if ($this->m_jurusan->tambah_jurusan($parameter)) {
                    //jika berhasil insert
                    //pesan sukses untuk ditampilkan dalam view
                    $pesan['css'] = 'alert-success';
                    $pesan['psn'] = 'Jurusan berhasil ditambahkan!';
                } else {
                    //jika gagal
                }
                $this->session->set_flashdata('pesan', $pesan);
                redirect('jurusan');
            }
        } else {
            //jika tidak dipencet
            parent::display('tambah_jurusan');
        }
    }
}