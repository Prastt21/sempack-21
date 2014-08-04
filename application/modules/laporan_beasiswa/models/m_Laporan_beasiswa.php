<?php

class m_laporan_beasiswa extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    function ambil_laporan_beasiswa($parameter) {
        $sql = 'SELECT beasiswa.*, jenis_beasiswa.*,pengguna.*,jurusan.* 
                FROM beasiswa JOIN jenis_beasiswa ON beasiswa.id_jb=jenis_beasiswa.id_jb
                JOIN pengguna ON beasiswa.id_pengguna=pengguna.id_pengguna		
		JOIN jurusan ON beasiswa.id_jurusan=jurusan.id_jurusan WHERE MONTH(beasiswa.tanggal_daftar) = ? 
                AND YEAR(beasiswa.tanggal_daftar) = ? LIMIT ?,?';
        $query = $this->db->query($sql, $parameter);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }
    function ambil_jenis_beasiswa() {
        $sql = 'SELECT Id_JB,Jenis_Beasiswa FROM jenis_beasiswa';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }
    function ambil_jurusan() {
        $sql = 'SELECT Id_Jurusan,Nama_Jurusan FROM jurusan';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }

    function count_all_data() {
        $sql = "SELECT COUNT(Id_Beasiswa)'total' FROM beasiswa";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return false;
        }
    }

    function get_beasiswa_by_id($parameter) {
        $sql = "SELECT * FROM beasiswa WHERE Id_Beasiswa = ?";
        $query = $this->db->query($sql, $parameter);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }

    //ambil total beasiswa pada bulan sekarang
    function get_total_beasiswa($params) {
        $sql = "SELECT COUNT(id_beasiswa)'jumlah' FROM beasiswa";
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
    function get_tahun_beasiswa() {
        $sql = "SELECT YEAR(tanggal_daftar)'tahun' FROM beasiswa
                UNION SELECT YEAR(NOW()) FROM beasiswa";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }
    //ambil total beasiswa PPA pada bulan sebelumnya
    function get_total_ppa_last_month($params) {
        $sql = "SELECT COUNT(beasiswa.id_beasiswa)'total' FROM beasiswa INNER JOIN jenis_beasiswa 
                ON beasiswa.id_jb=jenis_beasiswa.id_jb
                WHERE MONTH(beasiswa.tanggal_daftar) < ? AND YEAR(beasiswa.tanggal_daftar) <= ? AND jenis_beasiswa.id_jb LIKE '1'";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return array();
        }
    }
    //ambil total pembelian pada bulan sekarang
    function get_total_ppa_this_month($params) {
        $sql = "SELECT COUNT(beasiswa.id_beasiswa)'total' FROM beasiswa INNER JOIN jenis_beasiswa 
                ON beasiswa.id_jb=jenis_beasiswa.id_jb
                WHERE MONTH(beasiswa.tanggal_daftar) = ? AND YEAR(beasiswa.tanggal_daftar) = ? 
                AND jenis_beasiswa.id_jb LIKE '1'";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return array();
        }
    }
    
    //ambil total beasiswa PPA pada bulan sebelumnya
    function get_total_bbp_last_month($params) {
        $sql = "SELECT COUNT(beasiswa.id_beasiswa)'total' FROM beasiswa INNER JOIN jenis_beasiswa 
                ON beasiswa.id_jb=jenis_beasiswa.id_jb
                WHERE MONTH(beasiswa.tanggal_daftar) < ? AND YEAR(beasiswa.tanggal_daftar) <= ? AND jenis_beasiswa.id_jb LIKE '2'";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return array();
        }
    }
    //ambil total pembelian pada bulan sekarang
    function get_total_bbp_this_month($params) {
        $sql = "SELECT COUNT(beasiswa.id_beasiswa)'total' FROM beasiswa INNER JOIN jenis_beasiswa 
                ON beasiswa.id_jb=jenis_beasiswa.id_jb
                WHERE MONTH(beasiswa.tanggal_daftar) = ? AND YEAR(beasiswa.tanggal_daftar) = ? 
                AND jenis_beasiswa.id_jb LIKE '2'";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return array();
        }
    }
    
    //ambil total beasiswa PPA pada bulan sebelumnya
    function get_total_muamalat_last_month($params) {
        $sql = "SELECT COUNT(beasiswa.id_beasiswa)'total' FROM beasiswa INNER JOIN jenis_beasiswa 
                ON beasiswa.id_jb=jenis_beasiswa.id_jb
                WHERE MONTH(beasiswa.tanggal_daftar) < ? AND YEAR(beasiswa.tanggal_daftar) <= ? AND jenis_beasiswa.id_jb LIKE '3'";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return array();
        }
    }
    //ambil total pembelian pada bulan sekarang
    function get_total_muamalat_this_month($params) {
        $sql = "SELECT COUNT(beasiswa.id_beasiswa)'total' FROM beasiswa INNER JOIN jenis_beasiswa 
                ON beasiswa.id_jb=jenis_beasiswa.id_jb
                WHERE MONTH(beasiswa.tanggal_daftar) = ? AND YEAR(beasiswa.tanggal_daftar) = ? 
                AND jenis_beasiswa.id_jb LIKE '3'";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return array();
        }
    }
}
