<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class m_informasi extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_list_data($params) {
        $sql = 'SELECT informasi.id_informasi AS id_informasi, informasi.judul_info AS judul_info, 
                loginuser.username AS username
                FROM informasi
                JOIN loginuser ON loginuser.id_login = informasi.id_login
                WHERE informasi.judul_info LIKE ?
                ORDER BY infomasi.tanggal_info ASC LIMIT ?,?';
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    //hitung jumlah data pencarian
    function count_search_data($params) {
        $sql = 'SELECT count(id_informasi) AS jumlah
                FROM informasi
                WHERE informasi.judul_info LIKE ?
                ORDER BY informasi.tanggal_info ASC';
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['jumlah'];
        } else {
            return array();
        }
    }
    //ambil data detail pelanggan
        function get_detail_informasi($params) {
            $sql = 'SELECT a.*,b.username FROM informasi a 
                    JOIN loginuser b ON b.id_login = a.id_login
                    WHERE id_informasi = ?';
            $query = $this->db->query($sql, $params);
            if ($query->num_rows() > 0) {
                $result = $query->row_array();
                $query->free_result();
                return $result;
            } else {
                return array();
            }
        }
    //hapus data pelanggan by id
    function hapus_pelanggan_by_id($params) {
        $sql = 'DELETE FROM informasi WHERE id_informasi = ?';
        return $this->db->query($sql, $params);
    }

}
