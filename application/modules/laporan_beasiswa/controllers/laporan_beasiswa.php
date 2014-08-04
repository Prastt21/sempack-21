<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class laporan_beasiswa extends operator_base {
    
    var $batas = 15;

    public function __construct() {
        parent::__construct();
        //load model
        $this->load->model('m_laporan_beasiswa');
    }    
    public function index($offset = 0) {
        //control hak akses read
        $this->_set_page_role('r');
        //load model
        $this->load->model('m_laporan_beasiswa');
        //set data bulan
        $data['bulan'] = array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        );
        $pencarian_laporan_beasiswa = $this->session->userdata('cari_laporan_beasiswa');
        //get tahun beasiswa
        $data['tahun'] = $this->m_laporan_beasiswa->get_tahun_beasiswa();
        $data['bulan_skr'] = $pencarian_laporan_beasiswa['bulan'] != '' ? $pencarian_laporan_beasiswa['bulan'] : date('m');
        $data['tahun_skr'] = $pencarian_laporan_beasiswa['tahun'] != '' ? $pencarian_laporan_beasiswa['tahun'] : date('Y');
        $parameter = array($data['bulan_skr'], $data['tahun_skr'],  intval($offset),  $this->batas);
        $this->m_laporan_beasiswa->ambil_laporan_beasiswa($parameter);
        //get total pembelian bulan sebelumnya
        $data['result_total'] = $this->m_laporan_beasiswa->get_total_beasiswa($parameter);
        parent::display('tampil_laporan_beasiswa', $data);
    }

    function cari_data() {
        if ($this->input->post() == '')
            redirect('laporan_beasiswa');
        if ($this->input->post('cari') == 'reset') {
            $this->session->unset_userdata('cari_laporan_beasiswa');
        } else {
            $parameter = array(
                'bulan' => $this->input->post('bulan'),
                'tahun' => $this->input->post('tahun')
            );
            $this->session->set_userdata('cari_laporan_beasiswa', $parameter);
        }
        redirect('laporan_beasiswa');
    }

    function download() {
        $this->load->model('m_laporan_beasiswa');
        $rs_laporan_beasiswa->$this->m_laporan_beasiswa->ambil_laporan_beasiswa($id);
        //load our new PHPExcel library
        $this->load->library('excel');
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('LAPORAN PENDAFTARAN BEASISWA');

        $this->excel->getActiveSheet()->setCellValue('B8', 'NO');
        $this->excel->getActiveSheet()->setCellValue('C8', 'JENIS BEASISWA');
        $this->excel->getActiveSheet()->setCellValue('D8', 'NAMA PENDAFTAR');
        $this->excel->getActiveSheet()->setCellValue('E8', 'JURUSAN');
        $this->excel->getActiveSheet()->setCellValue('F8', 'JENJANG');
        $this->excel->getActiveSheet()->setCellValue('G8', 'ALAMAT SEKARANG');
        $this->excel->getActiveSheet()->setCellValue('H8', 'PERGURUAN TINGGI');
        $this->excel->getActiveSheet()->setCellValue('I8', 'SEMESTER');
        $this->excel->getActiveSheet()->setCellValue('J8', 'IPK');
        $this->excel->getActiveSheet()->setCellValue('K8', 'PRESTASI');
        $this->excel->getActiveSheet()->setCellValue('L8', 'ALASAN');
        $this->excel->getActiveSheet()->setCellValue('M8', 'NAMA BANK');
        $this->excel->getActiveSheet()->setCellValue('N8', 'NO REKENING');
        $this->excel->getActiveSheet()->setCellValue('O8', 'TANGGAL DAFTAR');
        $this->excel->getActiveSheet()->setCellValue('P8', 'STATUS BEASISWA');

        if (isset($rs_laporan_beasiswa)) {
            $a = isset($awal) ? $awal : 0;
            foreach ($rs_laporan_beasiswa as $dt_laporan_beassiswa):
                $this->excel->getActiveSheet()->setCellValue('B' . ++$a);
                $this->excel->getActiveSheet()->setCellValue('C' . $dt_laporan_beassiswa['Jenis_Beasiswa']);
                $this->excel->getActiveSheet()->setCellValue('D' . $dt_laporan_beassiswa['Nama_Pengguna']);
                $this->excel->getActiveSheet()->setCellValue('E' . $dt_laporan_beassiswa['Jurusan']);
                $this->excel->getActiveSheet()->setCellValue('F' . $dt_laporan_beassiswa['Jenjang']);
                $this->excel->getActiveSheet()->setCellValue('G' . $dt_laporan_beassiswa['Alamat_Sekarang']);
                $this->excel->getActiveSheet()->setCellValue('H' . $dt_laporan_beassiswa['Perguruan Tinggi']);
                $this->excel->getActiveSheet()->setCellValue('I' . $dt_laporan_beassiswa['Semester']);
                $this->excel->getActiveSheet()->setCellValue('J' . $dt_laporan_beassiswa['IPK']);
                $this->excel->getActiveSheet()->setCellValue('K' . $dt_laporan_beassiswa['Prestasi']);
                $this->excel->getActiveSheet()->setCellValue('L' . $dt_laporan_beassiswa['Alasan']);
                $this->excel->getActiveSheet()->setCellValue('M' . $dt_laporan_beassiswa['BANK']);
                $this->excel->getActiveSheet()->setCellValue('N' . $dt_laporan_beassiswa['No_Rekening']);
                $this->excel->getActiveSheet()->setCellValue('O' . $dt_laporan_beassiswa['Tanggal_Daftar']);
                $this->excel->getActiveSheet()->setCellValue('P' . $dt_laporan_beassiswa['Status_Beasiswa']);
            endforeach;
        }

        $filename = 'Laporan Beasiswa.xlsx'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }

    function cetak($offset=0) {
        $this->load->model('m_laporan_beasiswa');
         //set data bulan
        $data['bulan'] = array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        );
        $pencarian_laporan_beasiswa = $this->session->userdata('cari_laporan_beasiswa');
        //get tahun beasiswa
        $data['tahun'] = $this->m_laporan_beasiswa->get_tahun_beasiswa();
        $data['bulan_skr'] = $pencarian_laporan_beasiswa['bulan'] != '' ? $pencarian_laporan_beasiswa['bulan'] : date('m');
        $data['tahun_skr'] = $pencarian_laporan_beasiswa['tahun'] != '' ? $pencarian_laporan_beasiswa['tahun'] : date('Y');
        $parameter = array($data['bulan_skr'], $data['tahun_skr'],  intval($offset),  $this->batas);
        $databeasiswabytanggal = $this->m_laporan_beasiswa->ambil_laporan_beasiswa($parameter);
        
        $this->load->library('pdf');
        $this->pdf->SetCreator(PDF_CREATOR);
        $this->pdf->SetAuthor('SEMPAK');
        $this->pdf->SetTitle('Laporan Data Pendafataran Beasiswa');
        $this->pdf->SetSubject('Lembar Data Pendafataran Beasiswa');
        $this->pdf->SetKeywords('Lembar Data Pendafataran Beasiswa');
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
        require_once('assets/plugin/tanggal.php');
        ?>
                <hr>        
                <u><p style="text-align: center;">LAPORAN DATA PENDAFTARAN BEASISWA <?php echo $databeasiswabytanggal->Jenis_Beasiswa; ?></p></u>
                <br><br>

                <table style="width: 100%;" class="table table-bordered table-condensed table-hover">                
                        <thead>
                            <tr>
                                <td align="center"><b>NO</b></td>
                                <td align="center"><b>JENIS BEASISWA</b></td>
                                <td align="center"><b>NAMA PENDAFTAR</b></td>                                
                                <td align="center"><b>JURUSAN</b></td>
                                <td align="center"><b>JENJANG</b></td>
                                <td align="center"><b>ALAMAT SEKARANG</b></td>
                                <td align="center"><b>PERGURUAN TINGGI</b></td>
                                <td align="center"><b>SEMESTER</b></td>
                                <td align="center"><b>IPK</b></td>
                                <td align="center"><b>PRESTASI</b></td>
                                <td align="center"><b>ALASAN</b></td>
                                <td align="center"><b>NAMA BANK</b></td>
                                <td align="center"><b>NO REKENING</b></td>
                                <td align="center"><b>TANGGAL DAFTAR</b></td>
                                <td align="center"><b>STATUS </b></td> 
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($databeasiswabytanggal)) {
                                $a = isset($awal) ? $awal : 0;
                                foreach ($databeasiswabytanggal as $dt_beasiswa):
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo++$a ?></td>
                                        <td><?php echo $dt_beasiswa['Jenis_Beasiswa']; ?></td>
                                        <td><?php echo $dt_beasiswa['Nama_Pengguna']; ?></td>                                        
                                        <td><?php echo $dt_beasiswa['Nama_Jurusan']; ?></td>
                                        <td><?php echo $dt_beasiswa['Jenjang']; ?></td>
                                        <td><?php echo $dt_beasiswa['Alamat_Sekarang']; ?></td>
                                        <td><?php echo $dt_beasiswa['Nama_PT']; ?></td>
                                        <td><?php echo $dt_beasiswa['Semester']; ?></td>
                                        <td><?php echo $dt_beasiswa['IPK']; ?></td>
                                        <td><?php echo $dt_beasiswa['Prestasi']; ?></td>
                                        <td><?php echo $dt_beasiswa['Alasan']; ?></td>
                                        <td><?php echo $dt_beasiswa['BANK']; ?></td>
                                        <td><?php echo $dt_beasiswa['No_Rekening']; ?></td>
                                        <td><?php echo $dt_beasiswa['Tanggal_Daftar']; ?></td>
                                        <td><?php echo $dt_beasiswa['Status_Beasiswa']; ?></td>
                                    </tr>
                                    <?php
                                endforeach;
                            }
                            ?>
                        </tbody>                   
                </table>
                <br> <br>
                <div style="min-height: 350px"></div>
                <table>
                    <tr>
                        <td width="25%"></td>
                        <td width="50%"></td>
                        <td width="25%"><p style="text-align: center;">Yogyakarta, <?php echo $databeasiswabytanggal->Tanggal_Daftar; ?></p></td>
                    </tr>
                    <tr>
                        <td width="25%"><p style="text-align: center;">Mengetahui/menyetujui,</p></td>
                        <td width="50%"></td>
                        <td width="25%"><p style="text-align: center;">Kepala Bagian Kemahasiswaan</p></td>
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
                        <td width="25%"><p style="text-align: center;"><?php echo 'Suyatmi, S.E, M.M'; ?></p></td>
                    </tr>
                    <tr>
                        <td width="25%"><p style="text-align: center;"><?php echo 'NIK. 190.302.001'; ?></p></td>
                        <td width="50%"></td>
                        <td width="25%"><p style="text-align: center;"><?php echo 'NIK. 190.302.019'; ?></p></td>
                    </tr>
                </table>    
        <?php
        $konten = ob_get_contents();
        ob_end_clean();
        $this->pdf->writeHTML($konten, true, false, true, false, '');
        $this->pdf->AddPage('P', 'A4');
        $this->pdf->Output('Pendaftaran Beasiswa_' . $databeasiswabytanggal->I . '.pdf', 'I');
    }

}