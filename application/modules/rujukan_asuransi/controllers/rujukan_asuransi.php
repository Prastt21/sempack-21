<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class rujukan_asuransi extends operator_base {

    var $batas = 15;

    public function index($offset = 0) {
        $this->_set_page_role('r');
        $this->load->model('m_rujukan_asuransi');
        $this->load->library('bagi_halaman');
        $data['rs_rujukan_asuransi'] = $this->m_rujukan_asuransi->ambil_rujukan_asuransi(array(intval($offset), $this->batas));
        $data['total_data'] = $this->m_rujukan_asuransi->count_all_data();
        $data['jml_data'] = count($data['rs_rujukan_asuransi']);
        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($data['total_data'], $this->batas, 'rujukan_asuransi/index');

        parent::display('tampil_rujukan_asuransi', $data);
    }

    function tambah_rujukan_asuransi() {
        //control hak akses
        $this->_set_page_role('c');
        if ($this->input->post('simpan') != '') {
            //jika tombol simpan dipencet
            $this->load->library('form_validation');
            $this->form_validation->set_rules('jenis_asuransi', 'Jenis Asuransi', 'required|trim');
            $this->form_validation->set_rules('nama_perujuk', 'Nama Perujuk', 'required|trim');
            $this->form_validation->set_rules('nama_rs', 'Nama Rumah Sakit', 'required|trim');
            $this->form_validation->set_rules('alamat_rs', 'Alamat Rumah Sakit', 'required|trim');
            $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required|trim');
            $this->form_validation->set_rules('tanggal_keluar', 'Tanggal Keluar', 'required|trim');
            $this->form_validation->set_rules('total_biaya', 'Alamat Rumah Sakit', 'required|trim');
            $this->form_validation->set_rules('santunan', 'santunan', 'required|trim');
            

            if ($this->form_validation->run() === FALSE) {
                $pesan['css'] = 'alert-error';
                $pesan['psn'] = validation_errors();
                $this->session->set_flashdata('pesan', $pesan);
                parent::display('tambah_rujukan_asuransi');
            } else {
                $this->load->model('m_rujukan_asuransi');
                $parameter = array(
                    $this->sesi->get_data_login('ID_PENGGUNA'),
                    $this->input->post('jenis_asuransi'),
                    $this->input->post('nama_rs'),
                    $this->input->post('alamat_rs'),
                    $this->input->post('tanggal_masuk'),
                    $this->input->post('tanggal_keluar'),
                    $this->input->post('total_biaya'),
                    $this->input->post('santunan')
                    
                );
                if ($this->m_rujukan_asuransi->tambah_rujukan_asuransi($parameter)) {
                    //jika berhasil insert
                    //pesan sukses untuk ditampilkan dalam view
                    $pesan['css'] = 'alert-success';
                    $pesan['psn'] = 'Rujukan Asuransi berhasil ditambahkan!';
                } else {
                    //jika gagal
                }
                $this->session->set_flashdata('pesan', $pesan);
                redirect('rujukan_asuransi');
            }
        } else {
            //jika tidak dipencet
            parent::display('tambah_rujukan_asuransi');
        }
    }
    function ubah_rujukan_asuransi() {
        //control hak akses
        $this->_set_page_role('u');
        if ($this->input->post('simpan') != '') {
            //jika tombol simpan dipencet
            $this->load->library('form_validation');
            $this->form_validation->set_rules('judul_informasi', 'Judul Informasi', 'required|trim');
            $this->form_validation->set_rules('isi_informasi', 'Isi Informasi', 'required|trim');
            $this->form_validation->set_rules('jenis', 'Jenis Informasi', 'required|trim');
            $idi = $this->input->post('Id_Informasi', TRUE);
            
            if ($this->form_validation->run() === FALSE) {
                $pesan['css'] = 'alert-error';
                $pesan['psn'] = validation_errors();
                $this->session->set_flashdata('pesan', $pesan);
                redirect('data_informasi/ubah_data_informasi' . $idi);
                parent::display('ubah_data_informasi');
            } else {
                $this->load->model('m_data_informasi');
                $parameter = array(
                    $this->sesi->get_data_login('ID_PENGGUNA'),
                    $informasi['Judul_Info'] = ucfirst($this->input->post('judul_informasi', TRUE)),
                    $informasi['Isi_Info'] = $this->input->post('isi_informasi', TRUE),
                    $informasi['Jenis_Info'] = $this->input->post('jenis', TRUE)                
                );
                if ($this->m_data_informasi->tambah_data_informasi($parameter)) {
                    //jika berhasil insert
                    //pesan sukses untuk ditampilkan dalam view
                    $pesan['css'] = 'alert-success';
                    $pesan['psn'] = 'Informasi berhasil disimpan!';
                } else {
                    //jika gagal
                }
                $this->session->set_flashdata('pesan', $pesan);
                redirect('data_informasi');
            }
        } else {
            //jika tidak dipencet
            parent::display('ubah_data_informasi');
        }
    }

}