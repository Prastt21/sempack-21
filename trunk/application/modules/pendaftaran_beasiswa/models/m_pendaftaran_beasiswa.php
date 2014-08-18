<?php

class m_pendaftaran_beasiswa extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function tambah_pendaftaran_beasiswa($parameter) {
        $sql = 'INSERT INTO beasiswa (Id_JB,Id_Pengguna,Id_Jurusan,Id_Periode,Jenjang,Alamat_Sekarang,
                Nama_PT,Semester,IPK,Prestasi,Alasan,BANK,No_Rekening,Tanggal_Daftar,Status_Beasiswa) 
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
        return $this->db->query($sql, $parameter);
    }

    function ambil_pendaftaran_beasiswa($parameter) {
        $sql = 'SELECT a.*, b.*,c.*,d.* 
                FROM beasiswa a JOIN jenis_beasiswa b ON a.id_jb=b.id_jb
                JOIN pengguna c ON a.id_pengguna=c.id_pengguna		
		JOIN jurusan d ON a.id_jurusan=d.id_jurusan';
        $query = $this->db->query($sql, $parameter);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }
    function get_periode_sistem() {
        $sql = "SELECT Id_Periode FROM sistem";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
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

    function get_pendaftaran_beasiswa_by_id($parameter) {
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
    function cek_pendaftaran_beasiswa_by_id_pengguna($parameter) {
        $sql = "SELECT id_pengguna FROM beasiswa WHERE id_pengguna LIKE ?";
        $query = $this->db->query($sql, $parameter);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return true;
        } else {
            return false;
        }
    }
    function hasil_pendaftaran_beasiswa($parameter) {
        $sql = 'SELECT a.*,b.*,c.*,d.* FROM beasiswa a
                INNER JOIN pengguna b ON b.Id_Pengguna = a.Id_Pengguna
                INNER JOIN jurusan c ON c.id_jurusan=a.id_jurusan 
                INNER JOIN jenis_beasiswa d ON d.id_jb=a.id_jb WHERE a.Id_Beasiswa = ?';
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
