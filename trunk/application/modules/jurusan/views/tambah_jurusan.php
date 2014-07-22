<section class="content-header">
    <h1>
        Tambah Data
        <small>Tambah Data Jurusan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Jurusan</li>
        <li class="active">Tambah Jurusan</li>
    </ol>
    <!-- Main content -->
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-8">
            <div class="box box-primary">
                <div class="box-header"><h3 class="box-title">Data Jurusan</h3></div>
                <div class="box-body">
                    <?php $this->load->view('templates/notification'); ?>
                    <form class="form-horizontal" action="<?php echo base_url('jurusan/proses_tambah_jurusan'); ?>" id="form-tambah-pengguna" method="post">
                        <div class="form-group">
                            <label for="nama-jurusan" class="col-lg-3 control-label">Nama Jurusan</label>
                            <div class="col-lg-5">
                                <input type="text" name="nama_jurusan" maxlength="20" class="form-control input-sm" placeholder="Nama Jurusan">
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="singkatan-jurusan" class="col-lg-3 control-label">Singkatan Jurusan</label>
                            <div class="col-lg-5">
                                <input type="text" name="singkatan_jurusan" maxlength="20" class="form-control input-sm" placeholder="Singkatan Jurusan">
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="warna-jurusan" class="col-lg-3 control-label">Warna Jurusan</label>
                            <div class="col-lg-5">
                                <select name="warna_jurusan" class="form-control input-sm" style="width: 150px;">
                                    <option></option>
                                    <option value="#20B2AA" <?php echo set_value('warna_jurusan') == '#20B2AA' ? 'selected = "selected"' : '' ?>>Lightseagreen</option>
                                    <option value="#87CEFA" <?php echo set_value('warna_jurusan') == '#87CEFA' ? 'selected = "selected"' : '' ?>>Lightskyblue</option>
                                    <option value="#778899" <?php echo set_value('warna_jurusan') == '#778899' ? 'selected = "selected"' : '' ?>>Lightslategray</option>
                                    <option value="#B0C4DE" <?php echo set_value('warna_jurusan') == '#B0C4DE' ? 'selected = "selected"' : '' ?>>Lightsteelblue</option>
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
                            Kolom Ulangi Password<br>
                            Kolom Ulangi Password diisi dengan mengulang password sesui password diinputkan pertama.  Minimal terdiri dari 3 karakter, maksimal 12 karakter. Kolom ini tidak boleh kosong.
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>