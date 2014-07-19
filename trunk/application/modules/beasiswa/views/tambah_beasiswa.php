<head>
    <!-- TinyMCE -->
    <script language="javascript" type="text/javascript" src="tinymcpuk-0.3/tiny_mce.js"></script>
    <script language="javascript" type="text/javascript">
        tinyMCE.init({
            mode : "textareas",//exact or textareas
            theme : "advanced",//simple
            plugins : "youtube,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,zoom,flash,searchreplace,print,paste,directionality,fullscreen,noneditable,contextmenu",
            theme_advanced_buttons1_add_before : "",
            theme_advanced_buttons1_add : "fontsizeselect",
            theme_advanced_buttons2_add : "preview,forecolor",
            theme_advanced_buttons2_add_before: "pastetext,pasteword,emotions,print,",
            theme_advanced_buttons3_add_before : "tablecontrols",
            theme_advanced_buttons3_add : "fullscreen",
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            theme_advanced_statusbar_location : "bottom",
            plugin_insertdate_dateFormat : "%Y-%m-%d",
            plugin_insertdate_timeFormat : "%H:%M:%S",
            extended_valid_elements : "hr[class|width|size|noshade]",
            file_browser_callback : "fileBrowserCallBack",
            paste_use_dialog : false,
            theme_advanced_resizing : true,
            theme_advanced_resize_horizontal : false,
            theme_advanced_link_targets : "_something=My somthing;_something2=My somthing2;_something3=My somthing3;",
            media_strict : false,
            apply_source_formatting : true
        });

        function fileBrowserCallBack(field_name, url, type, win) {
            var connector = "../../filemanager/browser.html?Connector=connectors/php/connector.php";
            var enableAutoTypeSelection = true;
		
            var cType;
            tinymcpuk_field = field_name;
            tinymcpuk = win;
		
            switch (type) {
                case "image":
                    cType = "Image";
                    break;
                case "flash":
                    cType = "Flash";
                    break;
                case "file":
                    cType = "File";
                    break;
            }
		
            if (enableAutoTypeSelection && cType) {
                connector += "&Type=" + cType;
            }
		
            window.open(connector, "tinymcpuk", "modal,width=600,height=400");
        }
    </script>
    <!-- /TinyMCE -->
</head>
<section class="content-header">
    <h1>
        Tambah Data
        <small>Tambah Data Rujukan Asuransi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Operator</li>
        <li class="active">Tambah Rujukan Asuransi</li>
    </ol>
    <!-- Main content -->
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-8">
            <div class="box box-primary">
                <div class="box-header"><h3 class="box-title">Data Rujukan Asuransi</h3></div>
                <div class="box-body">
                  
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="alert alert-error alert-dismissable" id="div-alert">
                                    <button class="close" aria-hidden="true" id="alert-close" type="button">×</button>
                                    <span id="alert-value"></span>
                                </div>
                            </div>
                        </div>
                    
                    <form class="form-horizontal" action="<?php echo base_url('rujukan_asuransi/tambah_rujukan_asuransi'); ?>" id="form-tambah-pengguna" method="post">
                        <div class="form-group">
                            <label for="jenis-asuransi" class="col-lg-3 control-label">Jenis Asuransi</label>
                            <div class="col-lg-5">
                                <select name="jenis_asuransi" class="form-control input-sm" style="width: 150px;">
                                    <option></option>
                                    <option value="Kecelakaan">Kecelakaan</option>
                                    <option value="Sakit">Sakit</option>                                    
                                </select>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="nama-perujuk" class="col-lg-3 control-label">Nama Perujuk</label>
                            <div class="col-lg-5">
                                <input type="text" name="nama_perujuk" maxlength="20" class="form-control input-sm" placeholder="Nama Perujuk">
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="nama-rs" class="col-lg-3 control-label">Nama Rumah Sakit</label>
                            <div class="col-lg-5">
                                <input type="text" name="nama_rs" maxlength="20" class="form-control input-sm" placeholder="Nama Rumah Sakit">
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="alamat-rs" class="col-lg-3 control-label">Alamat Rumah Sakit</label>
                            <div class="col-lg-5">
                                <textarea name="alamat_rs" maxlength="100" class="form-control input-sm" placeholder="Alamat Rumah Sakit"></textarea>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal-masuk" class="col-lg-3 control-label">Tanggal Masuk</label>
                            <div class="col-lg-5">
                                <div class="bfh-datepicker" data-name="tanggal_masuk" data-placeholder='tanggal' data-format="y-m-d" data-date="today"></div>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>  
                        <div class="form-group">
                            <label for="tanggal-keluar" class="col-lg-3 control-label">Tanggal Keluar</label>
                            <div class="col-lg-5">
                                <div class="bfh-datepicker" data-name="tanggal_keluar" data-placeholder='tanggal' data-format="y-m-d" data-date="today"></div>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="total-biaya" class="col-lg-3 control-label">Total Biaya</label>
                            <div class="col-lg-5">
                                <input type="text" name="total_biaya" maxlength="20" class="form-control input-sm" placeholder="Total Biaya">
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="santunan" class="col-lg-3 control-label">Santunan</label>
                            <div class="col-lg-5">
                                <input type="text" name="santunan" maxlength="20" class="form-control input-sm" placeholder="Santunan">
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