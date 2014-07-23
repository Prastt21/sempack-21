<?php

class m_keterangan_orang_tua extends CI_Model {

    public function __construct() {
        parent::__construct();
    }  

    function ambil_keterangan_orang_tua($parameter) {
        $sql = 'SELECT b.Nama_Pengguna,a.Nama_Ortu,a.Alamat_Ortu,a.No_Telp_Ortu,a.Pekerjaan_Ortu,
                a.Penghasilan_Ortu,a.Jml_Tanggungan FROM keterangan_ortu a
                INNER JOIN pengguna b ON b.Id_Ortu = a.Id_Ortu
                WHERE b.Id_Level LIKE 3 LIMIT ?,?';
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
        $sql = "SELECT COUNT(Id_Pengguna)'total' FROM (keterangan_ortu a
                INNER JOIN pengguna b ON b.Id_Ortu = a.Id_Ortu)
                WHERE b.Id_Level LIKE '3'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return false;
        }
    }

    function get_keterangan_orang_tua_by_id($parameter) {
        $sql = "SELECT * FROM keterangan_ortu WHERE Id_Ortu = ?";
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
