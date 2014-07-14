<?php

/*
 * Template untuk model secara umum ( CRUD )
 * By : Praditya Kurniawan
 * website : http://masiyak.com
 * email : aku@masiyak.com
 * 
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class model_umum extends CI_Model {

    function ambil_data_tabel($tabel, $order = null, $filter = null, $limit = null, $offset = null) {

        //digunakan jika user memberikan parameter 'where' dalam query nya
        //secara default bernilai null (tidak ada kondisi)
        if ($filter != null && is_array($filter))
            $this->db->where($filter);

        //digunakan jika user memberikan parameter order by dalam query
        //parameter yang dikirimkan harus dalam bentuk array
        //secara default bernilai null (tidak diurutkan)
        if ($order != null && is_array($order)) {
            while ($array_order = current($order)) {
                if (strtolower($array_order) == 'asc' || strtolower($array_order) == 'desc')
                    $this->db->order_by(key($order), $array_order);
                next($order);
            }
        }

        //digunakan untuk menentukan limit atau offset
        //secara default bernilai null (tidak dibatasi)
        if ($limit != null && $offset != null)
            $this->db->limit($limit, $offset);
        elseif ($limit != null)
            $this->db->limit($limit);

        return $this->db->get($tabel);
    }

    function tambah_data_tabel($tabel, $data, $id_data = false) {
        $this->db->insert($tabel, $data);

        if ($id_data)
            return $this->db->insert_id();
        else
            return $this->db->affected_rows();
    }

    function tambah_data_tabel_batch($tabel, $data) {
        $this->db->insert_batch($tabel, $data);
        return $this->db->affected_rows();
    }

    function native_query($sql) {
        return $this->db->query($sql);
    }

}

?>
