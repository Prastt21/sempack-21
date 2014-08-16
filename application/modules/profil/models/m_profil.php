<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class m_profil extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function update_profil($parameter) {
        $sql = 'UPDATE pengguna SET  Nama_Pengguna=?, Status_Pengguna=?, NIK_NIM=?, Gender=?, No_Telp=?, Alamat=?,
            Tempat_Lahir=?, Tanggal_Lahir=?, Email=? WHERE Id_Pengguna=?';
        return $this->db->query($sql, $parameter);
    }

    function update_password_profil($parameter) {
        $sql = 'UPDATE pengguna SET Password=? WHERE Id_Pengguna=?';
        return $this->db->query($sql, $parameter);
    }

    function ambil_profil($parameter) {
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
    function get_profil_by_id($parameter) {
        $sql = 'SELECT * FROM pengguna WHERE Id_Pengguna = ?';
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

?>
