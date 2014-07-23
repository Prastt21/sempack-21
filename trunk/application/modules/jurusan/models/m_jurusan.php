<?php

class m_jurusan extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function tambah_jurusan($parameter) {
        $sql = 'INSERT INTO jurusan (Nama_Jurusan, Singkatan_Jurusan, Warna_Jurusan) VALUES (?,?,?)';
        return $this->db->query($sql, $parameter);
    }

    function ambil_jurusan($parameter) {
        $sql = 'SELECT * FROM Jurusan LIMIT ?,?';
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
        $sql = "SELECT COUNT(Id_Jurusan)'total' FROM jurusan";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return false;
        }
    }

    function get_jurusan_by_id($parameter) {
        $sql = "SELECT * FROM jurusan WHERE Id_Jurusan = ?";
        $query = $this->db->query($sql, $parameter);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }

    function ubah_jurusan($parameter) {
        $sql = 'UPDATE jurusan SET Nama_Jurusan=?, Singkatan_Jurusan=?, Warna_Jurusan=? WHERE Id_Jurusan = ?';
        return $this->db->query($sql, $parameter);
    }

    function hapus_jurusan($params) {
        $sql = 'DELETE FROM jurusan WHERE Id_Jurusan = ?';
        return $this->db->query($sql, $params);
    }

}
