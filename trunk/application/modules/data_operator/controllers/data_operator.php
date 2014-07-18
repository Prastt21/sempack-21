<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . 'controllers/operator_base.php';
class data_operator extends operator_base {

    public function __construct() {
        parent::__construct();
      
    }

    var $banyakbaris = 25;

    function index($offset = 0) {
        //ambil data parameter dan data jenis
        $this->load->model('m_data_operator');
        $data['pengguna'] = $this->m_data_operator->tampil_data_operator($this->banyakbaris, $offset, null, null);

        //ambil jumlah data
        $this->load->model('app_model');
        $data['total_data'] = $this->app_model->hitung_data_tabel('pengguna');

        //load library untuk pagination
        $this->load->library('Bagi_halaman');
        $data['pagination'] = $this->bagi_halaman->paging($data['total_data'], $this->banyakbaris, 'data_operator');

        //tampilkan view
        parent::display('tampil_data_operator', $data);
    }

    function tambah_data_operator() {
        if ($this->input->post('simpan') != NULL) {
            //load library form validation
            $this->load->library('form_validation');
            //set validasi form
            $this->form_validation->set_rules('Nama_Pengguna', 'Nama Operator', 'required|numeric');
            $this->form_validation->set_rules('Status_Pengguna', 'Status Operator', 'required');
            $this->form_validation->set_rules('NIK_NIM', 'Username', 'required');
            $this->form_validation->set_rules('kata_sandi_1', 'Password', 'required|matches[kata_sandi_2]');
            $this->form_validation->set_rules('kata_sandi_2', 'Konfirmasi Password', 'required');
            $this->form_validation->set_rules('Gender', 'Konfirmasi Password', 'required');
            $this->form_validation->set_rules('No_Telp', 'Konfirmasi Password', 'required');
            $this->form_validation->set_rules('Alamat', 'Konfirmasi Password', 'required');
            $this->form_validation->set_rules('Tempat_Lahir', 'Konfirmasi Password', 'required');
            $this->form_validation->set_rules('Tanggal_Lahir', 'telepon', 'required|numeric');
            $this->form_validation->set_rules('Catatan', 'ruangan', 'required');
            $this->form_validation->set_rules('Nama_Level', 'Hak Akses', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->model('app_model');
                $data['Nama_Level'] = $this->app_model->native_query('SELECT Id_Level, Nama_Level FROM sys_level');
                $this->template->load('admin/templateadmin', 'data_operaator/tambah_data_operator', $data);
            } else {
                $nik_nim_lama = $this->input->post('nik_nim_pengguna_lama', TRUE);
                $nik_nim_baru = $this->input->post('nik_nim_pengguna', TRUE);

                //memanggil model pengguna untuk mengecek apakah nip yang dimasukkan sudah dipakai atau belum
                $this->load->model('m_data_operator');
                $nik_nim_digunakan = $this->m_data_operator->cek_nik_nim_pengguna($this->input->post('nik_nim', TRUE));
                if ($nik_nim_digunakan->row() != NULL) {
                    $nik_nim_digunakan = $nik_nim_digunakan->row();
                    $pesan['css'] = 'alert-danger';
                    $pesan['psn'] = 'Username ' . $this->input->post('nik_nim', TRUE) . ' sudah digunakan atas nama ' . $nik_nim_digunakan->Nama_Operator . ' !';

                    $this->session->set_flashdata('pesan', $pesan);
                    redirect('data_operator/tambah_data_operator');
                } else {
                    $pengguna['Id_Level'] = $this->input->post('level', TRUE);
                    $pengguna['Nama_Pengguna'] = ucfirst($this->input->post('nama_operator', TRUE));
                    $pengguna['Status_Pengguna'] = $this->input->post('status_operator', TRUE);
                    $pengguna['NIK_NIM'] = $this->input->post('username', TRUE);
                    $pengguna['Password'] = md5($this->input->post('kata_sandi_1', TRUE));
                    $pengguna['Gender'] = $this->input->post('gender', TRUE);
                    $pengguna['No_Telp'] = $this->input->post('telepon', TRUE);
                    $pengguna['Alamat'] = $this->input->post('alamat', TRUE);
                    $pengguna['Tempat'] = $this->input->post('tempat', TRUE);
                    $pengguna['Tanggal_Lahir'] = $this->input->post('tanggal_lahir', TRUE);
                    $pengguna['Catatan'] = $this->input->post('catatan', TRUE);

                    //load model
                    $this->load->model('app_model');
                    if ($this->app_model->tambah_data_tabel('pengguna', $pengguna)) {
                        //pesan sukses untuk ditampilkan dalam view
                        $pesan['css'] = 'alert-success';
                        $pesan['psn'] = 'Data Operator dengan Username ' . $pengguna['nik_nim'] . ' berhasil ditambahkan!';

                        $this->session->set_flashdata('pesan', $pesan);
                    } else {
                        //pesan gagal untuk ditampilkan dalam view
                        $pesan['css'] = 'alert-danger';
                        $pesan['psn'] = 'Terjadi kesalahan saat proses penyimpanan data dalam database. Data pengguna ' . $pengguna['nik_nim'] . ' gagal disimpan';

                        $this->session->set_flashdata('pesan', $pesan);
                    }
                    redirect('data_operator');
                }
            }
        } else {
            //jika tombol simpan tidak di tekan
            $this->load->model('m_data_operator');
            $data['level'] = $this->m_data_operator->data_level();
            parent::display('tambah_data_operator', $data);
        }
    }

