<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class laporan_asuransi extends operator_base {
    var $batas = 15;
    public function __construct() {
        parent::__construct();
        //load model
        $this->load->model('m_laporan_asuransi');
    }

    public function index($offset = 0) {
        //control hak akses read
        $this->_set_page_role('r');
        //load model
        $this->load->model('m_laporan_asuransi');
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
        $pencarian_laporan_asuransi = $this->session->userdata('cari_laporan_asuransi');
        //get tahun asuransi
        $data['tahun'] = $this->m_laporan_asuransi->get_tahun_asuransi();
        $data['bulan_skr'] = $pencarian_laporan_asuransi['bulan'] != '' ? $pencarian_laporan_asuransi['bulan'] : date('m');
        $data['tahun_skr'] = $pencarian_laporan_asuransi['tahun'] != '' ? $pencarian_laporan_asuransi['tahun'] : date('Y');
        $parameter = array($data['bulan_skr'], $data['tahun_skr'], intval($offset), $this->batas);
        $data['rs_data'] = $this->m_laporan_asuransi->ambil_laporan_asuransi($parameter);
        //get total pembelian bulan sebelumnya
        $data['result_total'] = $this->m_laporan_asuransi->get_total_asuransi($parameter);
        $data['total_kecelakaan']= $this->m_laporan_asuransi->get_total_kecelakaan_last_month($parameter);
        $data['total_kecelakaan_ini']= $this->m_laporan_asuransi->get_total_kecelakaan_this_month($parameter);
        $data['total_sakit']= $this->m_laporan_asuransi->get_total_sakit_last_month($parameter);
        $data['total_sakit_ini']= $this->m_laporan_asuransi->get_total_sakit_this_month($parameter);
        parent::display('tampil_laporan_asuransi', $data);
    }

    function cari_data() {
        if ($this->input->post() == '')
            redirect('laporan_asuransi');
        if ($this->input->post('cari') == 'reset') {
            $this->session->unset_userdata('cari_laporan_asuransi');
        } else {
            $parameter = array(
                'bulan' => $this->input->post('bulan'),
                'tahun' => $this->input->post('tahun')
            );
            $this->session->set_userdata('cari_laporan_asuransi', $parameter);
        }
        redirect('laporan_asuransi');
    }

    function download() {
        $this->_set_page_role('r');
        //load library
        $this->load->library('excel');
        // begin 
        // create excel
        //load template excel
        $filepath = "document/template_laporan_asuransi.xlsx";
        // ---
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $this->phpexcel = $objReader->load($filepath);
        // set active sheet 1
        $objWorksheet = $this->phpexcel->setActiveSheetIndex(0);
        //load model
        $this->load->model('m_laporan_asuransi');
        $pencarian_laporan_asuransi = $this->session->userdata('cari_laporan_asuransi');
        //get tahun beasiswa
        $data['tahun'] = $this->m_laporan_asuransi->get_tahun_asuransi();
        $data['bulan_skr'] = $pencarian_laporan_asuransi['bulan'] != '' ? $pencarian_laporan_asuransi['bulan'] : date('m');
        $data['tahun_skr'] = $pencarian_laporan_asuransi['tahun'] != '' ? $pencarian_laporan_asuransi['tahun'] : date('Y');
        $parameter = array($data['bulan_skr'], $data['tahun_skr'], 0, 10000);
        $rs_asuransi = $this->m_laporan_asuransi->ambil_laporan_asuransi($parameter);
        $sheet_name = 'Laporan Rujukan Asuransi';
        $objWorksheet->setTitle($sheet_name);
        if (!empty($rs_asuransi)) {
            $no = 1;
            $row = 9;
            $jumlah = 0;
            foreach ($rs_asuransi as $dt_asuransi) {
                $objWorksheet->setCellValue('A' . $row, $no);
                $objWorksheet->setCellValue('B' . $row, $dt_asuransi['Jenis_Asuransi']);
                $objWorksheet->setCellValue('C' . $row, $dt_asuransi['Nama_Pengguna']);
                $objWorksheet->setCellValue('D' . $row, $dt_asuransi['Nama_RS']);
                $objWorksheet->setCellValue('E' . $row, $dt_asuransi['Alamat_RS']);
                $objWorksheet->setCellValue('F' . $row, $dt_asuransi['Kronologi']);
                $objWorksheet->setCellValue('G' . $row, $dt_asuransi['Tanggal_Daftar']);
                $objWorksheet->setCellValue('H' . $row, $dt_asuransi['Tanggal_Masuk']);
                $objWorksheet->setCellValue('I' . $row, $dt_asuransi['Tanggal_Keluar']);
                $objWorksheet->setCellValue('J' . $row, $dt_asuransi['Total_Biaya']);
                $objWorksheet->setCellValue('K' . $row, $dt_asuransi['Santunan']);
                $objWorksheet->setCellValue('L' . $row, $dt_asuransi['Status_Asuransi']);
                // insert
                if (($row - 2) != count($rs_asuransi)) {
                    $objWorksheet->insertNewRowBefore(($row + 1), 1);
                    // next row
                    $row++;
                    $no++;
                }
            }
        }
        // output file
        $file_name = 'laporan_asuransi_' . $data['bulan_skr'] . '_' . $data['tahun_skr'];
        //--
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $file_name . '.xlsx');
        header('Cache-Control: max-age=0');
        // output
        $obj_writer = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
        $obj_writer->save('php://output');
    }

    function cetak() {
        $this->load->model('m_laporan_asuransi');
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
        $pencarian_laporan_asuransi = $this->session->userdata('cari_laporan_asuransi');
        //get tahun beasiswa
        $data['tahun'] = $this->m_laporan_asuransi->get_tahun_asuransi();
        $data['bulan_skr'] = $pencarian_laporan_asuransi['bulan'] != '' ? $pencarian_laporan_asuransi['bulan'] : date('m');
        $data['tahun_skr'] = $pencarian_laporan_asuransi['tahun'] != '' ? $pencarian_laporan_asuransi['tahun'] : date('Y');
        $parameter = array($data['bulan_skr'], $data['tahun_skr'], 0, 10000);
        $dataasuransibytanggal = $this->m_laporan_asuransi->ambil_laporan_asuransi($parameter);

        $this->load->library('pdf');
        $this->pdf->SetCreator(PDF_CREATOR);
        $this->pdf->SetAuthor('SEMPAK');
        $this->pdf->SetTitle('Laporan Rujukan Asuransi');
        $this->pdf->SetSubject('Laporan Rujukan Asuransi');
        $this->pdf->SetKeywords('Laporan Rujukan Asuransi');
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
        <u><p style="text-align: center;">LAPORAN RUJUKAN ASURANSI</p></u>
        <br><br>
        <table class="table table-bordered table-condensed table-hover">
            <thead>
                <tr>
                    <td width="5%" align="center"><b>NO</b></td>
                    <td width="20%" align="center"><b>JENIS ASURANSI</b></td>
                    <td width="25%" align="center"><b>NAMA PERUJUK</b></td>
                    <td width="15%" align="center"><b>TANGGAL DAFTAR</b></td>
                    <td width="15%" align="center"><b>TOTAL BIAYA</b></td>
                    <td width="15%" align="center"><b>SANTUNAN</b></td>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($dataasuransibytanggal)) {
                    $a = isset($awal) ? $awal : 0;
                    foreach ($dataasuransibytanggal as $dt_rujukan_asuransi):
                        ?>
                        <tr>
                            <td width="5%" align="center"><?php echo++$a ?></td>
                            <td width="20%" align="center"><?php echo $dt_rujukan_asuransi['Jenis_Asuransi']; ?></td>
                            <td width="25%"><?php echo $dt_rujukan_asuransi['Nama_Pengguna']; ?></td>
                            <td width="15%" align="center"><?php echo $dt_rujukan_asuransi['Tanggal_Daftar']; ?></td>
                            <td width="15%" align="center"><?php echo $dt_rujukan_asuransi['Total_Biaya']; ?></td>
                            <td width="15%" align="center"><?php echo $dt_rujukan_asuransi['Santunan']; ?></td>
                        </tr>
                        <?php
                    endforeach;
                }
                ?>
            </tbody>
        </table>
        <br><br>
        
        <div style="min-height: 350px"></div>
        <table>            
            <tr>
                <td width="25%"></td>
                <td width="50%"><p style="text-align: center;"><?php echo 'Mengetahui,'; ?></p></td>
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