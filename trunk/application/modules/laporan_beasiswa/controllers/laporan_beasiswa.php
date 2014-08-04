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
        $parameter = array($data['bulan_skr'], $data['tahun_skr'], intval($offset), $this->batas);
        $data['rs_data'] = $this->m_laporan_beasiswa->ambil_laporan_beasiswa($parameter);
        echo '<pre>';
        print_r($data['rs_data']);
        exit();
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
        $this->_set_page_role('r');
        //load library
        $this->load->library('excel');
        // begin 
        // create excel
        //load template excel
        $filepath = "document/template_laporan_beasiswa.xlsx";
        // ---
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $this->phpexcel = $objReader->load($filepath);
        // set active sheet 1
        $objWorksheet = $this->phpexcel->setActiveSheetIndex(0);
        //load model
        $this->load->model('m_laporan_beasiswa');
        $pencarian_laporan_beasiswa = $this->session->userdata('cari_laporan_beasiswa');
        //get tahun beasiswa
        $data['tahun'] = $this->m_laporan_beasiswa->get_tahun_beasiswa();
        $data['bulan_skr'] = $pencarian_laporan_beasiswa['bulan'] != '' ? $pencarian_laporan_beasiswa['bulan'] : date('m');
        $data['tahun_skr'] = $pencarian_laporan_beasiswa['tahun'] != '' ? $pencarian_laporan_beasiswa['tahun'] : date('Y');
        $parameter = array($data['bulan_skr'], $data['tahun_skr'], 0, 10000);
        $rs_beasiswa = $this->m_laporan_beasiswa->ambil_laporan_beasiswa($parameter);
        $sheet_name = 'Laporan Beasiswa';
        $objWorksheet->setTitle($sheet_name);
        if (!empty($rs_beasiswa)) {
            $no = 1;
            $row = 3;
            $jumlah = 0;
            foreach ($rs_beasiswa as $dt_beasiswa) {
                $objWorksheet->setCellValue('A' . $row, $no);
                $objWorksheet->setCellValue('B' . $row, $dt_beasiswa['Jenis_Beasiswa']);
                $objWorksheet->setCellValue('C' . $row, $dt_beasiswa['Nama_Pengguna']);
                $objWorksheet->setCellValue('D' . $row, $dt_beasiswa['Nama_Jurusan']);
                $objWorksheet->setCellValue('E' . $row, $dt_beasiswa['Jenjang']);
                $objWorksheet->setCellValue('F' . $row, $dt_beasiswa['Alamat_Sekarang']);
                $objWorksheet->setCellValue('G' . $row, $dt_beasiswa['Nama_PT']);
                $objWorksheet->setCellValue('H' . $row, $dt_beasiswa['Semester']);
                $objWorksheet->setCellValue('I' . $row, $dt_beasiswa['IPK']);
                $objWorksheet->setCellValue('J' . $row, $dt_beasiswa['Prestasi']);
                $objWorksheet->setCellValue('K' . $row, $dt_beasiswa['Alasan']);
                $objWorksheet->setCellValue('L' . $row, $dt_beasiswa['BANK']);
                $objWorksheet->setCellValue('M' . $row, $dt_beasiswa['No_Rekening']);
                $objWorksheet->setCellValue('N' . $row, $dt_beasiswa['Tanggal_Daftar']);
                $objWorksheet->setCellValue('O' . $row, $dt_beasiswa['Status_Beasiswa']);
                // insert
                if (($row - 2) != count($rs_beasiswa)) {
                    $objWorksheet->insertNewRowBefore(($row + 1), 1);
                    // next row
                    $row++;
                    $no++;
                }
            }
        }
        // output file
        $file_name = 'laporan_beasiswa_' . $data['bulan_skr'] . '_' . $data['tahun_skr'];
        //--
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $file_name . '.xlsx');
        header('Cache-Control: max-age=0');
        // output
        $obj_writer = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
        $obj_writer->save('php://output');
    }

    function cetak() {
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
        $parameter = array($data['bulan_skr'], $data['tahun_skr'], 0, 10000);
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

        // add a page lanskap
        $this->pdf->AddPage('L', 'A4');
        ob_start();
        ?>
        <hr>        
        <u><p style="text-align: center;">LAPORAN DATA PENDAFTARAN BEASISWA</p></u>
        <br><br>

        <table style="width: 100%; font-size: 10px;">                
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
                <td width="25%"><p style="text-align: center;">Yogyakarta,</p></td>
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
        $this->pdf->Output('Pendaftaran Beasiswa_.pdf', 'I');
    }

}