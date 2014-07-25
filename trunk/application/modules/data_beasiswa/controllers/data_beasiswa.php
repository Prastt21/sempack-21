<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class data_beasiswa extends operator_base {

    public function __construct() {
        parent::__construct();
    }

    var $batas = 15;

    function index($offset = 0) {
        $this->_set_page_role('r');
        $this->load->model('m_data_beasiswa');
        $this->load->library('bagi_halaman');
        $data['rs_data_beasiswa'] = $this->m_data_beasiswa->ambil_data_beasiswa(array(intval($offset), $this->batas));
        $data['total_data'] = $this->m_data_beasiswa->count_all_data();
        $data['jml_data'] = count($data['rs_data_beasiswa']);
        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($data['total_data'], $this->batas, 'data_beasiswa/index');

        parent::display('tampil_data_beasiswa', $data);
    }

    function ubah_data_beasiswa($id = '') {
        $this->_set_page_role('u');
        if (empty($id))
            redirect('data_beasiswa');
        //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');
        //load form validation
        $this->load->library('form_validation');
        //load model
        $this->load->model('m_data_beasiswa');
        //get data jenis beasiswa
        $data['rs_jenis_beasiswa'] = $this->m_data_beasiswa->ambil_jenis_beasiswa();
        //get data jurusan
        $data['rs_jurusan'] = $this->m_data_beasiswa->ambil_jurusan();
        //get beasiswa by id
        $data['result_data_beasiswa'] = $this->m_data_beasiswa->get_data_beasiswa_by_id($id);
        parent::display('ubah_data_beasiswa', $data);
    }

    function proses_ubah_data_beasiswa() {
        if ($this->input->post('simpan') == null)
            redirect('data_beasiswa');
        //load library form validation
        $this->load->library('form_validation');
        //set validasi form
        $this->form_validation->set_rules('jenis_beasiswa', 'Jenis Beasiswa', 'required');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
        $this->form_validation->set_rules('jenjang', 'Jenjang', 'required');
        $this->form_validation->set_rules('alamat_sekarang', 'Alamat Sekarang', 'required');
        $this->form_validation->set_rules('nama_pt', 'Nama Pergururan Tinggi', 'required');
        $this->form_validation->set_rules('semester', 'Semester', 'required');
        $this->form_validation->set_rules('ipk', 'IPK', 'required');
        $this->form_validation->set_rules('prestasi', 'Prestasi', 'required');
        $this->form_validation->set_rules('alasan', 'Alasan', 'required');
        $this->form_validation->set_rules('bank', 'Bank', 'required');
        $this->form_validation->set_rules('no_rekening', 'No Rekening', 'required');
        $this->form_validation->set_rules('tanggal_daftar', 'Tanggal Daftar', 'required');
        $this->form_validation->set_rules('status_beasiswa', 'Status Beasiswa', 'required');
        $this->form_validation->set_rules('id_beasiswa', 'ID Beasiswa', 'required');        
       
        if ($this->form_validation->run() === FALSE) {
            //set notifikasi
            $this->notification('error', validation_errors());
            //simpan data yang sudah diisi
            $this->form_validation->keep_data();
            redirect('data_beasiswa/ubah_data_beasiswa/' . $this->input->post('id_beasiswa'));
        } else {
            $this->load->model('m_data_beasiswa');
            $parameter = array(
                $this->input->post('jenis_beasiswa'),
                $this->sesi->get_data_login('ID_PENGGUNA'),
                $this->input->post('jurusan'),
                $this->input->post('jenjang'),
                $this->input->post('alamat_sekarang'),
                $this->input->post('nama_pt'),
                $this->input->post('semester'),
                $this->input->post('ipk'),
                $this->input->post('prestasi'),
                $this->input->post('alasan'),
                $this->input->post('bank'),
                $this->input->post('no_rekening'),
                $this->input->post('tanggal_daftar'),
                $this->input->post('status_beasiswa'),
                $this->input->post('id_beasiswa')
            );
            //perubahan data
            if ($this->m_data_beasiswa->ubah_data_beasiswa($parameter)) {
                //jika berhasil insert
                $this->notification('success', 'Data berhasil dirubah');
                //arahkan kembali ke form edit
                redirect('data_beasiswa/ubah_data_beasiswa/' . $this->input->post('id_beasiswa'));
            } else {
                //jika gagal
                $this->notification('error', 'Data gagal dirubah');
                //arahkan kembali ke form edit
                redirect('data_beasiswa/ubah_data_beasiswa/' . $this->input->post('id_beasiswa'));
            }
            redirect('data_beasiswa');
        }
    }
    
    function hapus_data_beasiswa($id = '') {
        //control hak akses delete
        $this->_set_page_role('d');
        if (empty($id))
            redirect('data_beasiswa');
        //load model
        $this->load->model('m_data_beasiswa');
        if ($this->m_data_beasiswa->hapus_data_beasiswa($id)) {
            //jika berhasil menghapus
            $this->notification('success', 'Data berhasil dihapus');
        } else {
            //jika gagal menghapus
            $this->notification('error', 'Data gagal dihapus');
        }
        //kembalikan ke halaman list informasi
        redirect('data_beasiswa');
    }

}