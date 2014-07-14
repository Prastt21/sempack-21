<?php

/*
 * By : Praditya Kurniawan
 * website : http://masiyak.com
 * email : aku@masiyak.com
 * 
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class m_site extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_sidebar_admin_menu($param) {

        $sql = 'SELECT sys_menu.id_menu AS id_menu,sys_menu.nama_menu AS nama_menu,
                sys_menu.parent_id AS parent_id,sys_menu.link AS link,sys_menu.icon AS icon
                FROM sys_menu
                JOIN sys_level_menu ON sys_menu.id_menu = sys_level_menu.id_menu
                WHERE sys_menu.tampil = 1 AND sys_menu.parent_id = ? AND sys_level_menu.id_level = ?';
        $query = $this->db->query($sql, $param);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    function get_child_sidebar_admin_menu_by_link($id, $par) {
        $this->db->select('id_menu');
        $this->db->from('sys_menu');
        $this->db->where('tampil', 1);
        $this->db->where('link', $par);
        $this->db->where('parent_id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $query->free_result();
            return true;
        } else {
            $query->free_result();
            return false;
        }
    }

    function get_id_menu($par) {
        $this->db->select('id_menu');
        $this->db->from('sys_menu');
        $this->db->where('link', $par);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $hasil = $query->row()->id_menu;
            $query->free_result();
        } else {
            $hasil = false;
        }

        return $hasil;
    }

    function get_page_role_level($id_menu, $id_level) {
        $this->db->select('hak');
        $this->db->from('sys_level_menu');
        $this->db->where('id_menu', $id_menu);
        $this->db->where('id_level', $id_level);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $hasil = $query->row()->hak;
            $query->free_result();
        } else {
            $hasil = false;
        }

        return $hasil;
    }

}
