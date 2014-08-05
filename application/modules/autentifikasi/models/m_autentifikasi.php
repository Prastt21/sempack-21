<?php

/*
 * By : Praditya Kurniawan
 * website : http://masiyak.com
 * email : aku@masiyak.com
 * 
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class m_autentifikasi extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function cek_pengguna($params) {
        $sql = 'SELECT a.*,b.*
            FROM pengguna a 
            JOIN sys_level b ON a.Id_Level = b.Id_Level
            WHERE a.NIK_NIM = ? AND a.Password = ?';
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }

    function set_login_time($param) {
        $sql = 'UPDATE pengguna SET sesi = NOW() WHERE Id_Pengguna = ?';
        return $this->db->query($sql, $param);
    }

}
