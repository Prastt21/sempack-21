<?php

class m_rujukan_asuransi extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function tambah_rujukan_asuransi($parameter) {
        $sql = 'INSERT INTO asuransi (Jenis_Asuransi,Id_Pengguna,Nama_RS,Alamat_RS,Kronologi,Tanggal_Daftar,
            Tanggal_Masuk,Tanggal_Keluar,Total_Biaya,Santunan,Status_Asuransi) VALUES (?,?,?,?,?,?,?,?,?,?,?)';
        return $this->db->query($sql, $parameter);
    }

    function ambil_rujukan_asuransi($parameter) {
        $sql = 'SELECT a.*, b.* FROM asuransi a
                INNER JOIN pengguna b ON b.Id_Pengguna = a.Id_Pengguna
                LIMIT ?,?';
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
        $sql = "SELECT COUNT(Id_Asuransi)'total' FROM asuransi";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return false;
        }
    }

    function get_rujukan_asuransi_by_id($parameter) {
        $sql = "SELECT * FROM asuransi WHERE Id_Asuransi = ?";
        $query = $this->db->query($sql, $parameter);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }

    function ubah_rujukan_asuransi($parameter) {
        $sql = 'UPDATE asuransi SET Jenis_Asuransi=?, Id_Pengguna=?, Nama_RS=?, Alamat_RS=?, Kronologi=?, 
                Tanggal_Daftar=?, Tanggal_Masuk=?, Tanggal_Keluar=?, Total_Biaya=?, Santunan=?,
                Status_Asuransi=? WHERE Id_Asuransi = ?';
        return $this->db->query($sql, $parameter);
    }

    function hapus_rujukan_asuransi($params) {
        $sql = 'DELETE FROM asuransi WHERE id_asuransi = ?';
        return $this->db->query($sql, $params);
    }
    //get data
    function get_list_data($params) {
        $sql = 'SELECT a.*, b.* FROM asuransi a INNER JOIN pengguna b 
                ON b.Id_Pengguna = a.Id_Pengguna WHERE a.tanggal_daftar LIKE ? 
                ORDER BY a.tanggal_daftar ASC LIMIT ?,?';
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

//count search data
    function count_search_data($params) {
        $sql = 'SELECT count(a.id_asuransi) as jumlah FROM asuransi a INNER JOIN pengguna b 
                ON b.Id_Pengguna = a.Id_Pengguna WHERE a.tanggal_daftar LIKE ? LIMIT 1';
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['jumlah'];
        } else {
            return array();
        }
    }
}
