<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class jenis_beasiswa extends operator_base {

    var $batas = 15;

    public function index($offset = 0) {
        $this->_set_page_role('r');
        $this->load->model('m_jenis_beasiswa');
        $this->load->library('bagi_halaman');
        $data['rs_jenis_beasiswa'] = $this->m_jenis_beasiswa->ambil_jenis_beasiswa(array(intval($offset), $this->batas));
        $data['total_data'] = $this->m_jenis_beasiswa->count_all_data();
        $data['jml_data'] = count($data['rs_jenis_beasiswa']);
        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($data['total_data'], $this->batas, 'jenis_beasiswa/index');

        parent::display('tampil_jenis_beasiswa', $data);
    }

    function tambah_jenis_beasiswa() {
        //control hak akses
        $this->_set_page_role('c');
        if ($this->input->post('simpan') != '') {
            //jika tombol simpan dipencet
            $this->load->library('form_validation');
            $this->form_validation->set_rules('jenis_beasiswa', 'Judul Informasi', 'required|trim');
            $this->form_validation->set_rules('warna_beasiswa', 'Isi Informasi', 'required|trim');            
            if ($this->form_validation->run() === FALSE) {
                $pesan['css'] = 'alert-error';
                $pesan['psn'] = validation_errors();
                $this->session->set_flashdata('pesan', $pesan);
                parent::display('tambah_jenis_beasiswa');
            } else {
                $this->load->model('m_jenis_beasiswa');
                $parameter = array(
                    $this->sesi->get_data_login('ID_PENGGUNA'),
                    $this->input->post('jenis_beasiswa'),
                    $this->input->post('warna_beasiswa')                    
                );
                if ($this->m_jenis_beasiswa->tambah_jenis_beasiswa($parameter)) {
                    //jika berhasil insert
                    //pesan sukses untuk ditampilkan dalam view
                    $pesan['css'] = 'alert-success';
                    $pesan['psn'] = 'Jenis Beasiswa berhasil ditambahkan!';
                } else {
                    //jika gagal
                }
                $this->session->set_flashdata('pesan', $pesan);
                redirect('jenis_beasiswa');
            }
        } else {
            //jika tidak dipencet
            parent::display('tambah_jenis_beasiswa');
        }
    }
}