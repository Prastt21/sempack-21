<?php

class m_data_beasiswa extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function ambil_data_beasiswa($parameter) {
        $sql = 'SELECT beasiswa.*, jenis_beasiswa.*,pengguna.*,jurusan.* 
                FROM beasiswa JOIN jenis_beasiswa ON beasiswa.id_jb=jenis_beasiswa.id_jb
                JOIN pengguna ON beasiswa.id_pengguna=pengguna.id_pengguna		
		JOIN jurusan ON beasiswa.id_jurusan=jurusan.id_jurusan
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

    function get_data_beasiswa_by_id($parameter) {
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

    function ubah_data_beasiswa($parameter) {
        $sql = 'UPDATE beasiswa SET Id_JB=?,Id_Pengguna=?,Id_Jurusan=?,Jenjang=?,Alamat_Sekarang=?,
            Nama_PT=?,Semester=?,IPK=?,Prestasi=?,Alasan=?,BANK=?,No_Rekening=?,Tanggal_Daftar=?,Status_Beasiswa=?
            WHERE Id_Beasiswa = ?';
        return $this->db->query($sql, $parameter);
    }

    function hapus_data_beasiswa($params) {
        $sql = 'DELETE FROM beasiswa WHERE id_beasiswa = ?';
        return $this->db->query($sql, $params);
    }

}
