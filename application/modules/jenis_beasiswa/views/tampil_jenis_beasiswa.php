<section class="content-header">
    <h1>
        Jenis Beasiswa
        <small>Data Jenis Beasiswa</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Jenis Beasiswa</li>
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
                        <div class="col-xs-2"><a href="<?php echo base_url('jenis_beasiswa/tambah_jenis_beasiswa'); ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Tambah Data</a></div>
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
                                <td width="5%" align="center">No</td>
                                <td width="25%">Jenis Beasiswa</td>
                                <td width="15%">Warna Beasiswa</td>
                                <td width="50%">Keterangan</td>                                                              
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($rs_jenis_beasiswa)) {
                                $a = isset($awal) ? $awal : 0;
                                foreach ($rs_jenis_beasiswa as $dt_jenis_beasiswa):
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo++$a ?></td>
                                        <td><?php echo $dt_jenis_beasiswa['Jenis_Beasiswa']; ?></td>
                                        <td><?php echo $dt_jenis_beasiswa['Warna_Beasiswa']; ?></td>
                                        <td><?php echo $dt_jenis_beasiswa['Keterangan']; ?></td>                                        
                                        <td align="center"><a href="<?php echo base_url('jenis_beasiswa/ubah_jenis_beasiswa/' . $dt_jenis_beasiswa['Id_JB']); ?>" title="ubah data"><i class="fa fa-edit"></i></a>
                                            | <a class="tombol-hapus" href="<?php echo base_url('jenis_beasiswa/hapus_jenis_beasiswa/' . $dt_jenis_beasiswa['Id_JB']); ?>" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')" title="hapus data"><i class="fa fa-times"></i></a>
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