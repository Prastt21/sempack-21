<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class pendaftaran_beasiswa extends operator_base {

    var $batas = 15;

    public function __construct() {
        parent::__construct();
    }

    function index() {
        $this->_set_page_role('r');
        $this->load->model('m_pendaftaran_beasiswa');
        //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');
        //load form validation
        $this->load->library('form_validation');
        //get data jenis beasiswa
        $data['rs_jenis_beasiswa'] = $this->m_pendaftaran_beasiswa->ambil_jenis_beasiswa();
        //get data jurusan
        $data['rs_jurusan'] = $this->m_pendaftaran_beasiswa->ambil_jurusan();
        $data['result_periode_sistem'] = $this->m_pendaftaran_beasiswa->get_periode_sistem();
        parent::display('tambah_pendaftaran_beasiswa', $data);
    }

    function tambah_pendaftaran_beasiswa() {
        $this->_set_page_role('c');
        //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');
        //load form validation
        $this->load->library('form_validation');
        //load model
        $this->load->model('m_pendaftaran_beasiswa');
        parent::display('tambah_pendaftaran_beasiswa');
    }

    function proses_tambah_pendaftaran_beasiswa() {
        if ($this->input->post('simpan') == null)
            redirect('pendaftaran_beasiswa/tambah_pendaftaran_beasiswa');
        //load library form validation
        $this->load->library('form_validation');
        //set validasi form
        $this->form_validation->set_rules('jenis_beasiswa', 'Jenis Beasiswa', 'required|trim');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required|trim');
        $this->form_validation->set_rules('jenjang', 'Jenjang', 'required|trim');
        $this->form_validation->set_rules('alamat_sekarang', 'Alamat Sekarang', 'required|trim');
        $this->form_validation->set_rules('nama_pt', 'Nama Pergururan Tinggi', 'required|trim');
        $this->form_validation->set_rules('semester', 'Semester', 'required|trim');
        $this->form_validation->set_rules('ipk', 'IPK', 'required|trim');
        $this->form_validation->set_rules('prestasi', 'Prestasi', 'required|trim');
        $this->form_validation->set_rules('alasan', 'Alasan', 'required|trim');
        $this->form_validation->set_rules('bank', 'Bank', 'required|trim');
        $this->form_validation->set_rules('no_rekening', 'No Rekening', 'required|trim');
        $this->form_validation->set_rules('tanggal_daftar', 'Tanggal Daftar', 'required|trim');
        //$this->form_validation->set_rules('status_beasiswa', 'Status Beasiswa', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            //set notifikasi
            $this->notification('error', validation_errors());
            //simpan data yang sudah diisi
            $this->form_validation->keep_data();
            redirect('pendaftaran_beasiswa/tambah_pendaftaran_beasiswa');
        } else {
            $this->load->model('m_pendaftaran_beasiswa');
            $parameter = array(
                $this->input->post('jenis_beasiswa'),
                $this->sesi->get_data_login('ID_PENGGUNA'),
                $this->input->post('jurusan'),
                $this->input->post('periode'),
                $this->input->post('jenjang'),
                $this->input->post('alamat_sekarang'),
                $this->input->post('nama_pt'),
                $this->input->post('semester'),
                $this->input->post('ipk'),
                $this->input->post('prestasi'),
                $this->input->post('alasan'),
                $this->input->post('bank'),
                $this->input->post('no_rekening'),
                $this->input->post('tanggal_daftar'),
                $this->input->post('status_beasiswa')
            );
            if ($this->m_pendaftaran_beasiswa->cek_pendaftaran_beasiswa_by_id_pengguna($parameter)) {
                //set notifikasi gagal
                $this->notification('error', 'Anda Sudah Melakukan Pendaftaran Beasiswa Periode Ini');
            } else {
                //set notifikasi berhasil
                if ($this->m_pendaftaran_beasiswa->tambah_pendaftaran_beasiswa($parameter)) {
                    //set notifikasi berhasil
                    $id = $this->m_pendaftaran_beasiswa->get_last_id();
                    redirect('pendaftaran_beasiswa/cetak_pendaftaran_beasiswa_by_id/' . $id);
                } else {
                    //set notifikasi gagal
                    $this->notification('error', 'Data gagal ditambahkan');
                }
            }
            redirect('pendaftaran_beasiswa');
        }
    }

    function cetak_pendaftaran_beasiswa_by_id($beasiswa = '') {
        $this->load->model('m_pendaftaran_beasiswa');
        $databeasiswabyid = $this->m_pendaftaran_beasiswa->hasil_pendaftaran_beasiswa($beasiswa);

        $this->load->library('pdf');
        $this->pdf->SetCreator(PDF_CREATOR);
        $this->pdf->SetAuthor('SEMPAK');
        $this->pdf->SetTitle('Lembar Pendafataran Beasiswa');
        $this->pdf->SetSubject('Lembar Pendafataran Beasiswa');
        $this->pdf->SetKeywords('Lembar Pendafataran Beasiswa');
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
        <u><p style="text-align: center;">LEMBAR PENDAFTARAN BEASISWA <?php echo $databeasiswabyid['Jenis_Beasiswa']; ?></p></u>
        <br><br>

        <table style="width: 100%;">            
            <tr>
                <td width="25%">ID Pendaftaran</td>
                <td width="2%">:</td>
                <td width="73%"><?php echo '<b>' . $databeasiswabyid['Id_Beasiswa'] . '</b>'; ?></td>
            </tr>
            <tr>Kepada : </tr>
            <tr>Yth.	: Direktur Jenderal Pendidikan Tinggi</tr>
            <tr>Melalui Koordinator Kopertis Wilayah V DIY</tr>
            <tr>Jalan Tentara Pelajar 13 Yogyakarta</tr>
            <br>
            <tr>
                <td>Dengan Hormat, </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Nama Pendaftar Beasiswa</td>
                <td>:</td>
                <td><?php echo $databeasiswabyid['Nama_Pengguna']; ?></td>
            </tr>
            <tr>
                <td>Jurusan</td>
                <td>:</td>
                <td><?php echo $databeasiswabyid['Jurusan']; ?></td>
            </tr>
            <tr>
                <td>Jenjang</td>
                <td>:</td>
                <td><?php echo $databeasiswabyid['Jenjang']; ?></td>
            </tr>
            <tr>
                <td>Alamat Sekarang</td>
                <td>:</td>
                <td><?php echo $databeasiswabyid['Alamat_Sekarang']; ?></td>
            </tr>
            <tr>
                <td>Perguruan Tinggi</td>
                <td>:</td>
                <td><?php echo $databeasiswabyid['Nama_PT']; ?></td>
            </tr>
            <tr>
                <td>Semester</td>
                <td>:</td>
                <td><?php echo $databeasiswabyid['Semester']; ?></td>
            </tr>
            <tr>
                <td>Indeks Prestasi Komulatif</td>
                <td>:</td>
                <td><?php echo $databeasiswabyid['IPK']; ?></td>
            </tr>
            <tr>
                <td>Prestasi</td>
                <td>:</td>
                <td><?php echo $databeasiswabyid['Prestasi']; ?></td>
            </tr>
            <tr>
                <td>Alasan Mengajukan Beasiswa</td>
                <td>:</td>
                <td><?php echo $databeasiswabyid['Alasan']; ?></td>
            </tr>
            <tr>
                <td>Nama Bank Transfer</td>
                <td>:</td>
                <td><?php echo $databeasiswabyid['BANK']; ?></td>
            </tr>
            <tr>
                <td>No Rekening</td>
                <td>:</td>
                <td><?php echo $databeasiswabyid['No_Rekening']; ?></td>
            </tr>
            <tr>
                <td>KETERANGAN ORANG TUA / WALI</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td>Nama Orang Tua</td>
                <td>:</td>
                <td><?php echo $databeasiswabyid['Nama_Ortu']; ?></td>
            </tr>
            <tr>
                <td>Alamat Orang Tua</td>
                <td>:</td>
                <td><?php echo $databeasiswabyid['Alamat_Ortu']; ?></td>
            </tr>
            <tr>
                <td>Pekerjaan Orang Tua</td>
                <td>:</td>
                <td><?php echo $databeasiswabyid['Pekerjaan_Ortu']; ?></td>
            </tr>
            <tr>
                <td>Penghasilan Orang Tua</td>
                <td>:</td>
                <td><?php echo $databeasiswabyid['Penghasilan_Ortu']; ?></td>
            </tr>
            <tr>
                <td>Jumlah Tanggungan</td>
                <td>:</td>
                <td><?php echo $databeasiswabyid['Jml_Tanggungan']; ?></td>
            </tr>
        </table>
        <br>
        <p style="text-align: justify;">
            Sehubungan dengan hal tersebut, saya mengajukan permohonan beasiswa : <?php echo $databeasiswabyid['Jenis_Beasiswa']; ?> tahun 2014 melalui Bapak Koordinator Kopertis Wilayah V Yogyakarta<br>
            Bersama ini saya lampirkan berkas persyaratan permohonan untuk menjadikan pertimbangan dan apabila saya memalsukan data persyaratan tersebut saya bersedia menerima sanksi sesuai ketentuan yang berlaku.<br>
            Atas perhatian dan bantuan Bapak, saya ucapkan terima kasih<br>
        </p>
        <div style="min-height: 350px"></div>
        <table>
            <tr>
                <td width="25%"></td>
                <td width="50%"></td>
                <td width="25%"><p style="text-align: center;">Yogyakarta, <?php echo $databeasiswabyid['Tanggal_Daftar']; ?></p></td>
            </tr>
            <tr>
                <td width="25%"><p style="text-align: center;">Mengetahui/menyetujui,</p></td>
                <td width="50%"></td>
                <td width="25%"><p style="text-align: center;">Pemohon</p></td>
            </tr>
            <tr>
                <td width="25%"><p style="text-align: center;">Pimpinan PTS</p></td>
                <td width="50%"></td>
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
                <td width="25%"><p style="text-align: center;"><?php echo 'Prof. Dr. M. Suyanto, MM'; ?></p></td>
                <td width="50%"></td>
                <td width="25%"><p style="text-align: center;"><?php echo $databeasiswabyid['Nama_Pengguna']; ?></p></td>
            </tr>
            <tr>
                <td width="25%"><p style="text-align: center;"><?php echo 'NIK. 190.302.001'; ?></p></td>
                <td width="50%"></td>
                <td width="25%"><p style="text-align: center;"><?php echo $databeasiswabyid['NIK_NIM']; ?></p></td>
            </tr>
        </table>    
        <?php
        $konten = ob_get_contents();
        ob_end_clean();
        $this->pdf->writeHTML($konten, true, false, true, false, '');
        $this->pdf->AddPage('P', 'A4');
        $this->pdf->Output('Pendaftaran Beasiswa_.pdf', 'I');
    }

}