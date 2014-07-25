<section class="content-header">
    <h1>
        Tambah Data
        <small>Tambah Data Beasiswa</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Beasiswa</li>
        <li class="active">Tambah Beasiswa</li>
    </ol>
    <!-- Main content -->
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-8">
            <div class="box box-primary">
                <div class="box-header"><h3 class="box-title">Data Beasiswa</h3></div>
                <div class="box-body">
                    <!--template untuk notifikasi-->
                    <?php $this->load->view('templates/notification'); ?>
                    <form class="form-horizontal" action="<?php echo base_url('beasiswa/proses_tambah_beasiswa'); ?>" id="form-tambah-pengguna" method="post">
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
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="jurusan-beasiswa" class="col-lg-3 control-label">Jurusan</label>
                            <div class="col-lg-5">
                                <select name="jurusan" class="form-control input-sm" style="width: 150px;">
                                    <option></option>
                                    <?php
                                    if (isset($rs_jurusan)):
                                        foreach ($rs_jurusan as $dt_jurusan):
                                            ?>
                                            <option value="<?php echo $dt_jurusan['Id_Jurusan']; ?>" <?php echo set_value('jurusan') == $dt_jurusan['Id_Jurusan'] ? 'selected = "selected"' : ''; ?>><?php echo $dt_jurusan['Nama_Jurusan']; ?></option>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="jenjang-beasiswa" class="col-lg-3 control-label">Jenjang</label>
                            <div class="col-lg-5">
                                <select name="jenjang" class="form-control input-sm" style="width: 150px;">
                                    <option></option>
                                    <option value="DIPLOMA 3" <?php echo set_value('jenjang') == 'DIPLOMA 3' ? 'selected="selected"' : ''; ?>>DIPLOMA 3</option>
                                    <option value="STRATA 1" <?php echo set_value('jenjang') == 'STRATA 1' ? 'selected="selected"' : ''; ?>>STRATA 1</option>                                    
                                </select>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="alamat-sekarang" class="col-lg-3 control-label">Alamat Sekarang</label>
                            <div class="col-lg-5">
                                <textarea name="alamat_sekarang" class="form-control" placeholder="Alamat Sekarang"><?php echo set_value('alamat_sekarang', ''); ?></textarea>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="nama-pt" class="col-lg-3 control-label">Perguruan Tinggi</label>
                            <div class="col-lg-5">
                                <input type="text" name="nama_pt" maxlength="100" value="STMIK AMIKOM YOGYAKARTA"  disabled="" class="form-control input-sm" placeholder="Nama_PT" value="<?php echo set_value('nama_pt'); ?>">
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="semester-beasiswa" class="col-lg-3 control-label">Semester</label>
                            <div class="col-lg-5">
                                <select name="semester" class="form-control input-sm" style="width: 150px;">
                                    <option></option>
                                    <option value="2" <?php echo set_value('semester') == '2' ? 'selected="selected"' : ''; ?>>2</option>
                                    <option value="4" <?php echo set_value('semester') == '4' ? 'selected="selected"' : ''; ?>>4</option>                                    
                                    <option value="6" <?php echo set_value('semester') == '6' ? 'selected="selected"' : ''; ?>>6</option>
                                </select>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="ipk-beasiswa" class="col-lg-3 control-label">Indeks Prestasi Komulatif</label>
                            <div class="col-lg-5">
                                <input type="text" name="ipk" maxlength="100" class="form-control input-sm" placeholder="IPK" value="<?php echo set_value('ipk'); ?>">
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="prestasi-beasiswa" class="col-lg-3 control-label">Prestasi</label>
                            <div class="col-lg-5">
                                <textarea name="prestasi" class="form-control" placeholder="Prestasi"><?php echo set_value('prestasi', ''); ?></textarea>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="alasan-beasiswa" class="col-lg-3 control-label">Alasan</label>
                            <div class="col-lg-5">
                                <textarea name="alasan" class="form-control" placeholder="Alasan"><?php echo set_value('alasan', ''); ?></textarea>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="bank-beasiswa" class="col-lg-3 control-label">BANK Rekening</label>
                            <div class="col-lg-5">
                                <input type="text" name="bank" maxlength="100" value="MUAMALAT" disabled="" class="form-control input-sm" placeholder="Bank" value="<?php echo set_value('bank'); ?>">
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="no-rekening" class="col-lg-3 control-label">No Rekening</label>
                            <div class="col-lg-5">
                                <input type="text" name="no_rekening" maxlength="100" class="form-control input-sm" placeholder="No Rekening" value="<?php echo set_value('no_rekening'); ?>">
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal-daftar" class="col-lg-3 control-label">Tanggal Daftar</label>
                            <div class="col-lg-5">
                                <div class="bfh-datepicker" data-name="tanggal_daftar" data-placeholder='tanggal' data-format="y-m-d" data-date="today"></div>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div> 
                        <div class="form-group">
                            <label for="status-beasiswa" class="col-lg-3 control-label">Status Beasiswa</label>
                            <div class="col-lg-5">
                                <select name="status_beasiswa" class="form-control input-sm" style="width: 150px;">
                                    <option></option>
                                    <option value="TERVERIFIKASI" <?php echo set_value('status_beasiswa') == 'TERVERIFIKASI' ? 'selected="selected"' : ''; ?>>TERVERIFIKASI</option>
                                    <option value="WAITING" <?php echo set_value('status_beasiswa') == 'WAITING' ? 'selected="selected"' : ''; ?>>WAITING</option>                                    
                                </select>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-5">
                                <button type="submit" class="btn btn-primary btn-sm" name="simpan" id="simpan" value="simpan">Simpan</button>
                                <a href="#" class="btn btn-default confirm">Batal</a>
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
                        <li>
                            Kolom Password<br>
                            Kolom password diisi dengan password operator.  Kolom ini tidak boleh kosong.
                        </li>
                        <li>
                            Kolom Ulangi Password<br>
                            Kolom Ulangi Password diisi dengan mengulang password sesui password diinputkan pertama.  Minimal terdiri dari 3 karakter, maksimal 12 karakter. Kolom ini tidak boleh kosong.
                        </li>
                        <li>
                            Kolom Jenis Kelamin<br>
                            Kolom Jenis Kelamin diisi dengan jenis kelamin perator saat ini.  Minimal terdiri dari 3 karakter, maksimal 12 karakter. Kolom ini tidak boleh kosong.
                        </li>
                        <li>
                            Kolom No Telephone<br>
                            Kolom No Telephone operator yang sedang aktif.  Minimal terdiri dari 3 karakter, maksimal 12 karakter. Kolom ini tidak boleh kosong.
                        </li>
                        <li>
                            Kolom Alamat<br>
                            Kolom alamat operator saat ini.  Minimal terdiri dari 3 karakter, maksimal 12 karakter. Kolom ini tidak boleh kosong.
                        </li>
                        <li>
                            Kolom Tempat Lahir<br>
                            Kolom tempat lahir disi dengan tempat dimana operator diahirkan.  Minimal terdiri dari 3 karakter, maksimal 12 karakter. Kolom ini tidak boleh kosong.
                        </li>
                        <li>
                            Kolom Tanggal Lahir<br>
                            Kolom tanggal lahir disi tanggal operator pernah dilahirkan.  Minimal terdiri dari 3 karakter, maksimal 12 karakter. Kolom ini tidak boleh kosong.
                        </li>
                        <li>
                            Kolom Email<br>
                            Kolom email diisi dengan email pengguna jika ada.  Kolom ini boleh kosong, namun dalam pengisian harus menggunakan format email. misal : <em>contoh@email.com</em>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>