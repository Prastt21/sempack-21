<?php

class m_peminjaman_aula extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function tambah_peminjaman_aula($parameter) {
        $sql = 'INSERT INTO aula (Id_Pengguna,Nama_Kegiatan,Ketua_Organisasi,Peserta,
                Jml_Peserta,Tanggal_Daftar,Tanggal_Pinjam,Waktu_Pinjam,Tanggal_Selesai,Waktu_Selesai,Status_Penggunaan) 
                VALUES (?,?,?,?,?,?,?,?,?,?)';
        return $this->db->query($sql, $parameter);
    }

    function ambil_peminjaman_aula($parameter) {
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

    function ubah_peminjaman_aula($parameter) {
        $sql = 'UPDATE aula SET Id_Pengguna=?, Nama_Kegiatan=?, Ketua_Organisasi=?, Peserta=?,
                Jml_Peserta=?, Tanggal_Daftar=?,Tanggal_Pinjam=?, Waktu_Pinjam=?,Tanggal_Selesai=?,Waktu_Selesai=?,
                Status_Penggunaan=? WHERE Id_Pinjam_Aula = ?';
        return $this->db->query($sql, $parameter);
    }

    function hapus_peminjaman_aula($params) {
        $sql = 'DELETE FROM aula WHERE id_pinjam_aula = ?';
        return $this->db->query($sql, $params);
    }
    //get data
    function get_list_data($params) {
        $sql = 'SELECT a.*,b.* FROM aula a INNER JOIN pengguna b ON a.id_pengguna=b.id_pengguna 
                WHERE a.nama_kegiatan LIKE ? ORDER BY a.nama_kegiatan ASC LIMIT ?,?';
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
        $sql = 'SELECT count(id_pinjam_aula) as jumlah FROM aula 
                WHERE nama_kegiatan LIKE ? LIMIT 1';
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