    function cari($offset = 0) {
        //jika tombol cari ditekan
        if ($this->input->post('kirim', TRUE) != NULL) {
            //jika variabel cari masih kosong
            //ambil data dari view
            $this->session->unset_userdata('cari', '');
            $data['keyword'] = $cari['keyword'] = $this->input->post('cari', TRUE);
            $data['keyword_nama_operator'] = $cari['nama_operator'] = $this->input->post('nama_operator', TRUE) != '0' ? $this->input->post('nama_operator', TRUE) : '';

            //simpan sementara keyword ke dalam session agar dapat digunakan pada aksi selanjutnya
            $this->session->set_userdata('cari', $cari);
        } elseif ($this->session->userdata('cari')) {
            $filter = $this->session->userdata('cari');
            $data['keyword'] = $filter['keyword'];
            $data['keyword_nama_operator'] = $filter['nama_operator'];
        } else {
            redirect('data_operator');
        }
        //load data parameter dan menghitung jumlah data sesuai dengan data yang diinputkan
        $this->load->model('m_data_operator');
        $data['pengguna'] = $this->m_data_operator->tampil_data_pengguna($this->banyakbaris, $offset, $data['keyword'], $data['keyword_ruang']);
        $data['jumlah_data'] = $this->m_data_operator->jumlah_cari_data_pengguna($data['keyword'], $data['keyword_ruang']);

        //load data jenis
        $this->load->model('app_model');
        $data['level'] = $this->app_model->native_query('select Id_Level, Nama_Level from sys_level');

        //load library untuk pagination
        $this->load->library('Bagi_halaman');
        $data['pagination'] = $this->bagi_halaman->paging($data['jumlah_data'], $this->banyakbaris, 'admin/pengguna/cari');


        //tampilkan view
        $this->template->load('admin/templateadmin', 'data_operator/tampil_data_operator', $data);
    }

