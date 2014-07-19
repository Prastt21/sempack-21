<section class="content-header">
    <h1>
        Operator
        <small>Data Operator</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Operator</li>
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
                        <div class="col-xs-2"><a href="<?php echo base_url('data_operator/tambah_data_operator'); ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Tambah Data</a></div>
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
                    <table class="table table-bordered table-condensed table-hover">
                        <thead>
                            <tr>
                                <td width="5%" align="center">No</td>
                                <td width="10%">Level Operator</td>
                                <td width="15%">Nama Operator</td>
                                <td width="10%">Status Operator</td>
                                <td width="10%">Username</td>
                                <td width="10%">Jenis Kelamin</td>
                                <td width="10%">No Telephone</td>
                                <td width="15%">Alamat</td>
                                <td width="15%">Tanggal Lahir</td>
                                <td width="10%">Email</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($operator)) {
                                $a = isset($awal) ? $awal : 0;
                                foreach ($operator as $dt_operator):
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo++$a ?></td>
                                        <td><?php echo $dt_operator->level; ?></td>
                                        <td><?php echo $dt_operator->nama_operator; ?></td>
                                        <td><?php echo $dt_operator->status; ?></td>
                                        <td><?php echo $dt_operator->username; ?></td>
                                        <td><?php echo $dt_operator->jenis_kelamin; ?></td>
                                        <td><?php echo $dt_operator->telephone; ?></td>
                                        <td><?php echo $dt_operator->alamat; ?></td>
                                        <td><?php echo $dt_operator->tanggal; ?></td>
                                        <td><?php echo $dt_operator->email; ?></td>
                                        <td align="center"><a href="<?php echo base_url('data_operator/ubah_data_operator/' . $dt_operator->id_pengguna); ?>"><i class="fa fa-edit"></i> ubah </a>
                                            | <a href="#"><i class="fa fa-times"></i> hapus </a>
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