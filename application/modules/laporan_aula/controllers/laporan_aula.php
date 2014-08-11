<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class laporan_aula extends operator_base {
 var $batas = 15;
    public function __construct() {
        parent::__construct();
        //load model
        $this->load->model('m_laporan_aula');
    }

    public function index($offset = 0) {
        //control hak akses read
        $this->_set_page_role('r');
        //load model
        $this->load->model('m_laporan_aula');
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
        $pencarian_laporan_aula = $this->session->userdata('cari_laporan_aula');
        //get tahun asuransi
        $data['tahun'] = $this->m_laporan_aula->get_tahun_aula();
        $data['bulan_skr'] = $pencarian_laporan_aula['bulan'] != '' ? $pencarian_laporan_aula['bulan'] : date('m');
        $data['tahun_skr'] = $pencarian_laporan_aula['tahun'] != '' ? $pencarian_laporan_aula['tahun'] : date('Y');
        $parameter = array($data['bulan_skr'], $data['tahun_skr'],  intval($offset),  $this->batas);
        $this->m_laporan_aula->ambil_laporan_aula($parameter);
        //get total pembelian bulan sebelumnya
        $data['result_total'] = $this->m_laporan_aula->get_total_aula($parameter);
        $data['total_aula'] = $this->m_laporan_aula->get_total_aula_last_month($parameter);
        $data['total_aula_ini'] = $this->m_laporan_aula->get_total_aula_this_month($parameter);
        $data['total_aula_terverifikasi'] = $this->m_laporan_aula->get_total_aula_verifikasi($parameter);
        $data['total_aula_waiting'] = $this->m_laporan_aula->get_total_aula_waiting($parameter);
        parent::display('tampil_laporan_aula', $data);
    }

    function cari_data() {
        if ($this->input->post() == '')
            redirect('laporan_aula');
        if ($this->input->post('cari') == 'reset') {
            $this->session->unset_userdata('cari_laporan_aula');
        } else {
            $parameter = array(
                'bulan' => $this->input->post('bulan'),
                'tahun' => $this->input->post('tahun')
            );
            $this->session->set_userdata('cari_laporan_aula', $parameter);
        }
        redirect('laporan_aula');
    }

    function download() {
        $this->_set_page_role('r');
        //load library
        $this->load->library('excel');
        // begin 
        // create excel
        //load template excel
        $filepath = "document/template_laporan_aula.xlsx";
        // ---
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $this->phpexcel = $objReader->load($filepath);
        // set active sheet 1
        $objWorksheet = $this->phpexcel->setActiveSheetIndex(0);
        //load model
        $this->load->model('m_laporan_aula');
        $pencarian_laporan_aula = $this->session->userdata('cari_laporan_aula');
        //get tahun beasiswa
        $data['tahun'] = $this->m_laporan_aula->get_tahun_aula();
        $data['bulan_skr'] = $pencarian_laporan_aula['bulan'] != '' ? $pencarian_laporan_aula['bulan'] : date('m');
        $data['tahun_skr'] = $pencarian_laporan_aula['tahun'] != '' ? $pencarian_laporan_aula['tahun'] : date('Y');
        $parameter = array($data['bulan_skr'], $data['tahun_skr'], 0, 10000);
        $rs_aula = $this->m_laporan_aula->ambil_laporan_aula($parameter);
        $sheet_name = 'Laporan Peminjaman Aula';
        $objWorksheet->setTitle($sheet_name);
        if (!empty($rs_aula)) {
            $no = 1;
            $row = 9;
            $jumlah = 0;
            foreach ($rs_aula as $dt_aula) {
                $objWorksheet->setCellValue('A' . $row, $no);
                $objWorksheet->setCellValue('B' . $row, $dt_aula['Nama_Pengguna']);
                $objWorksheet->setCellValue('C' . $row, $dt_aula['Nama_Kegiatan']);
                $objWorksheet->setCellValue('D' . $row, $dt_aula['Ketua_Organisasi']);
                $objWorksheet->setCellValue('E' . $row, $dt_aula['Peserta']);
                $objWorksheet->setCellValue('F' . $row, $dt_aula['Jml_Peserta']);
                $objWorksheet->setCellValue('G' . $row, $dt_aula['Tanggal_Daftar']);
                $objWorksheet->setCellValue('H' . $row, $dt_aula['Tanggal_Pinjam']);
                $objWorksheet->setCellValue('I' . $row, $dt_aula['Waktu_Pinjam']);
                $objWorksheet->setCellValue('J' . $row, $dt_aula['Tanggal_Selesai']);
                $objWorksheet->setCellValue('K' . $row, $dt_aula['Waktu_Selesai']);
                $objWorksheet->setCellValue('L' . $row, $dt_aula['Status_Penggunaan']);
                // insert
                if (($row - 2) != count($rs_aula)) {
                    $objWorksheet->insertNewRowBefore(($row + 1), 1);
                    // next row
                    $row++;
                    $no++;
                }
            }
        }
        // output file
        $file_name = 'laporan_aula_' . $data['bulan_skr'] . '_' . $data['tahun_skr'];
        //--
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $file_name . '.xlsx');
        header('Cache-Control: max-age=0');
        // output
        $obj_writer = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
        $obj_writer->save('php://output');
    }

    function cetak() {
        $this->load->model('m_laporan_aula');
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
        $pencarian_laporan_aula = $this->session->userdata('cari_laporan_aula');
        //get tahun beasiswa
        $data['tahun'] = $this->m_laporan_aula->get_tahun_aula();
        $data['bulan_skr'] = $pencarian_laporan_aula['bulan'] != '' ? $pencarian_laporan_aula['bulan'] : date('m');
        $data['tahun_skr'] = $pencarian_laporan_aula['tahun'] != '' ? $pencarian_laporan_aula['tahun'] : date('Y');
        $parameter = array($data['bulan_skr'], $data['tahun_skr'], 0, 10000);
        $dataaulabytanggal = $this->m_laporan_aula->ambil_laporan_aula($parameter);
        
        $this->load->library('pdf');
        $this->pdf->SetCreator(PDF_CREATOR);
        $this->pdf->SetAuthor('SEMPAK');
        $this->pdf->SetTitle('Laporan Peminjaman AULA BSC');
        $this->pdf->SetSubject('Laporan Peminjaman AULA BSC');
        $this->pdf->SetKeywords('Laporan Peminjaman AULA BSC');
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
        <u><p style="text-align: center;">LAPORAN PEMINJAMAN AULA BSC</p></u>
        <br><br>
        <table style="width: 100%;">
            <thead>
                <tr>
                    <td width="5%" align="center"><b>NO</b></td>
                    <td width="20%" align="center"><b>PEMINJAM</b></td>
                    <td width="30%" align="center"><b>KEGIATAN</b></td>
                    <td width="13%" align="center"><b>TGL PINJAM</b></td>
                    <td width="12%" align="center"><b>WKT PINJAM</b></td>
                    <td width="13%" align="center"><b>TGL SELESAI</b></td>
                    <td width="13%" align="center"><b>WKT SELESAI</b></td>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($dataaulabytanggal)) {
                    $a = isset($awal) ? $awal : 0;
                    foreach ($dataaulabytanggal as $dt_peminjaman_aula):
                        ?>
                        <tr>
                            <td width="5%" align="center"><?php echo++$a ?></td>
                            <td width="20%" ><?php echo $dt_peminjaman_aula['Nama_Pengguna']; ?></td>
                            <td width="30%"><?php echo $dt_peminjaman_aula['Nama_Kegiatan']; ?></td>
                            <td width="13%" align="center"><?php echo $dt_peminjaman_aula['Tanggal_Pinjam']; ?></td>
                            <td width="12%" align="center"><?php echo $dt_peminjaman_aula['Waktu_Pinjam']; ?></td>
                            <td width="13%" align="center"><?php echo $dt_peminjaman_aula['Tanggal_Selesai']; ?></td>
                            <td width="13%" align="center"><?php echo $dt_peminjaman_aula['Waktu_Selesai']; ?></td>                                       
                        </tr>
                        <?php
                    endforeach;
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
            $this->pdf->Output('Peminjaman Aula BSC_.pdf' , 'I');
        }
    }
}