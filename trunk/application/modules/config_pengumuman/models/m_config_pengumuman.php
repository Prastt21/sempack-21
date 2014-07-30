<?php

class m_config_pengumuman extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    function ambil_data_periode($parameter) {
        $sql = 'SELECT Id_Periode,Tahun FROM Periode
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
    function load_current_sistem(){
        $query = $this->db->query('SELECT Status_Sistem,Pengumuman_Sistem, StatusRequest_Sistem,KarReq_Sistem,
		Id_Periode,Tahun FROM sistem s 
		JOIN periode p on p.Id_Periode = s.Id_Periode');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }
    function update_pengumuman($status, $pesan){
        $sql = $this->db->query("UPDATE sistem SET Pengumuman_Sistem = '" . $pesan . "'");
        return $this->db->query($sql, $status, $pesan);
                
    }
}
