<?php
	
	if(isset($_POST['simpan'])){
		$this->sistem->update_pengumuman($_POST['pengumuman_admin']);
		echo '<script type="text/javascript">jAlert("<center>Data tersimpan.</center>", "Informasi", function(r) {
				if(r == true) {
						window.location.replace(base+"config_sistem/v_config_sistem");
				}
		});</script>';
	}
?>

<section class="content-header">
    <h1>
        Pengumuman Admin
        <small>Konfigurasi Pengumuaman</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Admin</li>
        <li class="active">Konfigurasi Pengumuaman</li>
    </ol>
    <!-- Main content -->
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-8">
            <div class="box box-primary">
                <div class="box-header"><h3 class="box-title">Konfigurasi Pengumuaman</h3></div>
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
                            <label for="pengumuman-admin" class="col-lg-3 control-label">Pengumuman Admin</label>
                            <div class="col-lg-5">
                                <textarea name="pengumuman-admin" maxlength="100" class="form-control input-sm" placeholder="Pengumuman Admin"><?php echo $sistem->Pengumuman_; ?></textarea>
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
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>