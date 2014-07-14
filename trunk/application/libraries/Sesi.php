<?php

/*
 * by : Praditya Kurniawan
 * web : http://masiyak.com
 * email : aku@masiyak.com
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sesi {

    //set global variabel
    private $DATA_LOGIN = array();

    function __construct() {
        $this->ci = & get_instance();
    }

    function do_login() {
        $this->DATA_LOGIN['STATUS_LOGIN'] = 1;
        return $this->ci->session->set_userdata('DATA_LOGIN', $this->DATA_LOGIN);
    }

    function set_nama_pengguna($pengguna) {
        $this->DATA_LOGIN['NAMA_PENGGUNA'] = $pengguna;
    }

    function set_nama_lengkap($nama) {
        $this->DATA_LOGIN['NAMA_LENGKAP'] = $nama;
    }

    function set_id($id) {
        $this->DATA_LOGIN['ID_PENGGUNA'] = $id;
    }

    function set_portal($portal) {
        $this->DATA_LOGIN['PORTAL'] = $portal;
    }

    function set_level($level) {
        $this->DATA_LOGIN['ID_LEVEL'] = $level;
    }

    function set_nama_level($level) {
        $this->DATA_LOGIN['NAMA_LEVEL'] = $level;
    }

    function sudah_login() {
        $data_login = $this->ci->session->userdata('DATA_LOGIN') ? $this->ci->session->userdata('DATA_LOGIN') : 0;
        return is_array($data_login) ? $data_login['STATUS_LOGIN'] : 0;
    }

    function keluar() {
        return $this->ci->session->sess_destroy();
    }

    function get_data_login($parameter) {
        if (isset($parameter)) {
            $data_login = $this->ci->session->userdata('DATA_LOGIN');
            $i = strtoupper($parameter);
            return empty($data_login[$i]) ? false : $data_login[$i];
        } else {
            return false;
        }
    }

    function get_all_data_login() {
        return $this->ci->session->userdata('DATA_LOGIN');
    }

}

?>
