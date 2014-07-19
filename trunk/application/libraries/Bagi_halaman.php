<?php

/*
 * by : Praditya Kurniawan
 * web : http://masiyak.com
 * email : aku@masiyak.com
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bagi_halaman {
    
    function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->library('pagination');
    }
    
    function paging($banyak, $jumlah, $alamat,$uri=4) {
        $config['base_url'] = base_url($alamat);
        $config['total_rows'] = $banyak;
        $config['per_page'] = $jumlah;
        $config['num_links'] = 4;
        $config['first_link'] = 'Awal';
        $config['last_link'] = 'Akhir';
        $config['cur_pages'] = 1;
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = '</ul>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='active'><span>";
        $config['cur_tag_close'] = "</span></li>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['uri_segment'] = $uri;

        $this->ci->pagination->initialize($config);


        return $this->ci->pagination->create_links();
    }
    
    
}
?>
