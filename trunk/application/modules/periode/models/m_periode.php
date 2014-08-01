<?php

class m_periode extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function tambah_periode($parameter) {
        $sql = 'INSERT INTO periode (Tahun,Keterangan) VALUES (?,?)';
        return $this->db->query($sql, $parameter);
    }

    function ambil_periode($parameter) {
        $sql = 'SELECT * FROM periode LIMIT ?,?';
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
        $sql = "SELECT COUNT(Id_Periode)'total' FROM periode";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return false;
        }
    }

    function get_periode_by_id($parameter) {
        $sql = "SELECT * FROM periode WHERE Id_Periode = ?";
        $query = $this->db->query($sql, $parameter);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }

    function ubah_periode($parameter) {
        $sql = 'UPDATE periode SET Tahun=?, Keterangan=? WHERE Id_Periode = ?';
        return $this->db->query($sql, $parameter);
    }

    function hapus_periode($params) {
        $sql = 'DELETE FROM periode WHERE Id_Periode = ?';
        return $this->db->query($sql, $params);
    }
    //get data
    function get_list_data($params) {
        $sql = 'SELECT * FROM periode WHERE tahun LIKE ? ORDER BY tahun ASC LIMIT ?,?';
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
        $sql = 'SELECT count(id_periode) as jumlah FROM periode WHERE tahun LIKE ? LIMIT 1';
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
