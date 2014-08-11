<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class periode extends operator_base {

    var $batas = 15;

    public function index($offset = 0) {
        //control hak akses read
        $this->_set_page_role('r');
        //load model
        $this->load->model('m_periode');
        //load library
        $this->load->library('bagi_halaman');

        $data['rs_periode'] = $this->m_periode->ambil_periode(array(intval($offset), $this->batas));
        $data['total_data'] = $this->m_periode->count_all_data();
        $data['jml_data'] = count($data['rs_periode']);
        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($data['total_data'], $this->batas, 'periode/index');

        parent::display('tampil_periode', $data);
    }

    function tambah_periode() {
        //control hak akses create
        $this->_set_page_role('c');
        $this->load->library('Form_validation');
        //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');
        parent::display('tambah_periode');
    }

    function proses_tambah_periode() {
        //validasi tombol simpan, jika tidak ditekan maka redirect ke tampilan tambah informasi
        if ($this->input->post('simpan') == null)
            redirect('periode/tambah_periode');
        //load form validation
        $this->load->library('Form_validation');
        //set aturan validasi
        $this->form_validation->set_rules('tahun_periode', 'Tahun Periode', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
        
        //menjalankan validasi
        if ($this->form_validation->run() === FALSE) {
            //jika validasi ada yang eror, kirim notifikasi ke view
            $this->notification('error', validation_errors());
            $this->form_validation->keep_data();
            //redirect ke tampilan tambah data informasi
            redirect('periode/tambah_periode');
        } else {
            //load model
            $this->load->model('m_periode');
            //set parameter array
            $parameter = array(
                //$this->sesi->get_data_login('ID_PENGGUNA'),
                $this->input->post('tahun_periode'),
                $this->input->post('keterangan')
            );
            if ($this->m_periode->tambah_periode($parameter)) {
                //jika sukses kirim pesan ke view
                $this->notification('success', 'Periode berhasil ditambahkan');
            } else {
                //jika gagal kirim pesan ke view
                $this->notification('error', 'Periode gagal ditambahkan');
            }
        }
        //redirect ke list informasi
        redirect('periode');
    }

    function ubah_periode($id = '') {
        //control hak akses update
        $this->_set_page_role('u');
        //set validasi id
        if (empty($id))
            redirect('periode');
        //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');
        //load library form validation
        $this->load->library('form_validation');
        //load model
        $this->load->model('m_periode');
        //ambil data informasi berdasarkan id informasi
        $data['result_periode'] = $this->m_periode->get_periode_by_id($id);
        //jika tidak dipencet
        parent::display('ubah_periode', $data);
    }

    function proses_ubah_periode() {
        //set validasi tombol simpan
        if ($this->input->post('simpan') == null)
            redirect('periode');
        //load library form validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('tahun_periode', 'Tahun Periode', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
        $this->form_validation->set_rules('id_periode', 'ID Periode', 'required');

        if ($this->form_validation->run() === FALSE) {
            //set pesan notifikasi eror
            $this->notification('error', validation_errors());
            //data form disimpan biar nanti user ga masukin lagi
            $this->form_validation->keep_data();
            //kembalikan lagi ke form ubah data dengan parameter id_informasi
            redirect('periode/ubah_periode/' . $this->input->post('id_periode'));
        } else {
            //jika validasi sukses
            $this->load->model('m_periode');
            $parameter = array(
                //$this->sesi->get_data_login('ID_PENGGUNA'),
                $this->input->post('tahun_periode'),
                $this->input->post('keterangan'),
                $this->input->post('id_periode')
            );
            if ($this->m_periode->ubah_periode($parameter)) {
                //jika berhasil insert
                $this->notification('success', 'Data berhasil dirubah');
                //arahkan kembali ke form edit
                redirect('periode/ubah_periode/' . $this->input->post('id_periode'));
            } else {
                //jika gagal
                $this->notification('error', 'Data gagal dirubah');
                //arahkan kembali ke form edit
                redirect('periode/ubah_periode/' . $this->input->post('id_periode'));
            }
            redirect('periode');
        }
    }

    function hapus_periode($id = '') {
        //control hak akses delete
        $this->_set_page_role('d');
        if (empty($id))
            redirect('periode');
        //load model
        $this->load->model('m_periode');
        if ($this->m_periode->hapus_periode($id)) {
            //jika berhasil menghapus
            $this->notification('success', 'Data berhasil dihapus');
        } else {
            //jika gagal menghapus
            $this->notification('error', 'Data gagal dihapus');
        }
        //kembalikan ke halaman list informasi
        redirect('periode');
    }
    function cari($offset = 0) {
        $this->_set_page_role('r');
        //load library untuk pagination
        $this->load->library('bagi_halaman');
        //load model
        $this->load->model('m_periode');
        if ($this->input->post() != null) {
            $keyword = $this->input->post('keyword_text', true);
            $this->session->set_userdata('keyword_cari', $keyword);
        } else {
            $keyword = $this->session->userdata('keyword_cari');
        }
        $parameter = array('%' . $keyword . '%', $offset, $this->batas);
        //ambil data dari database
        $rs_periode = $this->m_periode->get_list_data($parameter);
        //menghitung jumlah data tabel keseluruhan
        $rs_total = $this->m_periode->count_search_data($parameter);

        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($rs_total, $this->batas, 'satuan/index');
        $data['rs_periode'] = $rs_periode;
        $data['total_data'] = $rs_total;
        $data['jml_data'] = count($rs_periode);
        $data['awal'] = $offset;
        $data['keyword'] = $keyword;
        parent::display('tampil_periode', $data);
    }

}