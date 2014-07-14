<?php

/*
 * By : Praditya Kurniawan
 * website : http://masiyak.com
 * email : aku@masiyak.com
 * 
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class operator_base extends CI_Controller {

    private $file_js = '';
    private $file_css = '';
    private $current_id_menu = '';
    public $page_role = array('c' => 0, 'r' => 0, 'u' => 0, 'd' => 0);

    public function __construct() {
        parent::__construct();
        $this->load->model('m_site');
        $this->cek_login();
        $this->get_current_id_menu();
        $this->get_all_role();
//        $this->load->model('m_base');
    }

    //fungsi untuk meload javascript
    protected function load_js($alamat) {
        if (is_file($alamat)) {
            $this->file_js .= '<script src="' . base_url($alamat) . '" type="text/javascript"></script>';
            $this->file_js .= "\n";
        } else {
            $this->file_js .= 'File javascript ' . $alamat . ' tidak ditemukan! <br>';
        }
    }

    //fungsi untuk meload css
    protected function load_css($alamat) {
        if (is_file($alamat)) {
            $this->file_css .= '<link href="' . base_url($alamat) . '" rel="stylesheet" type="text/css" />';
        } else {
            $this->file_css .= 'File css ' . $alamat . ' tidak ditemukan! <br>';
        }
    }

//fungsi untuk meload menu samping
    private function load_menu_sidebar($hasil = '') {
        $level = $this->sesi->get_data_login('id_level');
        $current_page = $this->uri->segment(1);
        $menu = $this->m_site->get_sidebar_admin_menu(array(0, $level));
//inisialisasi menu sidebar
        if (count($menu) > 0)
            $hasil .='<ul class="sidebar-menu">';
        //melakukan perulangan untuk menampilkan menu
        foreach ($menu as $rs_menu) {
            $hasil .= '<li';
            //mencari child menu
            $menu_child = null;
            $menu_child = $this->m_site->get_sidebar_admin_menu(array($rs_menu['id_menu'], $level));
            if (count($menu_child) > 0) {
                if ($this->m_site->get_child_sidebar_admin_menu_by_link($rs_menu['id_menu'], $current_page))
                    $hasil .= ' class="treeview active">';
                else
                    $hasil .= ' class="treeview">';

                $hasil .= '<a href="' . base_url($rs_menu['link']) . '">';
                $hasil .= $rs_menu['icon'] . '</i> <span>' . $rs_menu['nama_menu'] . '</span>';
                $hasil .= '<i class="fa fa-angle-left pull-right"></i>';
                $hasil .= '</a>';
                $hasil .='<ul class="treeview-menu">';
                foreach ($menu_child as $rs_menu_child) {
                    $hasil .= '<li';
                    $hasil .= $current_page == $rs_menu_child['link'] ? ' class="active">' : '>';
                    $hasil .= '<a href="' . base_url($rs_menu_child['link']) . '">';
                    $hasil .= $rs_menu_child['icon'] . '</i>' . $rs_menu_child['nama_menu'];
                    $hasil .= '</a >';
                    $hasil .= '</li>';
                }
                $hasil .='</ul>';
            } else {
                $hasil .= $current_page == $rs_menu['link'] ? ' class="active">' : '>';
                $hasil .= '<a href="' . base_url($rs_menu['link']) . '">';
                $hasil .= $rs_menu['icon'] . '</i> <span>' . $rs_menu['nama_menu'] . '</span>';
                $hasil .= '</a >';
                $hasil .= '</li>';
            }
        }

        if (count($menu) > 0)
            $hasil .='</ul">';

        return $hasil;
    }

//fungsi untuk menampilkan halaman
    protected function display($tpl_content = 'default_index_backend.php', $data = array(), $tpl_footer = null) {
//        $this->load_menu_sidebar();
        $data['DATA_LOGIN'] = $this->sesi->get_all_data_login();
        $data['FILE_JS'] = $this->file_js;
        $data['FILE_CSS'] = $this->file_css;
        $data['ROLE'] = $this->page_role;
        $data['TPL_SIDE_MENU'] = $this->load_menu_sidebar();
        $data['TPL_ISI'] = $tpl_content;
        $data['TPL_FOOTER'] = $tpl_footer;
//        $this->output->cache(60);
        $this->load->view('templates/templateadmin', $data);
    }

    private function cek_login() {
        if (!$this->sesi->sudah_login())
            redirect('autentifikasi');
    }

    private function get_current_id_menu() {
        $link = $this->uri->segment(1);
        $this->current_id_menu = $this->m_site->get_id_menu($link);
    }

//mendapatkan hak akses pengguna pada modul
    private function get_all_role() {
        $rs_role = $this->m_site->get_page_role_level($this->current_id_menu, $this->sesi->get_data_login('id_level'));
        if ($rs_role) {
            $a = 0;
            foreach ($this->page_role as $index => $value) {
                $this->page_role[$index] = substr($rs_role, $a, 1);
                $a++;
            }
        } else {
            redirect('autentifikasi');
        }
    }

//memberikan hak pada suatu function
    protected function _set_page_role($role) {
        if (empty($role) || $this->page_role[$role] != 1)
            redirect('autentifikasi');
    }

}
