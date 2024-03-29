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
                        <div class="col-xs-4">
                            <div class="input-group input-group-sm">
                                <input class="form-control" type="text">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-search"></i> cari !</button>
                                </span>
                            </div>
                            <div class="form-group">
                            <label for="jenis-beasiswa" class="col-lg-3 control-label">Jenis Beasiswa</label>
                            <div class="col-lg-5">
                                <select name="jenis_beasiswa" class="form-control input-sm" style="width: 150px;">
                                    <option></option>
                                    <?php
                                    if (isset($rs_jenis_beasiswa)):
                                        foreach ($rs_jenis_beasiswa as $dt_jenis_beasiswa):
                                            ?>
                                            <option value="<?php echo $dt_jenis_beasiswa['Id_JB']; ?>" <?php echo set_value('jenis_beasiswa') == $dt_jenis_beasiswa['Id_JB'] ? 'selected = "selected"' : ''; ?>><?php echo $dt_jenis_beasiswa['Jenis_Beasiswa']; ?></option>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
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
                                <td width="10%" align="center"><b>NO REK</b></td>
                                <td width="10%" align="center"><b>TGL DAFTAR</b></td>
                                <td width="10%" align="center"><b>STATUS</b></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($rs_data_beasiswa)) {
                                $a = isset($awal) ? $awal : 0;
                                foreach ($rs_data_beasiswa as $dt_data_beasiswa):
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo++$a ?></td>
                                        <td><?php echo $dt_data_beasiswa['Jenis_Beasiswa']; ?></td>
                                        <td><?php echo $dt_data_beasiswa['Nama_Pengguna']; ?></td>                                        
                                        <td><?php echo $dt_data_beasiswa['Nama_Jurusan']; ?></td>
                                        <td><?php echo $dt_data_beasiswa['Semester']; ?></td>
                                        <td><?php echo $dt_data_beasiswa['IPK']; ?></td>
                                        <td><?php echo $dt_data_beasiswa['No_Rekening']; ?></td>
                                        <td><?php echo $dt_data_beasiswa['Tanggal_Daftar']; ?></td>
                                        <td><?php echo $dt_data_beasiswa['Status_Beasiswa']; ?></td>
                                        <td align="center"><a href="<?php echo base_url('data_beasiswa/ubah_data_beasiswa/' . $dt_data_beasiswa['Id_Beasiswa']); ?>" title="ubah data"><i class="fa fa-edit"></i></a>
                                            | <a class="tombol-hapus" href="<?php echo base_url('data_beasiswa/hapus_data_beasiswa/' . $dt_data_beasiswa['Id_Beasiswa']); ?>" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')" title="hapus data"><i class="fa fa-times"></i></a>
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