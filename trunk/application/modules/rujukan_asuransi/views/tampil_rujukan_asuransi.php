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
                                <td width="3%" align="center">No</td>
                                <td width="8%">Jenis Asuransi</td>
                                <td width="15%">Nama Perujuk</td>
                                <td width="10%">Rumah Sakit</td>
                                <td width="12%">Alamat Rumah Sakit</td>
                                <td width="11%">Tanggal Masuk</td>
                                <td width="11%">Tanggal Keluar</td>
                                <td width="9%">Total Biaya</td>
                                <td width="9%">Santunan</td>                                
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
                                        <td><?php echo $dt_rujukan_asuransi['Tanggal_Masuk']; ?></td>
                                        <td><?php echo $dt_rujukan_asuransi['Tanggal_Keluar']; ?></td>
                                        <td><?php echo $dt_rujukan_asuransi['Total_Biaya']; ?></td>
                                        <td><?php echo $dt_rujukan_asuransi['Santunan']; ?></td>
                                        
                                        <td align="center"><a href="<?php echo base_url('rujukan_asuransi/ubah_rujukan_asuransi/' . $dt_rujukan_asuransi['Id_Asuransi']); ?>"><i class="fa fa-edit"></i> ubah </a>
                                            | <a class="tombol-hapus" href="#" data-id="<?php echo $dt_rujukan_asuransi['Id_Asuransi']; ?>"><i class="fa fa-times"></i> hapus </a>
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