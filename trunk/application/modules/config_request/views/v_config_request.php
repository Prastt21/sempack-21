<?php
	
	if(isset($_POST['simpan'])){
		$this->sistem->update_request_sistem($_POST['status_request'],$_POST['hapus_request']);
		echo '<script type="text/javascript">jAlert("<center>Konfigurasi tersimpan.</center>", "Informasi", function(r) {
				if(r == true) {
						window.location.replace(base+"config_request/v_config_request");
				}
		});</script>';
	}

	if($sistem->StatusRequest_Sistem == "AKTIF"){
		$statusaktif = "selected";
	} else {
		$statusaktif2 = "selected";
	}
?>
<section class="content-header">
    <h1>
        Konfigurasi Request Pengguna
        <small>Optimasi Request Pengguna</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Operator</li>
        <li class="active">Konfigurasi Request Pengguna</li>
    </ol>
    <!-- Main content -->
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-8">
            <div class="box box-primary">
                <div class="box-header"><h3 class="box-title">Konfigurasi Request Pengguna</h3></div>
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
                            <label for="status-request" class="col-lg-3 control-label">Status Request</label>
                            <div class="col-lg-5">
                                <select name="status_request" class="form-control input-sm" value="<?php echo $sistem->StatusRequest_Sistem; ?>" style="width: 150px;">
                                    <option></option>
                                    <option value="AKTIF" <?php echo @$statusaktif; ?> >AKTIF </option>
                                    <option value="TIDAK AKTIF"  <?php echo @$statusaktif2; ?> >TIDAK AKTIF</option>
                                </select>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>                        
                        <div class="form-group">
                            <label for="hapust-request" class="col-lg-3 control-label">Hapus Request Otomatis </label>
                            <div class="col-lg-5">
                                <input type="text" name="hapus_request" maxlength="20" class="form-control input-sm" placeholder="Hapus Request">
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
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>