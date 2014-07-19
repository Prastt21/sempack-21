<?php

class m_peminjaman_aula extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function tambah_peminjaman_aula($parameter) {
        $sql = 'INSERT INTO aula (Id_Pinjam_Aula,Id_Pengguna,Nama_Kegiatan,Ketua_Organisasi,Peserta,
            Jml_Peserta,Tanggal_Pinjam,Waktu_Pinjam,Tanggal_Selesai,Waktu_Selesai,Status_Penggunaan) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?)';
        return $this->db->query($sql, $parameter);
    }

    function ambil_peminjaman_aula($parameter) {
        $sql = 'SELECT b.Nama_Pengguna, a.Nama_Kegiatan,a.Ketua_Organisasi,a.Peserta,a.Jml_Peserta,a.Tanggal_Pinjam,
                a.Waktu_Pinjam,a.Tanggal_Selesai,a.Waktu_Selesai,a.Status_Penggunaan 
                FROM aula a INNER JOIN pengguna b ON b.Id_Pengguna = a.Id_Pengguna
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
    
    function ubah_data_informasi(){
        $sql = 'UPDATE informasi (Id_Pengguna,Judul_Info, Isi_info, Jenis_Info) WHERE(?,?,?,?)';
        return $this->db->query($sql, $parameter);
    }
    
    function hapus_data_informasi($params) {
        $sql = 'DELETE FROM informasi WHERE id_informasi = ?';
        return $this->db->query($sql, $params);
    }

}
