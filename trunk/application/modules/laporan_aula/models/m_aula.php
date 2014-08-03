<?php

class m_peminjaman_aula extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    function ambil_peminjaman_aula($parameter) {
        $sql = 'SELECT a.*,b.* FROM aula a INNER JOIN pengguna b WHERE MONTH(tanggal_daftar) = ? 
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
        $sql = "SELECT COUNT(Id_Pinjam_Aula)'total' FROM aula";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return false;
        }
    }

    function get_peminjaman_aula_by_id($parameter) {
        $sql = "SELECT * FROM aula WHERE Id_Pinjam_Aula = ?";
        $query = $this->db->query($sql, $parameter);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }
    //ambil total peminjaman aula pada bulan sekarang
    function get_total_aula($params) {
        $sql = "SELECT COUNT(id_pinjam_aula)'jumlah' FROM aula
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
    function get_tahun_aula() {
        $sql = "SELECT YEAR(tanggal_daftar)'tahun' FROM aula
                UNION SELECT YEAR(NOW()) FROM aula";
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
