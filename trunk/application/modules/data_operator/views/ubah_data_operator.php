<section class="content-header">
    <h1>
        Ubah Data
        <small>Ubah Data Operator <?php echo $result_operator['Nama_Pengguna']; ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Operator</li>
        <li class="active">Tambah Operator</li>
    </ol>
    <!-- Main content -->
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-8">
            <div class="box box-primary">
                <div class="box-header"><h3 class="box-title">Data Operator</h3></div>
                <div class="box-body">
                    <!--template untuk notifikasi-->
                    <?php $this->load->view('templates/notification'); ?>
                    <form class="form-horizontal" action="<?php echo base_url('data_operator/proses_ubah_data_operator'); ?>" id="form-tambah-pengguna" method="post">
                        <input name="id_pengguna" type="hidden" value="<?php echo set_value('id_pengguna', $result_operator['Id_Pengguna']); ?>">
                        <div class="form-group">
                            <label for="kata-kunci" class="col-lg-3 control-label">Level Operator</label>
                            <div class="col-lg-5">
                                <select name="level" class="form-control input-sm" style="width: 150px;">
                                    <option></option>
                                    <?php
                                    if (isset($rs_level)):
                                        foreach ($rs_level as $dt_level):
                                            ?>
                                            <option value="<?php echo $dt_level['Id_Level']; ?>" <?php echo set_value('level', $result_operator['Id_Level']) == $dt_level['Id_Level'] ? 'selected = "selected"' : ''; ?>><?php echo $dt_level['Nama_Level']; ?></option>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="nama-operator" class="col-lg-3 control-label">Nama Operator</label>
                            <div class="col-lg-5">
                                <input type="text" name="nama_operator" maxlength="100" class="form-control input-sm" placeholder="Nama Operator" value="<?php echo set_value('nama_operator', $result_operator['Nama_Pengguna']); ?>">
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="status-operator" class="col-lg-3 control-label">Status Operator</label>
                            <div class="col-lg-5">
                                <select name="status" class="form-control input-sm" style="width: 150px;">
                                    <option></option>
                                    <option value="MAHASISWA" <?php echo set_value('status', $result_operator['Status_Pengguna']) == 'MAHASISWA' ? 'selected="selected"' : ''; ?>>Mahasiswa</option>
                                    <option value="KARYAWAN" <?php echo set_value('status', $result_operator['Status_Pengguna']) == 'KARYAWAN' ? 'selected="selected"' : ''; ?>>Karyawan</option>                                    
                                </select>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-lg-3 control-label">Username</label>
                            <div class="col-lg-5">
                                <input type="text" name="username" maxlength="20" class="form-control input-sm" placeholder="Username" value="<?php echo set_value('username', $result_operator['NIK_NIM']); ?>">
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="no-password" class="col-lg-3 control-label">Password</label>
                            <div class="col-lg-5">
                                <input type="password" name="password" maxlength="20" class="form-control input-sm" placeholder="Password" id="password" value="<?php echo set_value('password'); ?>">
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="no-password" class="col-lg-3 control-label">Ulangi Password</label>
                            <div class="col-lg-5">
                                <input type="password" name="ulangi_password" maxlength="20" class="form-control input-sm" placeholder="Ulangi Password" value="<?php echo set_value('ulangi_password'); ?>">
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="jenis-kelamin" class="col-lg-3 control-label">Jenis Kelamin</label>
                            <div class="col-lg-5">
                                <select name="jenis_kelamin" class="form-control input-sm" style="width: 150px;">
                                    <option></option>
                                    <option value="PRIA" <?php echo set_value('jenis_kelamin', $result_operator['Gender']) == 'PRIA' ? 'selected="selected"' : ''; ?>>Pria</option>
                                    <option value="WANITA" <?php echo set_value('jenis_kelamin', $result_operator['Gender']) == 'WANITA' ? 'selected="selected"' : ''; ?>>Wanita</option>                                    
                                </select>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="no-telephone" class="col-lg-3 control-label">No Telephone</label>
                            <div class="col-lg-5">
                                <input type="text" name="telephone" maxlength="20" class="form-control input-sm" placeholder="Telephone" value="<?php echo set_value('telephone', $result_operator['No_Telp']); ?>">
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="col-lg-3 control-label">Alamat</label>
                            <div class="col-lg-5">
                                <textarea name="alamat" class="form-control" placeholder="Alamat Operator"><?php echo set_value('alamat', $result_operator['Alamat']); ?></textarea>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="tempat-lahir" class="col-lg-3 control-label">Tempat Lahir</label>
                            <div class="col-lg-5">
                                <input type="text" name="tempat_lahir" style="width: 150px;" maxlength="15" class="form-control input-sm" placeholder="Tempat Lahir" value="<?php echo set_value('tempat_lahir', $result_operator['Tempat_Lahir']); ?>">
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal-lahir" class="col-lg-3 control-label">Tanggal Lahir</label>
                            <div class="col-lg-5">
                                <div class="bfh-datepicker" data-name="tanggal" data-placeholder='tanggal' data-format="y-m-d" data-date="<?php echo set_value('tanggal', $result_operator['Tanggal_Lahir']); ?>"></div>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-lg-3 control-label">Email Operator</label>
                            <div class="col-lg-5">
                                <input type="text" name="email" maxlength="100" class="form-control input-sm" placeholder="Email Operator" value="<?php echo set_value('email', $result_operator['Email']); ?>">
                            </div>
                            <div class="col-lg-3"></div>
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