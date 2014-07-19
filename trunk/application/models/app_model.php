<?php

/*
 * by : Praditya Kurniawan
 * web : http://masiyak.com
 * email : aku@masiyak.com
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class app_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function ambil_data_tabel($tabel, $filter = NULL) {
        $filter != NULL ? $this->db->where($filter) : '';
        return $this->db->get($tabel);
    }

    function native_query($sql) {
        return $this->db->query($sql);
    }

    function tambah_data_tabel($tabel, $data) {
        return $this->db->insert($tabel, $data);
    }

    function tambah_data_tabel_id($tabel, $data) {
        $this->db->insert($tabel, $data);
        return $this->db->insert_id();
    }

    function tambah_data_tabel_batch($tabel, $data) {
        return $this->db->insert_batch($tabel, $data);
    }

    function rubah_data_tabel($tabel, $data, $parameter, $id) {
        $this->db->where($parameter, $id);
        $this->db->update($tabel, $data);

        return $this->db->affected_rows();
    }

    function hitung_data_tabel($tabel) {
        return $this->db->count_all($tabel);
    }

    function hapus_data_tabel($tabel, $parameter) {
        return $this->db->delete($tabel, $parameter);
    }

    function cek_relasi_data_tabel($tabel, $kolom, $parameter) {
        $this->db->where($kolom, $parameter);
        $this->db->from($tabel);

        return $this->db->count_all_results();
    }

    //function 
}

?>
