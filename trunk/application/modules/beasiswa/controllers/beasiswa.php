<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class beasiswa extends operator_base {

    var $batas = 15;

    public function index($offset = 0) {
        //control hak akses read
        $this->_set_page_role('r');
        //load model
        $this->load->model('m_beasiswa');
        //load library
        $this->load->library('bagi_halaman');

        $data['rs_beasiswa'] = $this->m_beasiswa->ambil_beasiswa(array(intval($offset), $this->batas));
        $data['total_data'] = $this->m_beasiswa->count_all_data();
        $data['jml_data'] = count($data['rs_beasiswa']);
        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($data['total_data'], $this->batas, 'beasiswa/index');

        parent::display('tampil_beasiswa', $data);
    }

    function tambah_beasiswa() {
        //control hak akses create
        $this->_set_page_role('c');
        $this->load->library('Form_validation');
        //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');        
       // get data jenis beasiswa
        $data['rs_jenis_beasiswa'] = $this->m_beasiswa->ambil_jenis_beasiswa();
        // get data jurusan
        $data['rs_jurusan'] = $this->m_beasiswa->ambil_jurusan();
        parent::display('tambah_beasiswa', $data);
    }

    function proses_tambah_beasiswa() {
        //validasi tombol simpan, jika tidak ditekan maka redirect ke tampilan tambah informasi
        if ($this->input->post('simpan') == null)
            redirect('beasiswa/tambah_beasiswa');
        //load form validation
        $this->load->library('Form_validation');
        //set aturan validasi
            $this->form_validation->set_rules('jenis_beasiswa', 'Jenis Beasiswa', 'required|trim');
             $this->form_validation->set_rules('jurusan', 'Jurusan', 'required|trim');
            $this->form_validation->set_rules('jurusan', 'Jurusan', 'required|trim');
            $this->form_validation->set_rules('jenjang', 'Jenjang', 'required|trim');
            $this->form_validation->set_rules('alamat_sekarang', 'Alamat Sekarang', 'required|trim');
            $this->form_validation->set_rules('nama_pt', 'Nama Pergururan Tinggi', 'required|trim');
            $this->form_validation->set_rules('semester', 'Semester', 'required|trim');
            $this->form_validation->set_rules('ipk', 'IPK', 'required|trim');
            $this->form_validation->set_rules('prestasi', 'Prestasi', 'required|trim');
            $this->form_validation->set_rules('alasan', 'Alasan', 'required|trim');
            $this->form_validation->set_rules('bank', 'Bank', 'required|trim');
            $this->form_validation->set_rules('no_rekening', 'No Rekening', 'required|trim');
            $this->form_validation->set_rules('tanggal_daftar', 'Tanggal Daftar', 'required|trim');
            $this->form_validation->set_rules('status_beasiswa', 'Status Beasiswa', 'required|trim');
        //menjalankan validasi
        if ($this->form_validation->run() === FALSE) {
            //jika validasi ada yang eror, kirim notifikasi ke view
            $this->notification('error', validation_errors());
            $this->form_validation->keep_data();
            //redirect ke tampilan tambah data informasi
            redirect('beasiswa/tambah_beasiswa');
        } else {
            //load model
            $this->load->model('m_beasiswa');
            //set parameter array
            $parameter = array(                
                $this->input->post('jenis_beasiswa'),
                $this->sesi->get_data_login('ID_PENGGUNA'),
                $this->sesi->get_data_login('Id_Ortu'),
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
                $this->input->post('status_beasiswa')
            );
            if ($this->m_beasiswa->tambah_beasiswa($parameter)) {
                //jika sukses kirim pesan ke view
                $this->notification('success', 'Beasiswa berhasil ditambahkan');
            } else {
                //jika gagal kirim pesan ke view
                $this->notification('error', 'Beasiswa gagal ditambahkan');
            }
        }
        //redirect ke list informasi
        redirect('beasiswa');
    }

    function ubah_beasiswa($id = '') {
        //control hak akses update
        $this->_set_page_role('u');
        //set validasi id
        if (empty($id))
            redirect('beasiswa');
        //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');
        //load library form validation
        $this->load->library('form_validation');
        //load model
        $this->load->model('m_beasiswa');
        // get data jenis beasiswa
        $data['rs_jenis_beasiswa'] = $this->m_beasiswa->ambil_jenis_beasiswa();
        // get data jurusan
        $data['rs_jurusan'] = $this->m_beasiswa->ambil_jurusan();
        //ambil data informasi berdasarkan id informasi
        $data['result_beasiswa'] = $this->m_beasiswa->get_beasiswa_by_id($id);
        //jika tidak dipencet
        parent::display('ubah_beasiswa', $data);
    }

    function proses_ubah_beasiswa() {
        //set validasi tombol simpan
        if ($this->input->post('simpan') == null)
            redirect('beasiswa');
        //load library form validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('jenis_beasiswa', 'Jenis Beasiswa', 'required|trim');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required|trim');
        $this->form_validation->set_rules('jenjang', 'Jenjang', 'required|trim');
        $this->form_validation->set_rules('alamat_sekarang', 'Alamat Sekarang', 'required|trim');
        $this->form_validation->set_rules('nama_pt', 'Nama Pergururan Tinggi', 'required|trim');
        $this->form_validation->set_rules('semester', 'Semester', 'required|trim');
        $this->form_validation->set_rules('ipk', 'IPK', 'required|trim');
        $this->form_validation->set_rules('prestasi', 'Prestasi', 'required|trim');
        $this->form_validation->set_rules('alasan', 'Alasan', 'required|trim');
        $this->form_validation->set_rules('bank', 'Bank', 'required|trim');
        $this->form_validation->set_rules('no_rekening', 'No Rekening', 'required|trim');
        $this->form_validation->set_rules('tanggal_daftar', 'Tanggal Daftar', 'required|trim');
        $this->form_validation->set_rules('status_beasiswa', 'Status Beasiswa', 'required|trim');
        $this->form_validation->set_rules('id_beasiswa', 'ID Beasiswa', 'required');

        if ($this->form_validation->run() === FALSE) {
            //set pesan notifikasi eror
            $this->notification('error', validation_errors());
            //data form disimpan biar nanti user ga masukin lagi
            $this->form_validation->keep_data();
            //kembalikan lagi ke form ubah data dengan parameter id_informasi
            redirect('beasiswa/ubah_beasiswa/' . $this->input->post('id_beasiswa'));
        } else {
            //jika validasi sukses
            $this->load->model('m_beasiswa');
            $parameter = array(                
                $this->input->post('jenis_beasiswa'),
                $this->sesi->get_data_login('ID_PENGGUNA'),
                $this->sesi->get_data_login('Id_Ortu'),
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
            if ($this->m_beasiswa->ubah_beasiswa($parameter)) {
                //jika berhasil insert
                $this->notification('success', 'Data berhasil dirubah');
                //arahkan kembali ke form edit
                redirect('beasiswa/ubah_beasiswa/' . $this->input->post('id_beasiswa'));
            } else {
                //jika gagal
                $this->notification('error', 'Data gagal dirubah');
                //arahkan kembali ke form edit
                redirect('beasiswa/ubah_beasiswa/' . $this->input->post('id_beasiswa'));
            }
            redirect('beasiswa');
        }
    }

    function hapus_beasiswa($id = '') {
        //control hak akses delete
        $this->_set_page_role('d');
        if (empty($id))
            redirect('beasiswa');
        //load model
        $this->load->model('m_beasiswa');
        if ($this->m_beasiswa->hapus_beasiswa($id)) {
            //jika berhasil menghapus
            $this->notification('success', 'Data berhasil dihapus');
        } else {
            //jika gagal menghapus
            $this->notification('error', 'Data gagal dihapus');
        }
        //kembalikan ke halaman list informasi
        redirect('beasiswa');
    }

}