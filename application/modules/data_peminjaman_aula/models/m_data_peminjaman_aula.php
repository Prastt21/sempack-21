<?php

class m_data_peminjaman_aula extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    function ambil_data_peminjaman_aula($parameter) {
        $sql = 'SELECT a.*, b.* FROM aula a
                INNER JOIN pengguna b ON b.Id_Pengguna = a.Id_Pengguna
                LIMIT ?,?';
        $query = $this->db->query($sql, $parameter);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }

    function count_all_data() {
        $sql = "SELECT COUNT(Id_Pinjam_Aula)'total' FROM aula";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return false;
        }
    }

    function get_data_peminjaman_aula_by_id($parameter) {
        $sql = "SELECT * FROM aula WHERE Id_Pinjam_Aula = ?";
        $query = $this->db->query($sql, $parameter);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return false;
        }
    }

    function ubah_data_peminjaman_aula($parameter) {
        $sql = 'UPDATE aula SET Id_Pengguna=?, Nama_Kegiatan=?, Ketua_Organisasi=?, Peserta=?,
                Jml_Peserta=?, Tanggal_Pinjam=?, Waktu_Pinjam=?,Tanggal_Selesai=?,Waktu_Selesai=?,
                Status_Penggunaan=? WHERE Id_Pinjam_Aula = ?';
        return $this->db->query($sql, $parameter);
    }

    function hapus_data_peminjaman_aula($params) {
        $sql = 'DELETE FROM aula WHERE id_pinjam_aula = ?';
        return $this->db->query($sql, $params);
    }

}
