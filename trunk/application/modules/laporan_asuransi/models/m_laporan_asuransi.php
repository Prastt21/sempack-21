<?php

class m_laporan_asuransi extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    function ambil_laporan_asuransi($parameter) {
        $sql = 'SELECT * FROM asuransi WHERE MONTH(tanggal_daftar) = ? 
                    AND YEAR(tanggal_daftar) = ? LIMIT ?,?';
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
        $sql = "SELECT COUNT(Id_Asuransi)'total' FROM pendaftaran_asuransi";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return false;
        }
    }

    function get_laporan_asuransi_by_id($parameter) {
        $sql = "SELECT * FROM pendaftaran_asuransi WHERE Id_Asuransi = ?";
        $query = $this->db->query($sql, $parameter);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }
    //ambil total pembelian pada bulan sekarang
    function get_total_asuransi($params) {
        $sql = "SELECT COUNT(id_asuransi)'jumlah' FROM asuransi
                WHERE MONTH(tanggal_daftar) = ? AND YEAR(tanggal_daftar) = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['jumlah'];
        } else {
            return array();
        }
    }
    //get tahun
    function get_tahun_asuransi() {
        $sql = "SELECT YEAR(tanggal_daftar)'tahun' FROM asuransi
                UNION SELECT YEAR(NOW()) FROM asuransi";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }
}
