<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class periode extends operator_base {

    var $batas = 15;

    public function index($offset = 0) {
        $this->_set_page_role('r');
        $this->load->model('m_periode');
        $this->load->library('bagi_halaman');
        $data['rs_periode'] = $this->m_periode->ambil_periode(array(intval($offset), $this->batas));
        $data['total_data'] = $this->m_periode->count_all_data();
        $data['jml_data'] = count($data['rs_periode']);
        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($data['total_data'], $this->batas, 'periode/index');

        parent::display('tampil_periode', $data);
    }

    function tambah_periode() {
        //control hak akses
        $this->_set_page_role('c');
        if ($this->input->post('simpan') != '') {
            //jika tombol simpan dipencet
            $this->load->library('form_validation');
            $this->form_validation->set_rules('tahun_periode', 'Judul Informasi', 'required|trim');                        
            if ($this->form_validation->run() === FALSE) {
                $pesan['css'] = 'alert-error';
                $pesan['psn'] = validation_errors();
                $this->session->set_flashdata('pesan', $pesan);
                parent::display('tambah_periode');
            } else {
                $this->load->model('m_periode');
                $parameter = array(
                    $this->sesi->get_data_login('ID_PENGGUNA'),
                    $this->input->post('tahun_periode')
                                        
                );
                if ($this->m_periode->tambah_periode($parameter)) {
                    //jika berhasil insert
                    //pesan sukses untuk ditampilkan dalam view
                    $pesan['css'] = 'alert-success';
                    $pesan['psn'] = 'Periode berhasil ditambahkan!';
                } else {
                    //jika gagal
                }
                $this->session->set_flashdata('pesan', $pesan);
                redirect('periode');
            }
        } else {
            //jika tidak dipencet
            parent::display('tambah_periode');
        }
    }
}