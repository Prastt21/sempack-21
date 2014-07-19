<?php

class m_jenis_beasiswa extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function tambah_jenis_beasiswa($parameter) {
        $sql = 'INSERT INTO jenis_beasiswa (Id_JB,Jenis_Beasiswa,Warna_Beasiswa) VALUES (?,?,?)';
        return $this->db->query($sql, $parameter);
    }

    function ambil_jenis_beasiswa($parameter) {
        $sql = 'SELECT * FROM Jenis_Beasiswa
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
        $sql = "SELECT COUNT(Id_JB)'total' FROM Jenis_Beasiswa";
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
