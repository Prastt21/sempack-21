<?php

class m_periode extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function tambah_periode($parameter) {
        $sql = 'INSERT INTO periode (Id_Periode,Tahun) VALUES (?,?)';
        return $this->db->query($sql, $parameter);
    }

    function ambil_periode($parameter) {
        $sql = 'SELECT * FROM periode LIMIT ?,?';
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
        $sql = "SELECT COUNT(Id_Periode)'total' FROM Periode";
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
