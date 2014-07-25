<?php

/*
 * By : Praditya Kurniawan
 * website : http://masiyak.com
 * email : aku@masiyak.com
 * 
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class m_dashboard extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //get total penjualan per hari
    function get_total_penjualan_by_day($params) {
        $sql = 'SELECT SUM((diskon + total_bayar))"total" 
                FROM data_penjualan WHERE DATE(tanggal_penjualan) = ? AND id_pengguna = ?';
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
    function get_total_penjualan_by_month($params) {
        $sql = 'SELECT SUM((total_bayar))"total" 
                FROM data_penjualan WHERE MONTH(tanggal_penjualan) = ? AND YEAR(tanggal_penjualan) = ? AND id_pengguna = ?';
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'] != null ? $result['total'] : 0;
        } else {
            return array();
        }
    }

    //get total item terjual
    function get_total_item_terjual($params) {
        $sql = 'SELECT SUM(a.jumlah_barang)"jumlah" 
                FROM data_detail_penjualan a
                JOIN data_detail_barang b ON b.id_detail_barang = a.id_detail_barang
                JOIN data_barang c ON c.id_barang = b.id_barang
                JOIN data_penjualan d ON d.id_penjualan = a.id_penjualan
                WHERE MONTH(d.tanggal_penjualan) = ? AND YEAR(d.tanggal_penjualan) = ? AND c.kepemilikan LIKE ? AND d.id_pengguna = ?';
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['jumlah'] != null ? $result['jumlah'] : 0;
        } else {
            return array();
        }
    }

    //get item laris
    function get_item_laris($params) {
        $sql = "SELECT a.id_detail_barang,c.nama_barang, b.macam,SUM(a.jumlah_barang)'jumlah_barang' 
                FROM data_detail_penjualan a
                JOIN data_detail_barang b ON b.id_detail_barang = a.id_detail_barang
                JOIN data_barang c ON c.id_barang = b.id_barang
                JOIN data_penjualan d ON d.id_penjualan = a.id_penjualan
                WHERE d.id_pengguna = ?
                GROUP BY a.id_detail_barang
                ORDER BY jumlah_barang DESC
                LIMIT ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    function cek_registrasi_kasir($params) {
        $sql = "SELECT id_log_kasir FROM data_kasir WHERE id_pengguna = ? AND DATE(waktu_login) = DATE(NOW())";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $query->free_result();
            return 1;
        } else {
            return 0;
        }
    }

}