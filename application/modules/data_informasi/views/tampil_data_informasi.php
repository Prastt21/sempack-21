<section class="content-header">
    <h1>
        Informasi
        <small>Data Informasi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Informasi</li>
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
                        <div class="col-xs-2"><a href="<?php echo base_url('data_informasi/tambah_data_informasi'); ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Tambah Data</a></div>
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
                                <td width="30%">Judul Informasi</td>
                                <td width="15%">Jenis Informasi</td>
                                <td width="15%">Tanggal Informasi</td>
                                <td width="15%">Operator Posting</td>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($rs_informasi)) {
                                $a = isset($awal) ? $awal : 0;
                                foreach ($rs_informasi as $dt_informasi):
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo++$a ?></td>
                                        <td><?php echo $dt_informasi['Judul_Info']; ?></td>
                                        <td><?php echo $dt_informasi['Jenis_Info']; ?></td>
                                        <td><?php echo $dt_informasi['Tanggal_info']; ?></td>
                                        <td><?php echo $dt_informasi['Nama_Pengguna']; ?></td>                                        
                                        <td align="center"><a href="<?php echo base_url('data_informasi/ubah_data_informasi/' . $dt_informasi['Id_Informasi']); ?>"><i class="fa fa-edit"></i> ubah </a>
                                            | <a class="tombol-hapus" href="<?php echo base_url('data_informasi/hapus_data_informasi/' . $dt_informasi['Id_Informasi']); ?>" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')"><i class="fa fa-times"></i> hapus </a>
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