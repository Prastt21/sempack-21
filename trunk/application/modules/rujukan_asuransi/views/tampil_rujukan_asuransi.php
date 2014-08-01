<section class="content-header">
    <h1>
        Rujukan Asuransi
        <small>Data Rujukan Asuransi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Rujukan Asuransi</li>
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
                        <div class="col-xs-2"><a href="<?php echo base_url('rujukan_asuransi/tambah_rujukan_asuransi'); ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Tambah Data</a></div>
                        <div class="col-xs-4">
                            <div class="input-group input-group-sm">
                                <form action="<?php echo base_url('rujukan_asuransi/cari'); ?>" method="post" class="form-inline" role="form">
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
                                <td width="3%" align="center">No</td>
                                <td width="8%">Jenis Asuransi</td>
                                <td width="12%">Nama Perujuk</td>
                                <td width="11%">Rumah Sakit</td>
                                <td width="12%">Alamat Rumah Sakit</td>
                                <td width="8%">Tgl Daftar</td>
                                <td width="8%">Tgl Masuk</td>
                                <td width="8%">Tgl Keluar</td>
                                <td width="8%">Total Biaya</td>
                                <td width="8%">Santunan</td>
                                <td width="9%">Status</td>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($rs_rujukan_asuransi)) {
                                $a = isset($awal) ? $awal : 0;
                                foreach ($rs_rujukan_asuransi as $dt_rujukan_asuransi):
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo++$a ?></td>
                                        <td><?php echo $dt_rujukan_asuransi['Jenis_Asuransi']; ?></td>
                                        <td><?php echo $dt_rujukan_asuransi['Nama_Pengguna']; ?></td>
                                        <td><?php echo $dt_rujukan_asuransi['Nama_RS']; ?></td>
                                        <td><?php echo $dt_rujukan_asuransi['Alamat_RS']; ?></td>
                                        <td><?php echo $dt_rujukan_asuransi['Tanggal_Daftar']; ?></td>
                                        <td><?php echo $dt_rujukan_asuransi['Tanggal_Masuk']; ?></td>
                                        <td><?php echo $dt_rujukan_asuransi['Tanggal_Keluar']; ?></td>
                                        <td><?php echo $dt_rujukan_asuransi['Total_Biaya']; ?></td>
                                        <td><?php echo $dt_rujukan_asuransi['Santunan']; ?></td>
                                        <td><?php echo $dt_rujukan_asuransi['Status_Asuransi']; ?></td>
                                        <td align="center"><a href="<?php echo base_url('rujukan_asuransi/ubah_rujukan_asuransi/' . $dt_rujukan_asuransi['Id_Asuransi']); ?>" title="ubah data"><i class="fa fa-edit"></i></a>
                                            | <a class="tombol-hapus" href="<?php echo base_url('rujukan_asuransi/hapus_rujukan_asuransi/' . $dt_rujukan_asuransi['Id_Asuransi']); ?>" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')" title="hapus data"><i class="fa fa-times"></i></a>
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