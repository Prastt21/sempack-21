<section class="content-header">
    <h1>
        Keterangan Orang Tua
        <small>Data Keterangan Orang Tua</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Keterangan Orang Tua</li>
    </ol>
    <!-- Main content -->
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="input-group input-group-sm">
                                <form action="<?php echo base_url('keterangan_orang_tua/cari'); ?>" method="post" class="form-inline" role="form">
                                <div class="form-group">
                                    <input class="form-control input-sm" type="text" name="keyword_text" value="<?php echo isset($keyword) ? $keyword : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default btn-sm" type="submit"><i class="fa fa-search"></i> cari !</button>
                                    </span>
                                </div>
                            </form>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="pull-right">
                                <?php echo isset($halaman) ? $halaman : 'Tidak ada pembagian halaman'; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="height: 10px"></div>
                    <!--load template untuk notifikasi-->
                    <?php $this->load->view('templates/notification'); ?>
                    <table class="table table-bordered table-condensed table-hover">
                        <thead>
                            <tr>
                                <td width="5%" align="center"><b>NO</b></td>
                                <td width="15%" align="center"><b>MAHASISWA</b></td>
                                <td width="15%" align="center"><b>ORANG TUA</b></td>                                
                                <td width="15%" align="center"><b>ALAMAT</b></td>
                                <td width="10%" align="center"><b>NO TELP</b></td>
                                <td width="15%" align="center"><b>PEKERJAAN</b></td>
                                <td width="15%" align="center"><b>PENGHASILAN</b></td>
                                <td width="10%" align="center"><b>JML TANGGUNGAN</b></td>                                                              
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($rs_keterangan_orang_tua)) {
                                $a = isset($awal) ? $awal : 0;
                                foreach ($rs_keterangan_orang_tua as $dt_keterangan_orang_tua):
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo++$a ?></td>
                                        <td><?php echo $dt_keterangan_orang_tua['Nama_Pengguna']; ?></td>
                                        <td><?php echo $dt_keterangan_orang_tua['Nama_Ortu']; ?></td>
                                        <td><?php echo $dt_keterangan_orang_tua['Alamat_Ortu']; ?></td>
                                        <td><?php echo $dt_keterangan_orang_tua['No_Telp_Ortu']; ?></td>                                        
                                        <td><?php echo $dt_keterangan_orang_tua['Pekerjaan_Ortu']; ?></td>
                                        <td><?php echo $dt_keterangan_orang_tua['Penghasilan_Ortu']; ?></td>
                                        <td><?php echo $dt_keterangan_orang_tua['Jml_Tanggungan']; ?></td>
                                    </tr>
                                    <?php
                                endforeach;
                            }
                            if ($total_data == 0) {
                                echo '<tr><td colspan="5">Tidak ada data!</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="row" style="height: 10px"></div>
                    <div class="row">
                        <div class="col-xs-6">Menampilkan <?php echo isset($jml_data) ? $jml_data : 0; ?> dari <?php echo isset($total_data) ? $total_data : 0; ?> data </div>
                        <div class="col-xs-6">
                            <div class="pull-right">
                                <?php echo isset($halaman) ? $halaman : 'Tidak ada pembagian halaman'; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.content -->