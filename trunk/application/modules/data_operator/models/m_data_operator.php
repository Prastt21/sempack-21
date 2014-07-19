<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class m_data_operator extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function tambah_data_operator($parameter) {
        $sql = 'INSERT INTO pengguna (Id_Level,Nama_Pengguna,Status_Pengguna,NIK_NIM,
            Password,Gender,No_Telp,Alamat,Tempat_Lahir,Tanggal_Lahir,Email) VALUES (?,?,?,?,?,?,?,?,?,?,?)';
        return $this->db->query($sql, $parameter);
    }

    function ambil_data_operator($parameter) {
        $sql = 'SELECT a.*, b.* FROM pengguna a
                INNER JOIN sys_level b ON b.Id_Level = a.Id_Level
                WHERE a.Id_Level LIKE 1 OR a.Id_Level LIKE 2 LIMIT ?,?';
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
        $sql = "SELECT COUNT(Id_Pengguna)'total' FROM pengguna WHERE Id_Level LIKE '1' OR Id_Level LIKE '2'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return false;
        }
    }
    function ambil_data_level($dalev) {
        $sql = 'SELECT Id_Level,Nama_Level FROM sys_level 
                WHERE Id_Level LIKE 1 OR Id_Level LIKE 2';
        $query = $this->db->query($sql, $dalev);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }
}

?>
