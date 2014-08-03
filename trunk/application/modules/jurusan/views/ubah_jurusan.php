<section class="content-header">
    <h1>
        Ubah Data
        <small>Ubah Data Jurusan <?php echo $result_jurusan['Nama_Jurusan']; ?></small>
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
                    <!--load template notifikasi-->
                    <?php $this->load->view('templates/notification'); ?>
                    <form class="form-horizontal" action="<?php echo base_url('jurusan/proses_ubah_jurusan'); ?>" id="form-tambah-pengguna" method="post">
                        <input type="hidden" name="id_jurusan" value="<?php echo set_value('id_jurusan', $result_jurusan['Id_Jurusan']); ?>">
                        <div class="form-group">
                            <label for="nama-jurusan" class="col-lg-3 control-label">Jurusan</label>
                            <div class="col-lg-5">
                                <input type="text" name="nama_jurusan" maxlength="100" class="form-control input-sm" placeholder="Nama Jurusan" value="<?php echo set_value('nama_jurusan', $result_jurusan['Nama_Jurusan']); ?>">
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>  
                        <div class="form-group">
                            <label for="singkatan-jurusan" class="col-lg-3 control-label"> Singkatan Jurusan</label>
                            <div class="col-lg-5">
                                <input type="text" name="singkatan_jurusan" maxlength="100" class="form-control input-sm" placeholder="Singkatan Jurusan" value="<?php echo set_value('singkatan_jurusan', $result_jurusan['Singkatan_Jurusan']); ?>">
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="warna-jurusan" class="col-lg-3 control-label">Warna Jurusan</label>
                            <div class="col-lg-5">
                                <select name="warna_jurusan" class="form-control input-sm" style="width: 150px;">
                                    <option></option>
                                    <option value="#FF0000" <?php echo set_value('warna_jurusan', $result_jurusan['Warna_Jurusan']) == '#FF0000' ? 'selected = "selected"' : '' ?>>Merah</option>
                                    <option value="#0000FF" <?php echo set_value('warna_jurusan', $result_jurusan['Warna_Jurusan']) == '#0000FF' ? 'selected = "selected"' : '' ?>>Biru</option>
                                    <option value="#A52A2A" <?php echo set_value('warna_jurusan', $result_jurusan['Warna_Jurusan']) == '#A52A2A' ? 'selected = "selected"' : '' ?>>Coklat</option>
                                    <option value="#808080" <?php echo set_value('warna_jurusan', $result_jurusan['Warna_Jurusan']) == '#808080' ? 'selected = "selected"' : '' ?>>Abu-Abu</option>
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