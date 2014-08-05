<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class pendaftaran_rujukan_asuransi extends operator_base {

    var $batas = 15;

    public function index() {
        //control hak akses read
        $this->_set_page_role('r');
        //load model
        $this->load->model('m_pendaftaran_rujukan_asuransi');
        //load library
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');
        $this->load->library('Form_validation');
        parent::display('tambah_pendaftaran_rujukan_asuransi');
    }

    function tambah_pendaftaran_rujukan_asuransi() {
        //control hak akses create
        $this->_set_page_role('c');
        $this->load->library('Form_validation');
        //load javascript + css untuk tanggal 
        $this->load_css('assets/css/form-helper/bootstrap-formhelpers.min.css');
        $this->load_js('assets/js/plugins/form-helper/bootstrap-formhelpers.min.js');

        parent::display('tambah_pendaftaran_rujukan_asuransi');
    }

    function proses_tambah_pendaftaran_rujukan_asuransi() {
        //validasi tombol simpan, jika tidak ditekan maka redirect ke tampilan tambah informasi
        if ($this->input->post('simpan') == null)
            redirect('pendaftaran_rujukan_asuransi/tambah_pendaftaran_rujukan_asuransi');
        //load form validation
        $this->load->library('Form_validation');
        //set aturan validasi
        $this->form_validation->set_rules('jenis_asuransi', 'Jenis Asuransi', 'required|trim');
        // $this->form_validation->set_rules('nama_perujuk', 'Nama Perujuk', 'required|trim');
        $this->form_validation->set_rules('nama_rs', 'Nama Rumah Sakit', 'required|trim');
        $this->form_validation->set_rules('alamat_rs', 'Alamat Rumah Sakit', 'required|trim');
        $this->form_validation->set_rules('kronologi', 'Kronologi', 'required|trim');
        $this->form_validation->set_rules('tanggal_daftar', 'Tanggal Daftar', 'required|trim');
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required|trim');
        $this->form_validation->set_rules('tanggal_keluar', 'Tanggal Keluar', 'required|trim');
        $this->form_validation->set_rules('total_biaya', 'Total Biaya', 'required|trim');
        //$this->form_validation->set_rules('santunan', 'Santunan', 'required|trim');
        //$this->form_validation->set_rules('status_asuransi', 'Status Asuransi', 'required|trim');            
        //menjalankan validasi
        if ($this->form_validation->run() === FALSE) {
            //jika validasi ada yang eror, kirim notifikasi ke view
            $this->notification('error', validation_errors());
            $this->form_validation->keep_data();
            //redirect ke tampilan tambah data informasi
            redirect('pendaftaran_rujukan_asuransi/tambah_pendaftaran_rujukan_asuransi');
        } else {
            //load model
            $this->load->model('m_pendaftaran_rujukan_asuransi');
            //set parameter array
            $parameter = array(
                $this->input->post('jenis_asuransi'),
                $this->sesi->get_data_login('ID_PENGGUNA'),
                $this->input->post('nama_rs'),
                $this->input->post('alamat_rs'),
                $this->input->post('kronologi'),
                $this->input->post('tanggal_daftar'),
                $this->input->post('tanggal_masuk'),
                $this->input->post('tanggal_keluar'),
                $this->input->post('total_biaya'),
                $this->input->post('santunan'),
                $this->input->post('status_asuransi')
            );
            if ($this->m_pendaftaran_rujukan_asuransi->tambah_pendaftaran_rujukan_asuransi($parameter)) {
                $id = $this->m_pendaftaran_rujukan_asuransi->get_last_id();
                //jika sukses kirim pesan ke view
//                $this->notification('success', 'Rujukan Asuransi berhasil ditambahkan');
                redirect('pendaftaran_rujukan_asuransi/cetak_pendaftaran_asuransi_by_id/' . $id);
//                $this->cetak_pendaftaran_asuransi_by_id($asuransi);
            } else {
                //jika gagal kirim pesan ke view
                $this->notification('error', 'Rujukan Asuransi gagal ditambahkan');
            }
        }
        //redirect ke list informasi
        redirect('pendaftaran_rujukan_asuransi');
    }

    function cetak_pendaftaran_asuransi_by_id($asuransi = '') {
        $this->load->model('m_pendaftaran_rujukan_asuransi');
//        $parameter['result_pendaftaran_asuransi'] = $this->m_pendaftaran_rujukan_asuransi->get_pendaftaran_rujukan_asuransi_by_id($asuransi);
//        $dt_asuransiid = $this->m_pendaftaran_rujukan_asuransi->hasil_pendaftaran_rujukan_asuransi($parameter);
        $dt_asuransiid = $this->m_pendaftaran_rujukan_asuransi->hasil_pendaftaran_rujukan_asuransi($asuransi);

        $this->load->library('pdf');
        $this->pdf->SetCreator(PDF_CREATOR);
        $this->pdf->SetAuthor('SEMPAK');
        $this->pdf->SetTitle('Lembar Pendafataran Rujukan Asuransi');
        $this->pdf->SetSubject('Lembar Pendafataran Rujukan Asuransi');
        $this->pdf->SetKeywords('Lembar Pendafataran Rujukan Asuransi');
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
        <u><p style="text-align: center;">LEMBAR PENDAFTARAN RUJUKAN ASURANSI</p></u>
        <br><br>
        <table style="width: 100%;">
            <tr>
                <td width="25%">ID Pendaftaran</td>
                <td width="2%">:</td>
                <td width="73%"><?php echo '<b>' . $dt_asuransiid['Id_Asuransi'] . '</b>'; ?></td>
            </tr>
            <tr>
                <td>Nama Perujuk Asuransi</td>
                <td>:</td>
                <td><?php echo $dt_asuransiid['Nama_Pengguna']; ?></td>
            </tr>
            <tr>
                <td>Jenis Rujukan Asuransi</td>
                <td>:</td>
                <td><?php echo $dt_asuransiid['Jenis_Asuransi']; ?></td>
            </tr>
            <tr>
                <td>Nama Rumah Sakit</td>
                <td>:</td>
                <td><?php echo $dt_asuransiid['Nama_RS']; ?></td>
            </tr>
            <tr>
                <td>Alamat Rumah Sakit</td>
                <td>:</td>
                <td><?php echo $dt_asuransiid['Alamat_RS']; ?></td>
            </tr>
            <tr>
                <td>Kronologi Kejadian</td>
                <td>:</td>
                <td><?php echo $dt_asuransiid['Kronologi']; ?></td>
            </tr>
            <tr>
                <td>Tanggal Masuk</td>
                <td>:</td>
                <td><?php echo $dt_asuransiid['Tanggal_Masuk']; ?></td>
            </tr>
            <tr>
                <td>Tanggal Keluar</td>
                <td>:</td>
                <td><?php echo $dt_asuransiid['Tanggal_Keluar']; ?></td>
            </tr>
            <tr>
                <td>Total Biaya</td>
                <td>:</td>
                <td><?php echo $dt_asuransiid['Total_Biaya']; ?></td>
            </tr>
            <tr>
                <td>Santunan</td>
                <td>:</td>
                <td><?php echo $dt_asuransiid['Santunan']; ?></td>
            </tr>
            <tr>
                <td>Status Rujukan Asuransi</td>
                <td>:</td>
                <td><?php echo $dt_asuransiid['Status_Asuransi']; ?></td>
            </tr>
        </table>

        <br>
        <p style="text-align: center;">MENYATAKAN</p>
        <p>Dengan ini mengajukan permohonan santunan asuransi terhadap yang tertera diatas. Berikut telah dilampirkan
            beberapa persyaratan yang harus saya penuhi.
        </p>

        <div style="min-height: 350px"></div>
        <table>
            <tr>
                <td width="25%"><p style="text-align: center;">Orang Tua/ Wali</p></td>
                <td width="50%"></td>
                <td width="25%"><p style="text-align: center;">Nama Mahasiswa</p></td>
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
                <td width="25%"><p style="text-align: center;"><?php echo $dt_asuransiid['Nama_Pengguna']; ?></p></td>
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
        $this->pdf->Output('Rujukan Asuransi_.pdf', 'I');
    }

}