<?php

class m_pengguna extends CI_Model {

    public function __construct() {
        parent::__construct();
    }  

    function ambil_pengguna($parameter) {
        $sql = 'SELECT Nama_Pengguna,Gender,Status_Pengguna,NIK_NIM,
                No_Telp,Alamat,Tanggal_Lahir,Email,Nama_Ortu
                FROM Pengguna WHERE Id_Level LIKE 3 LIMIT ?,?';
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
        $sql = "SELECT COUNT(Id_Pengguna)'total' FROM pengguna WHERE Id_Level LIKE '3'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return false;
        }
    }

    function get_pengguna_by_id($parameter) {
        $sql = "SELECT * FROM pengguna WHERE Id_Pengguna = ?";
        $query = $this->db->query($sql, $parameter);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }

}
