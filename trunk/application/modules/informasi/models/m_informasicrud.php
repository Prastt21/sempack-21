<?php

class m_informasicrud extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function insert_informasi($data) {
        $this->db->insert('informasi', $data);
    }

    function select_all() {
        $this->db->select('*');
        $this->db->from('informasi');
        $this->db->order_by('date_modified', 'desc');
        return $this->db->get();
    }

    function select_by_id($id_informasi) {
        $this->db->select('*');
        $this->db->from('informasi');
        $this->db->where('id_informasi', $id_informasi);
        return $this->db->get();
    }

    function update_informasi($id_informasi, $data) {
        $this->db->where('id_informasi', $id_informasi);
        $this->db->update('informasi', $data);
    }

    function delete_informasi($id_informasi) {
        $this->db->where('id_informasi', $id_informasi);
        $this->db->delete('informasi');
    }
// function yang digunakan oleh paginationsample
    function select_all_paging($limit = array()) {
        $this->db->select('*');
        $this->db->from('informasi');
        $this->db->order_by('date_modified', 'desc');
        if ($limit != NULL)
            $this->db->limit($limit['perpage'], $limit['offset']);
        return $this->db->get();
    }

}

?>