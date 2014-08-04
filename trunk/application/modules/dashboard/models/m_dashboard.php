<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class m_dashboard extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //get total penjualan per hari
    function get_total_peminjaman_aula_by_day($params) {
        $sql = 'SELECT COUNT(id_pinjam_aula)"total" FROM aula WHERE DATE(tanggal_daftar) LIKE ?
             AND id_pengguna LIKE ?';
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'] != null ? $result['total'] : 0;
        } else {
            return array();
        }
    }

    //get total penjualan per bulan
    function get_total_peminjaman_aula_by_month($params) {
        $sql = 'SELECT COUNT(id_pinjam_aula)"total" FROM aula
            WHERE MONTH(tanggal_daftar) LIKE ? AND YEAR(tanggal_daftar) LIKE ? 
            AND id_pengguna LIKE ? ';
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'] != null ? $result['total'] : 0;
        } else {
            return array();
        }
    }

    //get pengumuman sistem
    function get_pengumuman_sistem() {
        $sql = 'SELECT pengumuman_sistem from sistem';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    //get item laris
    function get_pengguna_pengunjung($params) {
        $sql = " LIMIT ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }
}