<?php

class m_data_informasi extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function tambah_data_informasi($parameter) {
        $sql = 'INSERT INTO informasi (Id_Pengguna,Judul_Info, Isi_info, Jenis_Info, Tanggal_info) VALUES (?,?,?,?,?)';
        return $this->db->query($sql, $parameter);
    }

    function ambil_data_informasi($parameter) {
        $sql = 'SELECT a.*, b.* FROM informasi a
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
        $sql = "SELECT COUNT(Id_Informasi)'total' FROM informasi";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return false;
        }
    }

    function get_data_informasi_by_id($parameter) {
        $sql = "SELECT * FROM informasi WHERE Id_Informasi = ?";
        $query = $this->db->query($sql, $parameter);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }

    function ubah_data_informasi($parameter) {
        $sql = 'UPDATE informasi SET Id_Pengguna=?, Judul_Info=?, Isi_Info=?, Jenis_Info=?, Tanggal_info=? WHERE Id_Informasi = ?';
        return $this->db->query($sql, $parameter);
    }

    function hapus_data_informasi($params) {
        $sql = 'DELETE FROM informasi WHERE id_informasi = ?';
        return $this->db->query($sql, $params);
    }
    //get data
    function get_list_data($params) {
        $sql = 'SELECT * FROM informasi WHERE judul_info LIKE ? ORDER BY judul_info ASC LIMIT ?,?';
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
        $sql = 'SELECT count(id_informasi) as jumlah FROM informasi WHERE judul_info LIKE ? LIMIT 1';
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
