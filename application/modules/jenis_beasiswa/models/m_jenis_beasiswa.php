<?php

class m_jenis_beasiswa extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function tambah_jenis_beasiswa($parameter) {
        $sql = 'INSERT INTO jenis_beasiswa (Jenis_Beasiswa, Warna_Beasiswa, Keterangan) VALUES (?,?,?)';
        return $this->db->query($sql, $parameter);
    }

    function ambil_jenis_beasiswa($parameter) {
        $sql = 'SELECT * FROM jenis_beasiswa LIMIT ?,?';
        $query = $this->db->query($sql, $parameter);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }

    function count_all_data() {
        $sql = "SELECT COUNT(Id_JB)'total' FROM jenis_beasiswa";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return false;
        }
    }

    function get_jenis_beasiswa_by_id($parameter) {
        $sql = "SELECT * FROM jenis_beasiswa WHERE Id_JB = ?";
        $query = $this->db->query($sql, $parameter);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }

    function ubah_jenis_beasiswa($parameter) {
        $sql = 'UPDATE jenis_beasiswa SET Jenis_Beasiswa=?, Warna_Beasiswa=?, Keterangan=? WHERE Id_JB = ?';
        return $this->db->query($sql, $parameter);
    }

    function hapus_jenis_beasiswa($params) {
        $sql = 'DELETE FROM jenis_beasiswa WHERE Id_JB = ?';
        return $this->db->query($sql, $params);
    }

}
