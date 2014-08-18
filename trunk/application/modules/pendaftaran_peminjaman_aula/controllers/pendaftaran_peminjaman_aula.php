<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class pendaftaran_peminjaman_aula extends operator_base {

    var $batas = 15;

    public function index() {
        //control hak akses read
        $this->_set_page_role('r');
        //load model
        $this->load->model('m_pendaftaran_peminjaman_aula');
        //load library
        $this->load->library('Form_validation');
        //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');
        parent::display('tambah_pendaftaran_peminjaman_aula');
    }

    function tambah_pendaftaran_peminjaman_aula() {
        //control hak akses create
        $this->_set_page_role('c');
        $this->load->library('Form_validation');
        //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');
        parent::display('tambah_pendaftaran_peminjaman_aula');
    }

    function proses_tambah_pendaftaran_peminjaman_aula() {
        //validasi tombol simpan, jika tidak ditekan maka redirect ke tampilan tambah informasi
        if ($this->input->post('simpan') == null)
            redirect('pendaftaran_peminjaman_aula/tambah_pendaftaran_peminjaman_aula');
        //load form validation
        $this->load->library('Form_validation');
        //set aturan validasi
        //$this->form_validation->set_rules('nama_peminjam', 'Nama Peminjam', 'required|trim');
        $this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required|trim');
        $this->form_validation->set_rules('ketua_organisasi', 'Ketua Organisasi', 'required|trim');
        $this->form_validation->set_rules('peserta', 'Peserta', 'required|trim');
        $this->form_validation->set_rules('jml_peserta', 'Jumlah Peserta', 'required|trim');
        $this->form_validation->set_rules('tanggal_daftar', 'Tanggal Daftar', 'required|trim');
        $this->form_validation->set_rules('tanggal_pinjam', 'Tanggal Pinjam', 'required|trim');
        $this->form_validation->set_rules('waktu_pinjam', 'Waktu Pinjam', 'required|trim');
        $this->form_validation->set_rules('tanggal_selesai', 'Tanggal Selesai', 'required|trim');
        $this->form_validation->set_rules('waktu_selesai', 'Waktu Selesai', 'required|trim');
        //$this->form_validation->set_rules('status_penggunaan', 'Status Penggunaan', 'required|trim');           
        //menjalankan validasi
        if ($this->form_validation->run() === FALSE) {
            //jika validasi ada yang eror, kirim notifikasi ke view
            $this->notification('error', validation_errors());
            $this->form_validation->keep_data();
            //redirect ke tampilan tambah data informasi
            redirect('pendaftaran_peminjaman_aula/tambah_pendaftaran_peminjaman_aula');
        } else {
            //load model
            $this->load->model('m_pendaftaran_peminjaman_aula');
            //set parameter array
            $parameter = array(
                $this->sesi->get_data_login('ID_PENGGUNA'),
                $this->input->post('nama_kegiatan'),
                $this->input->post('ketua_organisasi'),
                $this->input->post('peserta'),
                $this->input->post('jml_peserta'),
                $this->input->post('tanggal_daftar'),
                $this->input->post('tanggal_pinjam'),
                $this->input->post('waktu_pinjam'),
                $this->input->post('tanggal_selesai'),
                $this->input->post('waktu_selesai'),
                $this->input->post('status_penggunaan')
            );
            if ($this->m_pendaftaran_peminjaman_aula->cek_pendaftaran_aula_by_tglPinjam(array($this->input->post('tanggal_pinjam'), $this->input->post('waktu_pinjam') . ':00'))) {
                //jika sukses kirim pesan ke view
                $this->notification('error', 'Tanggal Dan Waktu Pinjam Sudah Digunakan, 
                                    Silahkan Ganti Tanggal Dan Waktu Pinjam');
                $this->form_validation->keep_data();
                redirect('pendaftaran_peminjaman_aula/tambah_pendaftaran_peminjaman_aula');
            } else {
                //jika gagal kirim pesan ke view
                if ($this->m_pendaftaran_peminjaman_aula->tambah_pendaftaran_peminjaman_aula($parameter)) {
                    //jika sukses kirim pesan ke view
                    $id = $this->m_pendaftaran_peminjaman_aula->get_last_id();
                    redirect('pendaftaran_peminjaman_aula/cetak_pendaftaran_aula_by_id/' . $id);
                } else {
                    //jika gagal kirim pesan ke view
                    $this->notification('error', 'Peminjaman Aula gagal ditambahkan');
                }
            }
            if ($_POST('tanggal_pinjam') < $_POST('tanggal_selesai') && $_POST('waktu_pinjam') <= $_POST('waktu_selesai')) {
                $this->notification('error', 'Peminjaman Aula gagal ditambahkan');
            }
        }
        //redirect ke form
        redirect('pendaftaran_peminjaman_aula');
    }

    function cetak_pendaftaran_aula_by_id($aula) {
        $this->load->model('m_pendaftaran_peminjaman_aula');
        $dataaulabyid = $this->m_pendaftaran_peminjaman_aula->hasil_pendaftaran_peminjaman_aula($aula);

        $this->load->library('pdf');
        $this->pdf->SetCreator(PDF_CREATOR);
        $this->pdf->SetAuthor('SEMPAK');
        $this->pdf->SetTitle('Lembar Pendafataran Peminjaman AULA BSC');
        $this->pdf->SetSubject('Lembar Pendafataran Peminjaman AULA BSC');
        $this->pdf->SetKeywords('Lembar Pendafataran Peminjaman AULA BSC');
        $this->pdf->setPrintHeader(true);
        $this->pdf->setPrintFooter(false);
        // set default header data
        $this->pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
        // set default monospaced font
        $this->pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        $this->pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $this->pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

        //set auto page breaks
        $this->pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        //set image scale factor
        $this->pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        //set some language-dependent strings
        //       $this->pdf->setLanguageArray($l);
        // ---------------------------------------------------------
        // set font
        $this->pdf->SetFont('times', '', 11);

        // add a page
        $this->pdf->AddPage('P', 'A4');
        ob_start();
        ?>
        <hr>        
        <u><p style="text-align: center;">LEMBAR PENDAFTARAN PEMINJAMAN AULA BSC</p></u>
        <br><br>
        <table style="width: 100%;">
            <tr>
                <td width="25%">ID Pendaftaran</td>
                <td width="2%">:</td>
                <td width="73%"><?php echo '<b>' . $dataaulabyid['Id_Pinjam_Aula'] . '</b>'; ?></td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td>:</td>
                <td><?php echo 'Susunan Acara'; ?></td>
            </tr>
            <tr>
                <td>Hal</td>
                <td>:</td>
                <td><?php echo 'Peminjaman AULA BSC'; ?></td>
            </tr>
            <tr>
                <td>Nama Penanggungjawab</td>
                <td>:</td>
                <td><?php echo $dataaulabyid['Nama_Pengguna']; ?></td>
            </tr>
            <tr>
                <td>Nama Kegiatan</td>
                <td>:</td>
                <td><?php echo $dataaulabyid['Nama_Kegiatan']; ?></td>
            </tr>
            <tr>
                <td>Ketua Organisasi</td>
                <td>:</td>
                <td><?php echo $dataaulabyid['Ketua_Organisasi']; ?></td>
            </tr>
            <tr>
                <td>Peserta</td>
                <td>:</td>
                <td><?php echo $dataaulabyid['Peserta']; ?></td>
            </tr>
            <tr>
                <td>Jumlah Peserta</td>
                <td>:</td>
                <td><?php echo $dataaulabyid['Jml_Peserta']; ?></td>
            </tr>
            <tr>
                <td>Tanggal Pendaftaran</td>
                <td>:</td>
                <td><?php echo $dataaulabyid['Tanggal_Daftar']; ?></td>
            </tr>
            <tr>
                <td>Tanggal Pinjam</td>
                <td>:</td>
                <td><?php echo $dataaulabyid['Tanggal_Pinjam']; ?></td>
            </tr>
            <tr>
                <td>Waktu Pinjam</td>
                <td>:</td>
                <td><?php echo $dataaulabyid['Waktu_Pinjam']; ?></td>
            </tr>
            <tr>
                <td>Tanggal Selesai</td>
                <td>:</td>
                <td><?php echo $dataaulabyid['Tanggal_Selesai']; ?></td>
            </tr>
            <tr>
                <td>Waktu Selesai</td>
                <td>:</td>
                <td><?php echo $dataaulabyid['Waktu_Selesai']; ?></td>
            </tr>
            <tr>
                <td>Status Peminjaman</td>
                <td>:</td>
                <td><?php echo $dataaulabyid['Status_Penggunaan']; ?></td>
            </tr>
        </table>
        <br>
        <p style="text-align: center;">MENYATAKAN</p>
        <p> Akan menjaga dan menaati segala ketentuan dalam tata tertib Peminjaman AULA Bussiness Student 
            Center STMIK AMIKOM YOGYAKARTA. Dan Apabila saya melanggar, saya siap dikenakan sanksi dan 
            bertanggungjawab atas pelanggaran yang saya lakukan sebagaimana tertera dalam aturan tersebut diatas</p>

        <div style="min-height: 350px"></div>
        <table>
            <tr>
                <td width="25%"><p style="text-align: center;">Penanggungjawab Kegiatan</p></td>
                <td width="50%"></td>
                <td width="25%"><p style="text-align: center;">Ketua Organisasi</p></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td width="25%"><p style="text-align: center;"><?php echo '....................'; ?></p></td>
                <td width="50%"></td>
                <td width="25%"><p style="text-align: center;"><?php echo $dataaulabyid['Ketua_Organisasi']; ?></p></td>
            </tr>
            <tr>
                <td width="25%"></td>
                <td width="50%"><p style="text-align: center;"><?php echo 'Menyetujui,'; ?></p></td>
                <td width="25%"></td>
            </tr>
            <tr>
                <td width="25%"></td>
                <td width="50%"><p style="text-align: center;"><?php echo 'Kepala Bagian Kemahasiswaan'; ?></p></td>
                <td width="25%"></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td width="25%"></td>
                <td width="50%"><p style="text-align: center;"><?php echo 'Suyatmi, SE, MM'; ?></p></td>
                <td width="25%"></td>
            </tr>
            <tr>
                <td width="25%"></td>
                <td width="50%"><p style="text-align: center;"><?php echo 'NIK. 190.302.019'; ?></p></td>
                <td width="25%"></td>
            </tr>
        </table>    
        <?php
        $konten = ob_get_contents();
        ob_end_clean();
        $this->pdf->writeHTML($konten, true, false, true, false, '');
        $this->pdf->AddPage('P', 'A4');
        $this->pdf->Output('Peminjaman Aula BSC_.pdf', 'I');
    }

}