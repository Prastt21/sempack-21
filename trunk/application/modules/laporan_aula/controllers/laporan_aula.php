<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'controllers/operator_base.php';

class laporan_aula extends operator_base {

    public function __construct() {
        parent::__construct();
        //load model
        $this->load->model('m_laporan_aula');
    }

    public function index() {
        //control hak akses read
        $this->_set_page_role('r');
        //load model
        $this->load->model('m_laporan_aula');
        $this->m_laporan_aula->ambil_laporan_aula();
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
        $parameter = array($data['bulan_skr'], $data['tahun_skr']);
        //get total pembelian bulan sebelumnya
        $data['result_total'] = $this->m_laporan_aula->get_total_aula($parameter);
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
        $this->load->model('m_laporan_aula');
        $rs_laporan_aula->$this->m_laporan_aula->ambil_laporan_aula($id);
        //load our new PHPExcel library
        $this->load->library('excel');
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('LAPORAN PEMINJAMAN AULA BSC');

        $this->excel->getActiveSheet()->setCellValue('B8', 'NO');
        $this->excel->getActiveSheet()->setCellValue('C8', 'NAMA PEMINJAM');
        $this->excel->getActiveSheet()->setCellValue('D8', 'NAMA KEGIATAN');
        $this->excel->getActiveSheet()->setCellValue('E8', 'KETUA ORGANISASI');
        $this->excel->getActiveSheet()->setCellValue('F8', 'PESERTA');
        $this->excel->getActiveSheet()->setCellValue('G8', 'JUMLAH PESERTA');
        $this->excel->getActiveSheet()->setCellValue('H8', 'TANGGAL DAFTAR');
        $this->excel->getActiveSheet()->setCellValue('I8', 'TANGGAL PINJAM');
        $this->excel->getActiveSheet()->setCellValue('J8', 'WAKTU PINJAM');
        $this->excel->getActiveSheet()->setCellValue('K8', 'TANGGAL SELESAI');
        $this->excel->getActiveSheet()->setCellValue('L8', 'WAKTU SELESAI');
        $this->excel->getActiveSheet()->setCellValue('M8', 'STATUS PEMINJAMAN');

        if (isset($rs_laporan_aula)) {
            $a = isset($awal) ? $awal : 0;
            foreach ($rs_laporan_aula as $dt_laporan_aula):
                $this->excel->getActiveSheet()->setCellValue('B' . ++$a);
                $this->excel->getActiveSheet()->setCellValue('C' . $dt_laporan_aula['Nama_Pengguna']);
                $this->excel->getActiveSheet()->setCellValue('D' . $dt_laporan_aula['Nama_Kegiatan']);
                $this->excel->getActiveSheet()->setCellValue('E' . $dt_laporan_aula['Ketua_Orma']);
                $this->excel->getActiveSheet()->setCellValue('F' . $dt_laporan_aula['Peserta']);
                $this->excel->getActiveSheet()->setCellValue('G' . $dt_laporan_aula['Jml_Peserta']);
                $this->excel->getActiveSheet()->setCellValue('H' . $dt_laporan_aula['Tanggal_Daftar']);
                $this->excel->getActiveSheet()->setCellValue('I' . $dt_laporan_aula['Tanggal_Pinjam']);
                $this->excel->getActiveSheet()->setCellValue('J' . $dt_laporan_aula['Waktu_Pinjam']);
                $this->excel->getActiveSheet()->setCellValue('K' . $dt_laporan_aula['Tanggal_Selesai']);
                $this->excel->getActiveSheet()->setCellValue('L' . $dt_laporan_aula['Waktu_Selesai']);
                $this->excel->getActiveSheet()->setCellValue('M' . $dt_laporan_aula['Status_Penggunaan']);
            endforeach;
        }

        $filename = 'Laporan Peminjaman Aula.xlsx'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }

    function cetak($id) {
        $this->load->model('m_laporan_aula');
        $dataaulabytanggal = $this->m_laporan_aula->ambil_laporan_aula($id);

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
        require_once('assets/plugin/tanggal.php');
        ?>
        <hr>        
        <u><p style="text-align: center;">LAPORAN PEMINJAMAN AULA BSC</p></u>
        <br><br>
        <table style="width: 100%;">
            <thead>
                <tr>
                    <td align="center"><b>NO</b></td>
                    <td align="center"><b>PEMINJAM</b></td>
                    <td align="center"><b>NAMA KEGIATAN</b></td>
                    <td align="center"><b>KETUA ORGANISASI</b></td>
                    <td align="center"><b>PESERTA</b></td>
                    <td align="center"><b>JML PESERTA</b></td>
                    <td align="center"><b>TANGGAL DAFTAR</b></td>
                    <td align="center"><b>TANGGAL PINJAM</b></td>
                    <td align="center"><b>WAKTU PINJAM</b></td>
                    <td align="center"><b>TANGGAL SELESAI</b></td>
                    <td align="center"><b>WAKTU SELESAI</b></td>
                    <td align="center"><b>STATUS</b></td>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($dataaulabytanggal)) {
                    $a = isset($awal) ? $awal : 0;
                    foreach ($dataaulabytanggal as $dt_peminjaman_aula):
                        ?>
                        <tr>
                            <td align="center"><?php echo++$a ?></td>
                            <td><?php echo $dt_peminjaman_aula['Nama_Pengguna']; ?></td>
                            <td><?php echo $dt_peminjaman_aula['Nama_Kegiatan']; ?></td>
                            <td><?php echo $dt_peminjaman_aula['Ketua_Organisasi']; ?></td>
                            <td><?php echo $dt_peminjaman_aula['Peserta']; ?></td>
                            <td><?php echo $dt_peminjaman_aula['Jml_Peserta']; ?></td>
                            <td><?php echo $dt_peminjaman_aula['Tanggal_Daftar']; ?></td>
                            <td><?php echo $dt_peminjaman_aula['Tanggal_Pinjam']; ?></td>
                            <td><?php echo $dt_peminjaman_aula['Waktu_Pinjam']; ?></td>
                            <td><?php echo $dt_peminjaman_aula['Tanggal_Selesai']; ?></td>
                            <td><?php echo $dt_peminjaman_aula['Waktu_Selesai']; ?></td>
                            <td><?php echo $dt_peminjaman_aula['Status_Penggunaan']; ?></td>                                        
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
            $this->pdf->Output('Peminjaman Aula BSC_' . $dataaulabytanggal->I . '.pdf', 'I');
        }
    }
}