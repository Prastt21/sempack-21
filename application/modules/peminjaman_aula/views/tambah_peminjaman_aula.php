<section class="content-header">
    <h1>
        Tambah Data
        <small>Tambah Data Peminjaman Aula</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Peminjaman Aula</li>
        <li class="active">Tambah Peminjaman Aula</li>
    </ol>
    <!-- Main content -->
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-8">
            <div class="box box-primary">
                <div class="box-header"><h3 class="box-title">Data Peminjaman Aula</h3></div>
                <div class="box-body">
                    <!--template untuk notifikasi-->
                    <?php $this->load->view('templates/notification'); ?>
                    <form class="form-horizontal" action="<?php echo base_url('peminjaman_aula/proses_tambah_peminjaman_aula'); ?>" id="form-tambah-pengguna" method="post">
                        <div class="form-group">
                            <label for="nama-kegiatan" class="col-lg-3 control-label">Nama Kegiatan</label>
                            <div class="col-lg-5">
                                <input type="text" name="nama_kegiatan" maxlength="100" class="form-control input-sm" placeholder="Nama Kegiatan" value="<?php echo set_value('nama_kegiatan'); ?>">
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="ketua-organisasi" class="col-lg-3 control-label">Ketua Organisasi</label>
                            <div class="col-lg-5">
                                <input type="text" name="ketua_organisasi" maxlength="100" class="form-control input-sm" placeholder="Ketua Organisasi" value="<?php echo set_value('ketua_organisasi'); ?>">
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="peserta-aula" class="col-lg-3 control-label">Peserta</label>
                            <div class="col-lg-5">
                                <input type="text" name="peserta" maxlength="100" class="form-control input-sm" placeholder="Peserta" value="<?php echo set_value('peserta'); ?>">
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>                        
                        <div class="form-group">
                            <label for="jml-peserta" class="col-lg-3 control-label">Jumlah Peserta</label>
                            <div class="col-lg-5">
                                <input type="text" name="jml_peserta" maxlength="100" class="form-control input-sm" placeholder="Jumlah Peserta" value="<?php echo set_value('jml_peserta'); ?>">
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
                            <label for="tanggal-pinjam" class="col-lg-3 control-label">Tanggal Pinjam</label>
                            <div class="col-lg-5">
                                <div class="bfh-datepicker" data-name="tanggal_pinjam" data-placeholder='tanggal' data-format="y-m-d" data-date="today"></div>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="waktu-pinjam" class="col-lg-3 control-label">Waktu Pinjam</label>
                            <div class="col-lg-5">
                                <div class="bfh-timepicker" data-name="waktu_pinjam" data-placeholder='waktu' data-format="y-m-d" data-date="today"></div>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal-selesai" class="col-lg-3 control-label">Tanggal Selesai</label>
                            <div class="col-lg-5">
                                <div class="bfh-datepicker" data-name="tanggal_selesai" data-placeholder='tanggal' data-format="y-m-d" data-date="today"></div>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="waktu-selesai" class="col-lg-3 control-label">Waktu Selesai</label>
                            <div class="col-lg-5">
                                <div class="bfh-timepicker" data-name="waktu_selesai" data-placeholder='waktu' data-format="y-m-d" data-date="today"></div>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>                       
                        <div class="form-group">
                            <label for="status-penggunaan" class="col-lg-3 control-label">Status Penggunaan</label>
                            <div class="col-lg-5">
                                <select name="status_penggunaan" class="form-control input-sm" style="width: 150px;">
                                    <option></option>
                                    <option value="TERVERIFIKASI" <?php echo set_value('status_penggunaan') == 'TERVERIFIKASI' ? 'selected="selected"' : ''; ?>>TERVERIFIKASI</option>
                                    <option value="WAITING" <?php echo set_value('status_penggunaan') == 'WAITING' ? 'selected="selected"' : ''; ?>>WAITING</option>                                    
                                    <option value="EXPIRED" <?php echo set_value('status_penggunaan') == 'EXPIRED' ? 'selected="selected"' : ''; ?>>EXPIRED</option>                                    
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