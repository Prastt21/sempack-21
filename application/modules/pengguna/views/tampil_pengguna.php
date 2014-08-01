<section class="content-header">
    <h1>
        Pengguna
        <small>Data Pengguna</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pengguna</li>
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
                                <form action="<?php echo base_url('pengguna/cari'); ?>" method="post" class="form-inline" role="form">
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
                                <td width="15%" align="center"><b>PENGGUNA</b></td>                                
                                <td width="7%" align="center"><b>JK</b></td>
                                <td width="8%" align="center"><b>STATUS</b></td>
                                <td width="8%" align="center"><b>USERNAME</b></td>
                                <td width="10%" align="center"><b>NO TELP</b></td>
                                <td width="13%" align="center"><b>ALAMAT</b></td>
                                <td width="10%" align="center"><b>TGL LAHIR</b></td>
                                <td width="13%" align="center"><b>EMAIL</b></td>
                                <td width="13%" align="center"><b>NAMA ORANG TUA</b></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($rs_pengguna)) {
                                $a = isset($awal) ? $awal : 0;
                                foreach ($rs_pengguna as $dt_pengguna):
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo++$a ?></td>
                                        <td><?php echo $dt_pengguna['Nama_Pengguna']; ?></td>
                                        <td><?php echo $dt_pengguna['Gender']; ?></td>
                                        <td><?php echo $dt_pengguna['Status_Pengguna']; ?></td>
                                        <td><?php echo $dt_pengguna['NIK_NIM']; ?></td>
                                        <td><?php echo $dt_pengguna['No_Telp']; ?></td>
                                        <td><?php echo $dt_pengguna['Alamat']; ?></td>
                                        <td><?php echo $dt_pengguna['Tanggal_Lahir']; ?></td>
                                        <td><?php echo $dt_pengguna['Email']; ?></td>
                                        <td><?php echo $dt_pengguna['Nama_Ortu']; ?></td>
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