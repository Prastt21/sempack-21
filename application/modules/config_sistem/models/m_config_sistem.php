<?php

class m_config_sistem extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function ambil_data_periode() {
        $sql = 'SELECT Id_Periode,Tahun FROM Periode';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }

    function load_current_sistem() {
        $sql =('SELECT Status_Sistem,Pengumuman_Sistem, StatusRequest_Sistem,KarReq_Sistem,
		Id_Periode,Tahun FROM sistem s 
		JOIN periode p on p.Id_Periode = s.Id_Periode');

        if ($query->num_rows() > 0) {
            return $sql->row();
        } else {
            return null;
        }
    }

    function ubah_sistem() {
        $sql = ("UPDATE sistem SET Status_Sistem=?, Id_Periode =?");
        return $this->db->query($sql);
    }

    function get_sistem_by_id($parameter) {
        $sql = "SELECT a.*,b.* FROM sistem a JOIN periode b  WHERE a.id_periode = b.id_periode";
        $query = $this->db->query($sql,$parameter);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }
}
