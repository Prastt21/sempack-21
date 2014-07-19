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
                    <?php
                    if ($this->session->flashdata('pesan')) {
                        $pesan = $this->session->flashdata('pesan');
                     ?>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="alert <?php echo $pesan['css']; ?> alert-dismissable" id="div-alert">
                                    <button class="close" aria-hidden="true" id="alert-close" type="button">×</button>
                                    <span id="alert-value"> <?php echo $pesan['psn']; ?></span>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row" style="height: 10px"></div>
                    <table class="table table-bordered table-condensed table-hover">
                        <thead>
                            <tr>
                                <td width="5%" align="center">No</td>
                                <td width="15%">Nama Orang Tua</td>
                                <td width="15%">Nama Pengguna</td>
                                <td width="10%">Username</td>
                                <td width="10%">JK</td>
                                <td width="10%">No Telp</td>
                                <td width="15%">Alamat</td>
                                <td width="10%">Tanggal Lahir</td>
                                <td width="10%">Email</td>
                                                                
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
                                        <td><?php echo $dt_pengguna['Nama_Ortu']; ?></td>
                                        <td><?php echo $dt_pengguna['Nama_Pengguna']; ?></td>
                                        <td><?php echo $dt_pengguna['NIK_NIM']; ?></td>
                                        <td><?php echo $dt_pengguna['Gender']; ?></td>
                                        <td><?php echo $dt_pengguna['No_Telp']; ?></td>
                                        <td><?php echo $dt_pengguna['Alamat']; ?></td>
                                        <td><?php echo $dt_pengguna['Tanggal_Lahir']; ?></td>
                                        <td><?php echo $dt_pengguna['Email']; ?></td>                                      
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