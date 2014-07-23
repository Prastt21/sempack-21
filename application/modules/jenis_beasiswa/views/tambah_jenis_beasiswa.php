<section class="content-header">
    <h1>
        Tambah Data
        <small>Tambah Data Jenis Beasiswa</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Operator</li>
        <li class="active">Tambah Jenis Beasiswa</li>
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
                    <form class="form-horizontal" action="<?php echo base_url('jenis_beasiswa/proses_tambah_jenis_beasiswa'); ?>" id="form-tambah-pengguna" method="post">
                        <div class="form-group">
                          <div class="form-group">
                            <label for="jenis-beasiswa" class="col-lg-3 control-label">Jenis beasiswa</label>
                            <div class="col-lg-5">
                                <input type="text" name="jenis_beasiswa" maxlength="100" class="form-control input-sm" placeholder="jenis_beasiswa">
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>                            
                        <div class="form-group">
                            <label for="warna-beasiswa" class="col-lg-3 control-label">Warna Beasiswa</label>
                            <div class="col-lg-5">
                                <select name="warna_beasiswa" class="form-control input-sm" style="width: 150px;">
                                    <option></option>
                                    <option value="#FF0000" <?php echo set_value('warna_beasiswa') == '#FF0000' ? 'selected = "selected"' : '' ?>>Merah</option>
                                    <option value="#FFFF00" <?php echo set_value('warna_beasiswa') == '#FFFF00' ? 'selected = "selected"' : '' ?>>Kuning</option>
                                    <option value="#008000" <?php echo set_value('warna_beasiswa') == '#008000' ? 'selected = "selected"' : '' ?>>Hijau</option>
                                    <option value="#800080" <?php echo set_value('warna_beasiswa') == '#800080' ? 'selected = "selected"' : '' ?>>Ungu</option>
                                </select>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div> 
                        <div class="form-group">
                            <label for="keterangan-beasiswa" class="col-lg-3 control-label">Keterangan</label>
                            <div class="col-lg-5">
                                <textarea name="keterangan" maxlength="100" class="form-control input-sm" placeholder="Keterangan"><?php echo set_value('keterangan', ''); ?></textarea>
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