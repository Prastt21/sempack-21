<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class data_peminjaman_aula extends operator_base {

    var $batas = 15;

    public function index($offset = 0) {
        //control hak akses read
        $this->_set_page_role('r');
        //load model
        $this->load->model('m_data_peminjaman_aula');
        //load library
        $this->load->library('bagi_halaman');

        $data['rs_data_peminjaman_aula'] = $this->m_data_peminjaman_aula->ambil_data_peminjaman_aula(array(intval($offset), $this->batas));
        $data['total_data'] = $this->m_data_peminjaman_aula->count_all_data();
        $data['jml_data'] = count($data['rs_data_peminjaman_aula']);
        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($data['total_data'], $this->batas, 'data_peminjaman_aula/index');

        parent::display('tampil_data_peminjaman_aula_op', $data);
    }   

    function ubah_data_peminjaman_aula($id = '') {
        //control hak akses update
        $this->_set_page_role('u');
        //set validasi id
        if (empty($id))
            redirect('data_peminjaman_aula');
        //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');
        //load library form validation
        $this->load->library('form_validation');
        //load model
        $this->load->model('m_data_peminjaman_aula');
        //ambil data informasi berdasarkan id informasi
        $data['result_data_peminjaman_aula'] = $this->m_data_peminjaman_aula->get_data_peminjaman_aula_by_id($id);
        //jika tidak dipencet
        parent::display('ubah_data_peminjaman_aula', $data);
    }

    function proses_ubah_data_peminjaman_aula() {
        //set validasi tombol simpan
        if ($this->input->post('simpan') == null)
            redirect('data_peminjaman_aula');
        //load library form validation
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('status_penggunaan', 'Status Penggunaan', 'required|trim');
        $this->form_validation->set_rules('id_pinjam_aula', 'ID Pinjam Aula', 'required');

        if ($this->form_validation->run() === FALSE) {
            //set pesan notifikasi eror
            $this->notification('error', validation_errors());
            //data form disimpan biar nanti user ga masukin lagi
            $this->form_validation->keep_data();
            //kembalikan lagi ke form ubah data dengan parameter id_informasi
            redirect('data_peminjaman_aula/ubah_data_peminjaman_aula/' . $this->input->post('id_pinjam_aula'));
        } else {
            //jika validasi sukses
            $this->load->model('m_data_peminjaman_aula');
            $parameter = array(                
            $this->input->post('status_penggunaan'),
            $this->input->post('id_pinjam_aula')
            );
            if ($this->m_data_peminjaman_aula->ubah_data_peminjaman_aula($parameter)) {
                //jika berhasil insert
                $this->notification('success', 'Data berhasil dirubah');
                //arahkan kembali ke form edit
                redirect('data_peminjaman_aula/ubah_data_peminjaman_aula/' . $this->input->post('id_pinjam_aula'));
            } else {
                //jika gagal
                $this->notification('error', 'Data gagal dirubah');
                //arahkan kembali ke form edit
                redirect('data_peminjaman_aula/ubah_data_peminjaman_aula/' . $this->input->post('id_pinjam_aula'));
            }
            redirect('data_peminjaman_aula');
        }
    }

    function hapus_data_peminjaman_aula($id = '') {
        //control hak akses delete
        $this->_set_page_role('d');
        if (empty($id))
            redirect('data_peminjaman_aula');
        //load model
        $this->load->model('m_data_peminjaman_aula');
        if ($this->m_data_peminjaman_aula->hapus_data_peminjaman_aula($id)) {
            //jika berhasil menghapus
            $this->notification('success', 'Data berhasil dihapus');
        } else {
            //jika gagal menghapus
            $this->notification('error', 'Data gagal dihapus');
        }
        //kembalikan ke halaman list informasi
        redirect('data_peminjaman_aula');
    }
    function cari($offset = 0) {
        $this->_set_page_role('r');
        //load library untuk pagination
        $this->load->library('bagi_halaman');
        //load model
        $this->load->model('m_data_peminjaman_aula');
        if ($this->input->post() != null) {
            $keyword = $this->input->post('keyword_text', true);
            $this->session->set_userdata('keyword_cari', $keyword);
        } else {
            $keyword = $this->session->userdata('keyword_cari');
        }
        $parameter = array('%' . $keyword . '%', $offset, $this->batas);
        //ambil data dari database
        $rs_data_peminjaman_aula = $this->m_data_peminjaman_aula->get_list_data($parameter);
        //menghitung jumlah data tabel keseluruhan
        $rs_total = $this->m_data_peminjaman_aula->count_search_data($parameter);

        //ambil nilai untuk dikirim ke view
        $data['halaman'] = $this->bagi_halaman->paging($rs_total, $this->batas, 'data_peminjaman_aula/index');
        $data['rs_data_peminjaman_aula'] = $rs_data_peminjaman_aula;
        $data['total_data'] = $rs_total;
        $data['jml_data'] = count($rs_data_peminjaman_aula);
        $data['awal'] = $offset;
        $data['keyword'] = $keyword;
        parent::display('tampil_data_peminjaman_aula_op', $data);
    }


}