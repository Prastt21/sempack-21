<section class="content-header">
    <h1>
        Peminjaman Aula
        <small>Jadwal Peminjaman Aula</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Peminjaman Aula</li>
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
                                <form action="<?php echo base_url('jadwal_peminjaman_aula/cari'); ?>" method="post" class="form-inline" role="form">
                                <div class="form-group">
                                    <input class="form-control input-sm" type="text" name="keyword_text" placeholder="Nama Kegiatan" value="<?php echo isset($keyword) ? $keyword : ''; ?>">
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
                                <td width="3%" align="center"><b>NO</b></td>                               
                                <td width="15%" align="center"><b>NAMA KEGIATAN</b></td>
                                <td width="10%" align="center"><b>KETUA ORGANISASI</b></td>                                
                                <td width="8%" align="center"><b>TGL PINJAM</b></td>
                                <td width="8%" align="center"><b>WKT PINJAM</b></td>
                                <td width="8%" align="center"><b>TGL SELESAI</b></td>
                                <td width="8%" align="center"><b>WKT SELESAI</b></td>
                                <td width="9%" align="center"><b>STATUS</b></td>                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($rs_jadwal_peminjaman_aula)) {
                                $a = isset($awal) ? $awal : 0;
                                foreach ($rs_jadwal_peminjaman_aula as $dt_data_peminjaman_aula):
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo++$a ?></td>
                                        <td><?php echo $dt_data_peminjaman_aula['Nama_Kegiatan']; ?></td>
                                        <td><?php echo $dt_data_peminjaman_aula['Ketua_Organisasi']; ?></td>                                        
                                        <td><?php echo $dt_data_peminjaman_aula['Tanggal_Pinjam']; ?></td>
                                        <td><?php echo $dt_data_peminjaman_aula['Waktu_Pinjam']; ?></td>
                                        <td><?php echo $dt_data_peminjaman_aula['Tanggal_Selesai']; ?></td>
                                        <td><?php echo $dt_data_peminjaman_aula['Waktu_Selesai']; ?></td>
                                        <td><?php echo $dt_data_peminjaman_aula['Status_Penggunaan']; ?></td>                                        
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