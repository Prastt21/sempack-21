<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class data_rujukan_asuransi extends operator_base {

    var $batas = 15;

    public function index($offset = 0) {
        //control hak akses read
        $this->_set_page_role('r');
        //load model
        $this->load->model('m_data_rujukan_asuransi');
        //load library
        $this->load->library('bagi_halaman');

        $data['rs_data_rujukan_asuransi'] = $this->m_data_rujukan_asuransi->ambil_data_rujukan_asuransi(array(intval($offset), $this->batas));
        $data['total_data'] = $this->m_data_rujukan_asuransi->count_all_data();
        $data['jml_data'] = count($data['rs_data_rujukan_asuransi']);
        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($data['total_data'], $this->batas, 'data_rujukan_asuransi/index');

        parent::display('tampil_data_rujukan_asuransi', $data);
    }
    
    function ubah_data_rujukan_asuransi($id = '') {
        //control hak akses update
        $this->_set_page_role('u');
        //set validasi id
        if (empty($id))
            redirect('data_rujukan_asuransi');
        //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');
        //load library form validation
        $this->load->library('form_validation');
        //load model
        $this->load->model('m_data_rujukan_asuransi');
        //ambil data informasi berdasarkan id informasi
        $data['result_data_rujukan_asuransi'] = $this->m_data_rujukan_asuransi->get_data_rujukan_asuransi_by_id($id);
        //jika tidak dipencet
        parent::display('ubah_data_rujukan_asuransi', $data);
    }

    function proses_ubah_data_rujukan_asuransi() {
        //set validasi tombol simpan
        if ($this->input->post('simpan') == null)
            redirect('data_rujukan_asuransi');
        //load library form validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('jenis_asuransi', 'Jenis Asuransi', 'required|trim');
        //$this->form_validation->set_rules('nama_perujuk', 'Nama Perujuk', 'required|trim');
        $this->form_validation->set_rules('nama_rs', 'Nama Rumah Sakit', 'required|trim');
        $this->form_validation->set_rules('alamat_rs', 'Alamat Rumah Sakit', 'required|trim');
        $this->form_validation->set_rules('kronologi', 'Kronologi', 'required|trim');
        $this->form_validation->set_rules('tanggal_daftar', 'Tanggal Daftar', 'required|trim');
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required|trim');
        $this->form_validation->set_rules('tanggal_keluar', 'Tanggal Keluar', 'required|trim');
        $this->form_validation->set_rules('total_biaya', 'Total Biaya', 'required|trim');
        $this->form_validation->set_rules('santunan', 'Santunan', 'required|trim');
        $this->form_validation->set_rules('status_asuransi', 'Status Asuransi', 'required|trim');
        $this->form_validation->set_rules('id_asuransi', 'ID Asuransi', 'required');

        if ($this->form_validation->run() === FALSE) {
            //set pesan notifikasi eror
            $this->notification('error', validation_errors());
            //data form disimpan biar nanti user ga masukin lagi
            $this->form_validation->keep_data();
            //kembalikan lagi ke form ubah data dengan parameter id_informasi
            redirect('data_rujukan_asuransi/ubah_data_rujukan_asuransi/' . $this->input->post('id_asuransi'));
        } else {
            //jika validasi sukses
            $this->load->model('m_data_rujukan_asuransi');
            $parameter = array(                
                $this->input->post('jenis_asuransi'),
                $this->sesi->get_data_login('ID_PENGGUNA'),
                $this->input->post('nama_rs'),
                $this->input->post('alamat_rs'),
                $this->input->post('kronologi'),
                $this->input->post('tanggal_daftar'),
                $this->input->post('tanggal_masuk'),
                $this->input->post('tanggal_keluar'),
                $this->input->post('total_biaya'),
                $this->input->post('santunan'),
                $this->input->post('status_asuransi'),
                $this->input->post('id_asuransi')
            );
            if ($this->m_data_rujukan_asuransi->ubah_data_rujukan_asuransi($parameter)) {
                //jika berhasil insert
                $this->notification('success', 'Data berhasil dirubah');
                //arahkan kembali ke form edit
                redirect('data_rujukan_asuransi/ubah_data_rujukan_asuransi/' . $this->input->post('id_asuransi'));
            } else {
                //jika gagal
                $this->notification('error', 'Data gagal dirubah');
                //arahkan kembali ke form edit
                redirect('data_rujukan_asuransi/ubah_data_rujukan_asuransi/' . $this->input->post('id_asuransi'));
            }
            redirect('data_rujukan_asuransi');
        }
    }

    function hapus_data_rujukan_asuransi($id = '') {
        //control hak akses delete
        $this->_set_page_role('d');
        if (empty($id))
            redirect('data_rujukan_asuransi');
        //load model
        $this->load->model('m_data_rujukan_asuransi');
        if ($this->m_data_rujukan_asuransi->hapus_data_rujukan_asuransi($id)) {
            //jika berhasil menghapus
            $this->notification('success', 'Data berhasil dihapus');
        } else {
            //jika gagal menghapus
            $this->notification('error', 'Data gagal dihapus');
        }
        //kembalikan ke halaman list informasi
        redirect('data_rujukan_asuransi');
    }

}