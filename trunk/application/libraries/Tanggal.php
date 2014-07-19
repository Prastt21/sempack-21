<?php

/*
 * by : Praditya Kurniawan
 * web : http://masiyak.com
 * email : aku@masiyak.com
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tanggal {

    function __construct() {
        $this->ci = & get_instance();
    }

    var $bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    function tanggal_indonesia($tanggal) {

        $tahun = substr($tanggal, 0, 4);
        $bulan = substr($tanggal, 5, 2);
        $tgl = substr($tanggal, 8, 2);

        $tanggal_baru = $tgl . " " . $bulan[(int) $bulan - 1] . " " . $tahun;

        return $tanggal_baru;
    }
    
    function bulan_indonesia($tanggal){
        $bulan = substr($tanggal, 5, 2);
        
        return $bulan[(int) $bulan - 1];
    }
    
    function tahun($tanggal){
        
        return substr($tanggal, 0, 4);
    }

}

?>
