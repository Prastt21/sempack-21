<section class="content-header">
    <h1>
        Beasiswa
        <small>Data Beasiswa</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Beasiswa</li>
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
                        <div class="col-xs-2"><a href="<?php echo base_url('beasiswa/tambah_beasiswa'); ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Tambah Data</a></div>
                        <div class="col-xs-4">
                            <div class="input-group input-group-sm">
                               <form action="<?php echo base_url('beasiswa/cari'); ?>" method="post" class="form-inline" role="form">
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
                                <td width="10%" align="center"><b>BEASISWA</b></td>
                                <td width="20%" align="center"><b>PENDAFTAR</b></td>                                
                                <td width="15%" align="center"><b>JURUSAN</b></td>
                                <td width="5%" align="center"><b>SMT</b></td>
                                <td width="5%" align="center"><b>IPK</b></td>
                                <td width="10%" align="center"><b>NO REKENING</b></td>
                                <td width="13%" align="center"><b>TGL DAFTAR</b></td>
                                <td width="10%" align="center"><b>STATUS </b></td> 
                                <td align="center"><b>AKSI </b></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($rs_beasiswa)) {
                                $a = isset($awal) ? $awal : 0;
                                foreach ($rs_beasiswa as $dt_beasiswa):
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo++$a ?></td>
                                        <td><?php echo $dt_beasiswa['Jenis_Beasiswa']; ?></td>
                                        <td><?php echo $dt_beasiswa['Nama_Pengguna']; ?></td>                                        
                                        <td><?php echo $dt_beasiswa['Nama_Jurusan']; ?></td>
                                        <td><?php echo $dt_beasiswa['Semester']; ?></td>
                                        <td><?php echo $dt_beasiswa['IPK']; ?></td>
                                        <td><?php echo $dt_beasiswa['No_Rekening']; ?></td>
                                        <td><?php echo $dt_beasiswa['Tanggal_Daftar']; ?></td>
                                        <td><?php echo $dt_beasiswa['Status_Beasiswa']; ?></td>
                                        <td align="center"><a href="<?php echo base_url('beasiswa/ubah_beasiswa/' . $dt_beasiswa['Id_Beasiswa']); ?>" title="ubah data"><i class="fa fa-edit"></i></a>
                                            | <a class="tombol-hapus" href="<?php echo base_url('beasiswa/hapus_beasiswa/' . $dt_beasiswa['Id_Beasiswa']); ?>" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')" title="hapus data"><i class="fa fa-times"></i></a>
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