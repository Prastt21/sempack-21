<?php

class m_beasiswa extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function tambah_beasiswa($parameter) {
        $sql = 'INSERT INTO beasiswa (Id_JB,Id_Pengguna,Id_Jurusan,Jenjang,Alamat_Sekarang,
                Nama_PT,Semester,IPK,Prestasi,Alasan,BANK,No_Rekening,Tanggal_Daftar,Status_Beasiswa) 
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
        return $this->db->query($sql, $parameter);
    }

    function ambil_beasiswa($parameter) {
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

    function ubah_beasiswa($parameter) {
        $sql = 'UPDATE beasiswa SET Id_JB=?,Id_Jurusan=?,Jenjang=?,Alamat_Sekarang=?,
            Nama_PT=?,Semester=?,IPK=?,Prestasi=?,Alasan=?,BANK=?,No_Rekening=?,Tanggal_Daftar=?,Status_Beasiswa=?
            WHERE Id_Beasiswa = ?';
        return $this->db->query($sql, $parameter);
    }

    function hapus_beasiswa($params) {
        $sql = 'DELETE FROM beasiswa WHERE id_beasiswa = ?';
        return $this->db->query($sql, $params);
    }
    //count search data
    function count_search_data($params) {
        $sql = 'SELECT count(beasiswa.id_beasiswa) as jumlah FROM beasiswa JOIN jenis_beasiswa ON beasiswa.id_jb=jenis_beasiswa.id_jb
                JOIN pengguna ON beasiswa.id_pengguna=pengguna.id_pengguna		
		JOIN jurusan ON beasiswa.id_jurusan=jurusan.id_jurusan
                WHERE pengguna.nama_pengguna LIKE ? LIMIT 1';
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['jumlah'];
        } else {
            return array();
        }
    }
    function get_list_data($params) {
        $sql = 'SELECT beasiswa.*, jenis_beasiswa.*,pengguna.*,jurusan.* 
                FROM beasiswa JOIN jenis_beasiswa ON beasiswa.id_jb=jenis_beasiswa.id_jb
                JOIN pengguna ON beasiswa.id_pengguna=pengguna.id_pengguna		
		JOIN jurusan ON beasiswa.id_jurusan=jurusan.id_jurusan
                WHERE pengguna.nama_pengguna LIKE ? ORDER BY pengguna.nama_pengguna ASC LIMIT ?,?';
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

}
