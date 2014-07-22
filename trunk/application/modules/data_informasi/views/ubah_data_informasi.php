<section class="content-header">
    <h1>
        Ubah Data
        <small>Ubah Data Informasi <?php echo $result_informasi['Judul_Info']; ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Informasi</li>
        <li class="active">Tambah Informasi</li>
    </ol>
    <!-- Main content -->
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-8">
            <div class="box box-primary">
                <div class="box-header"><h3 class="box-title">Data Informasi</h3></div>
                <div class="box-body">
                    <!--load template notifikasi-->
                    <?php $this->load->view('templates/notification'); ?>
                    <form class="form-horizontal" action="<?php echo base_url('data_informasi/proses_ubah_data_informasi'); ?>" id="form-tambah-pengguna" method="post">
                        <input type="hidden" name="id_informasi" value="<?php echo set_value('id_informasi', $result_informasi['Id_Informasi']); ?>">
                        <div class="form-group">
                            <label for="judul-informasi" class="col-lg-3 control-label">Judul</label>
                            <div class="col-lg-5">
                                <input type="text" name="judul_informasi" maxlength="100" class="form-control input-sm" placeholder="Judul Informasi" value="<?php echo set_value('judul_informasi', $result_informasi['Judul_Info']); ?>">
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="isi-informasi" class="col-lg-3 control-label">Isi Informasi</label>
                            <div class="col-lg-5">
                                <textarea name="isi_informasi" maxlength="100" class="form-control input-sm" placeholder="Isi Informasi"><?php echo set_value('isi_informasi', $result_informasi['Isi_Info']); ?></textarea>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="jenis-informasi" class="col-lg-3 control-label">Jenis Informasi</label>
                            <div class="col-lg-5">
                                <select name="jenis" class="form-control input-sm" style="width: 150px;">
                                    <option></option>
                                    <option value="Aula" <?php echo set_value('jenis', $result_informasi['Jenis_Info']) == 'Aula' ? 'selected = "selected"' : '' ?>>Aula</option>
                                    <option value="Beasiswa" <?php echo set_value('jenis', $result_informasi['Jenis_Info']) == 'Beasiswa' ? 'selected = "selected"' : '' ?>>Beasiswa</option>
                                    <option value="Asuransi" <?php echo set_value('jenis', $result_informasi['Jenis_Info']) == 'Asuransi' ? 'selected = "selected"' : '' ?>>Asuransi</option>
                                </select>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>

                        <div class="form-group">
                            <label for="tanggal-informasi" class="col-lg-3 control-label">Tanggal Informasi</label>
                            <div class="col-lg-5">
                                <div class="bfh-datepicker" data-name="tanggal" data-placeholder='tanggal' data-format="y-m-d" data-date="<?php echo set_value('tanggal', $result_informasi['Tanggal_info']); ?>"></div>
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