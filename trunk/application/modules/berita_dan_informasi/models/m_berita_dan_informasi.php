<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class m_berita_dan_informasi extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_berita_dan_informasi_by_aula() {
        $sql = 'SELECT * FROM informasi WHERE jenis_info LIKE "Aula"';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }
    function get_berita_dan_informasi_by_beasiswa() {
        $sql = 'SELECT * FROM informasi WHERE jenis_info LIKE "Beasiswa"';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }
    function get_berita_dan_informasi_by_asuransi() {
        $sql = 'SELECT * FROM informasi WHERE jenis_info = "Asuransi"';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }
}