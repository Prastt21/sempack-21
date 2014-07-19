<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class peminjaman_aula extends operator_base {

    var $batas = 15;

    public function index($offset = 0) {
        $this->_set_page_role('r');
        $this->load->model('m_peminjaman_aula');
        $this->load->library('bagi_halaman');
        $data['rs_peminjaman_aula'] = $this->m_peminjaman_aula->ambil_peminjaman_aula(array(intval($offset), $this->batas));
        $data['total_data'] = $this->m_peminjaman_aula->count_all_data();
        $data['jml_data'] = count($data['rs_peminjaman_aula']);
        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($data['total_data'], $this->batas, 'peminjaman_aula/index');

        parent::display('tampil_peminjaman_aula', $data);
    }

    function tambah_peminjaman_aula() {
        //control hak akses
        $this->_set_page_role('c');
        if ($this->input->post('simpan') != '') {
            //jika tombol simpan dipencet
            $this->load->library('form_validation');
            $this->form_validation->set_rules('nama_peminjam', 'Nama Peminjam', 'required|trim');
            $this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required|trim');
            $this->form_validation->set_rules('ketua_organisasi', 'Ketua Organisasi', 'required|trim');
            $this->form_validation->set_rules('peserta', 'Peserta', 'required|trim');
            $this->form_validation->set_rules('jumlah_peserta', 'Jumlah Peserta', 'required|trim');
            $this->form_validation->set_rules('tanggal_pinjam', 'Tanggal Pinjam', 'required|trim');
            $this->form_validation->set_rules('waktu_pinjam', 'Waktu Pinjam', 'required|trim');
            $this->form_validation->set_rules('tanggal_selesai', 'Tanggal Selesai', 'required|trim');
            $this->form_validation->set_rules('waktu_selesai', 'Waktu Selesai', 'required|trim');
            $this->form_validation->set_rules('status_penggunaan', 'Status Penggunaan', 'required|trim');

            if ($this->form_validation->run() === FALSE) {
                $pesan['css'] = 'alert-error';
                $pesan['psn'] = validation_errors();
                $this->session->set_flashdata('pesan', $pesan);
                parent::display('tambah_peminjaman_aula');
            } else {
                $this->load->model('m_peminjaman_aula');
                $parameter = array(
                    $this->sesi->get_data_login('ID_PENGGUNA'),
                    $this->input->post('nama_peminjam'),
                    $this->input->post('nama_kegiatan'),
                    $this->input->post('ketua_organisasi'),
                    $this->input->post('peserta'),
                    $this->input->post('jumlah_peserta'),
                    $this->input->post('tanggal_pinjam'),
                    $this->input->post('waktu_pinjam'),
                    $this->input->post('tanggal_selesai'),
                    $this->input->post('waktu_selesai'),
                    $this->input->post('status_penggunaan')
                );
                if ($this->m_rujukan_asuransi->tambah_rujukan_asuransi($parameter)) {
                    //jika berhasil insert
                    //pesan sukses untuk ditampilkan dalam view
                    $pesan['css'] = 'alert-success';
                    $pesan['psn'] = 'Peminjaman Aula berhasil ditambahkan!';
                } else {
                    //jika gagal
                }
                $this->session->set_flashdata('pesan', $pesan);
                redirect('peminjaman_aula');
            }
        } else {
            //jika tidak dipencet
            parent::display('tambah_peminjaman_aula');
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