    function ubah_pengguna($id = NULL) {
        if ($this->input->post('simpan') != NULL) {
            //jika tombol simpan di klik
            //load library form validation
            $this->load->library('form_validation');
            //set validasi form
            $this->form_validation->set_rules('Nama_Pengguna', 'Nama Operator', 'required|numeric');
            $this->form_validation->set_rules('Status_Pengguna', 'Status Operator', 'required');
            $this->form_validation->set_rules('NIK_NIM', 'Username', 'required');
            $this->form_validation->set_rules('kata_sandi_1', 'Password', 'required|matches[kata_sandi_2]');
            $this->form_validation->set_rules('kata_sandi_2', 'Konfirmasi Password', 'required');
            $this->form_validation->set_rules('Gender', 'Konfirmasi Password', 'required');
            $this->form_validation->set_rules('No_Telp', 'Konfirmasi Password', 'required');
            $this->form_validation->set_rules('Alamat', 'Konfirmasi Password', 'required');
            $this->form_validation->set_rules('Tempat_Lahir', 'Konfirmasi Password', 'required');
            $this->form_validation->set_rules('Tanggal_Lahir', 'telepon', 'required|numeric');
            $this->form_validation->set_rules('Catatan', 'ruangan', 'required');
//            $this->form_validation->set_rules('Nama_Level', 'Hak Akses', 'required');


            if ($this->input->post('kata_sandi_1', TRUE) != NULL) {
                $this->form_validation->set_rules('kata_sandi_1', 'kata sandi', 'required|matches[kata_sandi_2]');
                $this->form_validation->set_rules('kata_sandi_2', 'konfirmasi kata sandi', 'required');
            }
            $nik_nim_lama = $this->input->post('nik_nim_pengguna_lama', TRUE);
            $nik_nim_baru = $this->input->post('nik_nim_pengguna', TRUE);

            //memanggil model pengguna untuk mengecek apakah nip yang dimasukkan sudah dipakai atau belum
            $this->load->model('m_data_operator');
            $nik_nim_digunakan = $this->m_data_operator->cek_nik_nim_pengguna($this->input->post('nik_nim', TRUE));

            if ($nik_nim_lama != $nik_nim_baru && $nik_nim_digunakan != NULL) {
                $pesan['css'] = 'alert-danger';
                $pesan['psn'] = 'Username ' . $this->input->post('nik_nim', TRUE) . ' sudah digunakan atas nama ' . $nik_nim_digunakan . ' !';

                $this->session->set_flashdata('pesan', $pesan);
            } else {
                if ($this->form_validation->run() == FALSE) {
                    $data['detail_pengguna'] = $this->m_data_operator->detail_data_pengguna($this->input->post('nik_nim', TRUE));
                    $this->load->model('app_model');
                    $data['level'] = $this->app_model->native_query('SELECT Id_Level, Nama_Level FROM sys_level');
                    $this->template->load('admin/templateadmin', 'data_operator/ubah_data_operator', $data);
                } else {
                    $pengguna['Id_Level'] = $this->input->post('level', TRUE);
                    $pengguna['Nama_Pengguna'] = ucfirst($this->input->post('nama_operator', TRUE));
                    $pengguna['Status_Pengguna'] = $this->input->post('status_operator', TRUE);
                    $pengguna['NIK_NIM'] = $this->input->post('username', TRUE);
                    $pengguna['Password'] = md5($this->input->post('kata_sandi_1', TRUE));
                    $pengguna['Gender'] = $this->input->post('gender', TRUE);
                    $pengguna['No_Telp'] = $this->input->post('telepon', TRUE);
                    $pengguna['Alamat'] = $this->input->post('alamat', TRUE);
                    $pengguna['Tempat'] = $this->input->post('tempat', TRUE);
                    $pengguna['Tanggal_Lahir'] = $this->input->post('tanggal_lahir', TRUE);
                    $pengguna['Catatan'] = $this->input->post('catatan', TRUE);
//                  $pengguna['Nama_Level'] = $this->input->post('level', TRUE);
                    //jika kolom kata sandi diisi maka password diganti
                    if ($this->input->post('kata_sandi_1', TRUE) != NULL) {
                        $pengguna['password'] = md5($this->input->post('kata_sandi_1', TRUE));
                    }

                    //load model
                    $this->load->model('app_model');
                    if ($this->app_model->rubah_data_tabel('pengguna', $pengguna, 'nik_nim', $this->input->post('nik_nim_pengguna_lama', TRUE))) {
                        //pesan sukses untuk ditampilkan dalam view
                        $pesan['css'] = 'alert-success';
                        $pesan['psn'] = 'Data Operator dengan Username ' . $pengguna['nik_nim'] . ' berhasil dirubah!';

                        $this->session->set_flashdata('pesan', $pesan);
                    } else {
                        //pesan gagal untuk ditampilkan dalam view
                        $pesan['css'] = 'alert-danger';
                        $pesan['psn'] = 'Terjadi kesalahan saat proses penyimpanan data dalam database. Data Operator ' . $pengguna['nik_nim'] . ' gagal disimpan';

                        $this->session->set_flashdata('pesan', $pesan);
                    }
                }
            }
            redirect('data_operator');
        } elseif ($id != NULL) {
            //jika tombol simpan tidak di tekan
            //load data detail pengguna
            $this->load->model('m_data_operator');
            $data['detail_pengguna'] = $this->m_data_operator->detail_data_pengguna($id);

            $this->load->model('app_model');
            $data['level'] = $this->app_model->native_query('SELECT Id_Level, Nama_Level FROM sys_level');
            $this->template->load('admin/templateadmin', 'data_operator/ubah_data_operator', $data);
        } else {
            redirect('data_operator');
        }
    }

}

?>
