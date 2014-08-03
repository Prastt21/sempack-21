<section class="content-header">
    <h1>
        Ubah Data
        <small>Ubah Rujukan Asuransi <?php echo $result_rujukan_asuransi['Jenis_Asuransi']; ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Rujukan Asuransi</li>
        <li class="active">Tambah Rujukan Asuransi</li>
    </ol>
    <!-- Main content -->
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-8">
            <div class="box box-primary">
                <div class="box-header"><h3 class="box-title">Data Rujukan Asuransi</h3></div>
                <div class="box-body">
                    <!--load template notifikasi-->
                    <?php $this->load->view('templates/notification'); ?>
                    <form class="form-horizontal" action="<?php echo base_url('rujukan_asuransi/proses_ubah_rujukan_asuransi'); ?>" id="form-tambah-pengguna" method="post">
                        <input type="hidden" name="id_asuransi" value="<?php echo set_value('id_asuransi', $result_rujukan_asuransi['Id_Asuransi']); ?>">
                        <div class="form-group">
                            <label for="jenis-asuransi" class="col-lg-3 control-label">Jenis Asuransi</label>
                            <div class="col-lg-5">
                                <select name="jenis_asuransi" class="form-control input-sm" style="width: 150px;">
                                    <option></option>
                                    <option value="KECELAKAAN" <?php echo set_value('jenis_asuransi', $result_rujukan_asuransi['Jenis_Asuransi']) == 'KECELAKAAN' ? 'selected = "selected"' : '' ?>>KECELAKAAN</option>
                                    <option value="SAKIT" <?php echo set_value('jenis_asuransi', $result_rujukan_asuransi['Jenis_Asuransi']) == 'SAKIT' ? 'selected = "selected"' : '' ?>>SAKIT</option>                                    
                                </select>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>                                              
                        <div class="form-group">
                            <label for="nama-rs" class="col-lg-3 control-label">Nama Rumah Sakit</label>
                            <div class="col-lg-5">
                                <input type="text" name="nama_rs" maxlength="100" class="form-control input-sm" placeholder="Nama Rumah Sakit" value="<?php echo set_value('nama_rs', $result_rujukan_asuransi['Nama_RS']); ?>">
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="alamat-rs" class="col-lg-3 control-label">Alamat Rumah Sakit</label>
                            <div class="col-lg-5">
                                <textarea name="alamat_rs" class="form-control" placeholder="Alamat Rumah Sakit"><?php echo set_value('alamat_rs', $result_rujukan_asuransi['Alamat_RS']); ?></textarea>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="kronologi-asuransi" class="col-lg-3 control-label">Kronologi Kejadian</label>
                            <div class="col-lg-5">
                                <textarea name="kronologi" class="form-control" placeholder="Kronologi"><?php echo set_value('kronologi', $result_rujukan_asuransi['Kronologi']); ?></textarea>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal-daftar" class="col-lg-3 control-label">Tanggal Daftar</label>
                            <div class="col-lg-5">
                                <div class="bfh-datepicker" data-name="tanggal_daftar" data-placeholder='tanggal' data-format="y-m-d" data-date="<?php echo set_value('tanggal_daftar', $result_rujukan_asuransi['Tanggal_Daftar']); ?>"></div>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal-masuk" class="col-lg-3 control-label">Tanggal Masuk</label>
                            <div class="col-lg-5">
                                <div class="bfh-datepicker" data-name="tanggal_masuk" data-placeholder='tanggal' data-format="y-m-d" data-date="<?php echo set_value('tanggal_masuk', $result_rujukan_asuransi['Tanggal_Masuk']); ?>"></div>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal-keluar" class="col-lg-3 control-label">Tanggal Keluar</label>
                            <div class="col-lg-5">
                                <div class="bfh-datepicker" data-name="tanggal_keluar" data-placeholder='tanggal' data-format="y-m-d" data-date="<?php echo set_value('tanggal_keluar', $result_rujukan_asuransi['Tanggal_Keluar']); ?>"></div>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="total-biaya" class="col-lg-3 control-label">Total Biaya</label>
                            <div class="col-lg-5">
                                <input type="text" name="total_biaya" maxlength="20" class="form-control input-sm" placeholder="Total Biaya" value="<?php echo set_value('total_biaya', $result_rujukan_asuransi['Total_Biaya']); ?>">
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="santunan-asuransi" class="col-lg-3 control-label">Santunan</label>
                            <div class="col-lg-5">
                                <input type="text" name="santunan" maxlength="20" class="form-control input-sm" placeholder="Santunan" value="<?php echo set_value('santunan', $result_rujukan_asuransi['Santunan']); ?>">
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>                        
                        <div class="form-group">
                            <label for="status-asuransi" class="col-lg-3 control-label">Status Asuransi</label>
                            <div class="col-lg-5">
                                <select name="status_asuransi" class="form-control input-sm" style="width: 150px;">
                                    <option></option>
                                    <option value="TERVERIFIKASI" <?php echo set_value('status_asuransi', $result_rujukan_asuransi['Status_Asuransi']) == 'TERVERIFIKASI' ? 'selected = "selected"' : '' ?>>TERVERIFIKASI</option>
                                    <option value="WAITING" <?php echo set_value('status_asuransi', $result_rujukan_asuransi['Status_Asuransi']) == 'WAITING' ? 'selected = "selected"' : '' ?>>WAITING</option>                                    
                                </select>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>                       
                        <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-5">
                                <button type="submit" class="btn btn-primary btn-sm" name="simpan" id="simpan" value="simpan">Simpan</button>
                                <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-default confirm">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Petunjuk</h3>
                    <div class="pull-right box-tools">
                        <button title="" data-toggle="tooltip" data-widget="collapse" class="btn btn-info btn-sm" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <ol>
                        <li>
                            Kolom Level Operator<br>
                            Kolom level operator diisi dengan level sesuai dengan operasi sistem.  Terdiri minimal 3 karakter dengan maksimal 100 karakter.  Kolom ini tidak boleh kosong.
                        </li>
                        <li>
                            Kolom Nama Operator<br>
                            Kolom nama operator merupakan nama lengkap operator sistem  Terdiri minimal 3 karakter dengan maksimal 20 karakter.  Dalam kolom ini SPASI akan dihilangkan.  Kolom ini tidak boleh kosong.
                        </li>
                        <li>
                            Kolom Status Operator<br>
                            Kolom status oerator disi dengan status operator saat ini.  Terdiri minimal 8 karakter dengan maksimal 20 karakter.  Untuk memastikan saat pengisian, kolom kata kunci harus sama dengan kolom ulangi kata kunci.  Kolom ini tidak boleh kosong.
                        </li>
                        <li>
                            Kolom Username<br>
                            Kolom username digunakan untuk masuk ke dalam sistem.  Kolom ini tidak boleh kosong.
                        </li>                        
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>