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
                                <td width="15%">Nama Mahasiswa</td>
                                <td width="15%">Nama Orang Tua</td>                                
                                <td width="15%">Alamat</td>
                                <td width="10%">No Telephone</td>
                                <td width="15%">Pekerjaaan </td>
                                <td width="15%">Penghasilan</td>
                                <td width="10%">Jumlah Tanggungan</td>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($rs_keterangan_orang_tua)) {
                                $a = isset($awal) ? $awal : 0;
                                foreach ($rs_keterangan_orang_tua as $dt_keterangan_ortu):
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo++$a ?></td>
                                        <td><?php echo $dt_keterangan_ortu['Nama_Pengguna']; ?></td>
                                        <td><?php echo $dt_keterangan_ortu['Nama_Ortu']; ?></td>
                                        <td><?php echo $dt_keterangan_ortu['Alamat_Ortu']; ?></td>
                                        <td><?php echo $dt_keterangan_ortu['No_Telp_Ortu']; ?></td>                                        
                                        <td><?php echo $dt_keterangan_ortu['Pekerjaan_Ortu']; ?></td>
                                        <td><?php echo $dt_keterangan_ortu['Penghasilan_Ortu']; ?></td>
                                        <td><?php echo $dt_keterangan_ortu['Jml_Tanggungan']; ?></td>                                        
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