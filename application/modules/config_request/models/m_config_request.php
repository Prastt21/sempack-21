<?php

class m_config_request extends CI_Model {

    public function __construct() {
        parent::__construct();
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

    function ubah_request($parameter) {
        $sql = "UPDATE sistem SET StatusRequest_Sistem=?, KarReq_Sistem  =?";
        return $this->db->query($sql,$parameter);
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
