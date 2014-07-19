<section class="content-header">
    <h1>
        Konfigurasi Sistem
        <small>Optimasi Sistem</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Operator</li>
        <li class="active">Konfigurasi Sistem</li>
    </ol>
    <!-- Main content -->
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-8">
            <div class="box box-primary">
                <div class="box-header"><h3 class="box-title">Konfigurasi Sistem</h3></div>
                <div class="box-body">
                  
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="alert alert-error alert-dismissable" id="div-alert">
                                    <button class="close" aria-hidden="true" id="alert-close" type="button">×</button>
                                    <span id="alert-value"></span>
                                </div>
                            </div>
                        </div>
                    
                    <form class="form-horizontal" action="<?php echo base_url(); ?>" id="form-tambah-pengguna" method="post">
                        <div class="form-group">
                            <label for="status-sistem" class="col-lg-3 control-label">Status Sistem</label>
                            <div class="col-lg-5">
                                <select name="status_sistem" class="form-control input-sm" style="width: 150px;">
                                    <option></option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Non-Aktif">Non Aktif</option>
                                </select>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="periode-sistem" class="col-lg-3 control-label">Periode Sistem</label>
                            <div class="col-lg-5">
                                <select name="periode_sistem" class="form-control input-sm" style="width: 150px;">
                                    <option></option>
                                    <option value="Aula">Aula</option>
                                    <option value="Beasiswa">Beasiswa</option>
                                    <option value="Asuransi">Asuransi</option>
                                </select>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="pengumuman-sistem" class="col-lg-3 control-label">Pengumuman Sistem</label>
                            <div class="col-lg-5">
                                <textarea name="pengumuman_sistem" maxlength="100" class="form-control input-sm" placeholder="Pengumuman"></textarea>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="konfigurasi-khusus" class="col-lg-3 control-label">Konfigurasi Khusus</label>
                            <div class="col-lg-5">
                                <input type="text" name="konfigurasi_khusus" maxlength="100" class="form-control input-sm" placeholder="Konfigurasi Khusus">
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="status-request" class="col-lg-3 control-label">Status Request</label>
                            <div class="col-lg-5">
                                <select name="status_request" class="form-control input-sm" style="width: 150px;">
                                    <option></option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Non-Aktif">Non Aktif</option>
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
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>