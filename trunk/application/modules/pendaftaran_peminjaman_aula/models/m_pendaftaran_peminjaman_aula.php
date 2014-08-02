<?php

class m_pendaftaran_peminjaman_aula extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function tambah_pendaftaran_peminjaman_aula($parameter) {
        $sql = 'INSERT INTO aula (Id_Pengguna,Nama_Kegiatan,Ketua_Organisasi,Peserta,
                Jml_Peserta,Tanggal_Daftar,Tanggal_Pinjam,Waktu_Pinjam,Tanggal_Selesai,Waktu_Selesai,Status_Penggunaan) 
                VALUES (?,?,?,?,?,?,?,?,?,?,?)';
        return $this->db->query($sql, $parameter);
    }

    function ambil_pendaftaran_peminjaman_aula($parameter) {
        $sql = 'SELECT a.*, b.* FROM aula a
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

    function get_pendaftaran_peminjaman_aula_by_id($parameter) {
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
    function cek_pendaftaran_aula_by_tglPinjam($parameter) {
        $sql = "SELECT Tanggal_Pinjam, Waktu_Pinjam FROM aula WHERE Tanggal_Pinjam = 'tanggal_pinjam' AND 
                Waktu_Pinjam ='waktu_pinjam' ";
        $query = $this->db->query($sql, $parameter);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }   
}
