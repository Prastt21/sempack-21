<?php

class m_beasiswa extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function tambah_beasiswa($parameter) {
        $sql = 'INSERT INTO asuransi (Id_Asuransi,Jenis_Asuransi,Id_Pengguna,Nama_RS,Alamat_RS,
            Tanggal_Masuk,Tanggal_Keluar,Santunan) VALUES (?,?,?,?,?,?,?,?)';
        return $this->db->query($sql, $parameter);
    }

    function ambil_beasiswa($parameter) {
        $sql = 'SELECT a.*, b.* FROM asuransi a
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
        $sql = "SELECT COUNT(Id_Asuransi)'total' FROM Asuransi";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return false;
        }
    }
    
    function ubah_beasiswa(){
        $sql = 'UPDATE informasi (Id_Pengguna,Judul_Info, Isi_info, Jenis_Info) WHERE(?,?,?,?)';
        return $this->db->query($sql, $parameter);
    }
    
    function hapus_beasiswa($params) {
        $sql = 'DELETE FROM beasiswa WHERE id_beasiswa = ?';
        return $this->db->query($sql, $params);
    }

}
