<?php

class m_pengguna extends CI_Model {

    public function __construct() {
        parent::__construct();
    }  

    function ambil_pengguna($parameter) {
        $sql = 'SELECT a.Nama_Ortu,b.Nama_Pengguna,b.NIK_NIM,b.Gender,b.No_Telp,b.Alamat,
                b.Tanggal_Lahir, b.Email FROM keterangan_ortu a
                INNER JOIN pengguna b ON a.Id_Ortu = b.Id_Ortu
                WHERE b.Id_Level LIKE 3 LIMIT ?,?';
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
