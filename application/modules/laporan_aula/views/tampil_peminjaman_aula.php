<section class="content-header">
    <h1>
        Peminjaman Aula
        <small>Data Peminjaman Aula</small>
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
                        <div class="col-xs-2"><a href="<?php echo base_url('peminjaman_aula/tambah_peminjaman_aula'); ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Tambah Data</a></div>
                        <div class="col-xs-4">
                            <div class="input-group input-group-sm">
                                <input class="form-control" type="text">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-search"></i> cari !</button>
                                </span>
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
                                <td width="3%" align="center">No</td>
                                <td width="8%">Nama Peminjam</td>
                                <td width="15%">Nama Kegiatan</td>
                                <td width="10%">Ketua Organisasi</td>
                                <td width="11%">Peserta</td>
                                <td width="7%">Jml Peserta</td>
                                <td width="8%">Tgl Pinjam</td>
                                <td width="8%">Wkt Pinjam</td>
                                <td width="8%">Tgl Selesai</td>
                                <td width="8%">Wkt Selesai</td>
                                <td width="9%">Status Penggunaan</td>                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($rs_peminjaman_aula)) {
                                $a = isset($awal) ? $awal : 0;
                                foreach ($rs_peminjaman_aula as $dt_peminjaman_aula):
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo++$a ?></td>
                                        <td><?php echo $dt_peminjaman_aula['Nama_Pengguna']; ?></td>
                                        <td><?php echo $dt_peminjaman_aula['Nama_Kegiatan']; ?></td>
                                        <td><?php echo $dt_peminjaman_aula['Ketua_Organisasi']; ?></td>
                                        <td><?php echo $dt_peminjaman_aula['Peserta']; ?></td>
                                        <td><?php echo $dt_peminjaman_aula['Jml_Peserta']; ?></td>
                                        <td><?php echo $dt_peminjaman_aula['Tanggal_Pinjam']; ?></td>
                                        <td><?php echo $dt_peminjaman_aula['Waktu_Pinjam']; ?></td>
                                        <td><?php echo $dt_peminjaman_aula['Tanggal_Selesai']; ?></td>
                                        <td><?php echo $dt_peminjaman_aula['Waktu_Selesai']; ?></td>
                                        <td><?php echo $dt_peminjaman_aula['Status_Penggunaan']; ?></td>
                                        <td align="center"><a href="<?php echo base_url('peminjaman_aula/ubah_peminjaman_aula/' . $dt_peminjaman_aula['Id_Pinjam_Aula']); ?>" title="ubah data"><i class="fa fa-edit"></i></a>
                                            | <a class="tombol-hapus" href="<?php echo base_url('peminjaman_aula/hapus_peminjaman_aula/' . $dt_peminjaman_aula['Id_Pinjam_Aula']); ?>" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')" title="hapus data"><i class="fa fa-times"></i></a>
                                        </td>
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