<?php

class m_pendaftaran_rujukan_asuransi extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function tambah_pendaftaran_rujukan_asuransi($parameter) {
        $sql = 'INSERT INTO asuransi (Jenis_Asuransi,Id_Pengguna,Nama_RS,Alamat_RS,Kronologi,Tanggal_Daftar,
            Tanggal_Masuk,Tanggal_Keluar,Total_Biaya,Santunan,Status_Asuransi) VALUES (?,?,?,?,?,?,?,?,?,?,?)';
        return $this->db->query($sql, $parameter);
    }

    function ambil_pendaftaran_rujukan_asuransi($parameter) {
        $sql = 'SELECT a.*, b.* FROM asuransi a
                INNER JOIN pengguna b ON b.Id_Pengguna = a.Id_Pengguna
                ';
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

    function get_pendaftaran_rujukan_asuransi_by_id($asuransi) {
        $sql = "SELECT * FROM asuransi WHERE Id_Asuransi = ?";
        $query = $this->db->query($sql, $asuransi);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }

    function hasil_pendaftaran_rujukan_asuransi($parameter) {
        $sql = 'SELECT a.*,b.* FROM asuransi a
                INNER JOIN pengguna b ON b.Id_Pengguna = a.Id_Pengguna
                WHERE a.Id_Asuransi = ?';
        $query = $this->db->query($sql, $parameter);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }

    function get_last_id() {
        return $this->db->insert_id();
    }

}
