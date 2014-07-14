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
                        <div class="col-xs-2"><a href="<?php echo base_url('informasi/tambah_informasi'); ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Tambah Data</a></div>
                        <div class="col-xs-4">
                            <div class="input-group input-group-sm">
                                <form action="<?php echo base_url('informasi/cari'); ?>" method="post" class="form-inline" role="form">
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
                    <table class="table table-bordered table-condensed table-hover">
                        <thead>
                            <tr>
                                <td width="5%" align="center">No</td>
                                <td width="10%">Operator / Admin</td>
                                <td width="30%">Judul Informasi</td>
                                <td width="35%">Isi Informasi</td>
                                <td width="10%">Jenis Informasi</td>
                                <td width="10%">Tanggal Publish</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($informasi)) {
                                $a = isset($awal) ? $awal : 0;
                                foreach ($informasi as $dt_informasi):
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo++$a; ?></td>
                                        <td><?php echo $dt_informasi['judul_informasi']; ?></td>
                                        <td><?php echo $dt_informasi['jenis_informasi']; ?></td>
                                        <td align="center"><a href="<?php echo base_url('informasi/ubah_informasi/' . $dt_pelanggan['id_informasi']); ?>"><i class="fa fa-edit"></i> ubah </a>
                                            | <a href="#" class="tombol-hapus" data-id="<?php echo $dt_informasi['id_informasi']; ?>"><i class="fa fa-times"></i> hapus </a>
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