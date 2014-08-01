<?php

class m_manajemen_basisdata extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    function deleteAllTable($params) {
        $sql = 'DELETE FROM aula';
        $sql.= 'DELETE FROM beasiswa';
        $sql.= 'DELETE FROM asuransi';
        $sql.= 'DELETE FROM pendaftaran_asuransi';
        $sql.= 'DELETE FROM pendaftaran_beasiswa';
        $sql.= 'DELETE FROM periode';
        return $this->db->query($sql, $params);
    }
}