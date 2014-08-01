<head>
    <!-- TinyMCE -->
    <script language="javascript" type="text/javascript" src="<? echo base_url(); ?>assets/js/tinymcpuk-0.3/tiny_mce.js"></script>
    <script language="javascript" type="text/javascript">
        tinyMCE.init({
            mode: "textareas", //exact or textareas
            theme: "advanced", //simple
            plugins: "youtube,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,zoom,flash,searchreplace,print,paste,directionality,fullscreen,noneditable,contextmenu",
            theme_advanced_buttons1_add_before: "",
            theme_advanced_buttons1_add: "fontsizeselect",
            theme_advanced_buttons2_add: "preview,forecolor",
            theme_advanced_buttons2_add_before: "pastetext,pasteword,emotions,print,",
            theme_advanced_buttons3_add_before: "tablecontrols",
            theme_advanced_buttons3_add: "fullscreen",
            theme_advanced_toolbar_location: "top",
            theme_advanced_toolbar_align: "left",
            theme_advanced_statusbar_location: "bottom",
            plugin_insertdate_dateFormat: "%Y-%m-%d",
            plugin_insertdate_timeFormat: "%H:%M:%S",
            extended_valid_elements: "hr[class|width|size|noshade]",
            file_browser_callback: "fileBrowserCallBack",
            paste_use_dialog: false,
            theme_advanced_resizing: true,
            theme_advanced_resize_horizontal: false,
            theme_advanced_link_targets: "_something=My somthing;_something2=My somthing2;_something3=My somthing3;",
            media_strict: false,
            apply_source_formatting: true
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
        <small>Tambah Data Informasi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Operator</li>
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
                    <?php $this->load->view('templates/notification'); ?>
                    <form class="form-horizontal" action="<?php echo base_url('data_informasi/proses_tambah_data_informasi'); ?>" id="form-tambah-pengguna" method="post">
                        <div class="form-group">
                            <label for="judul-informasi" class="col-lg-3 control-label">Judul</label>
                            <div class="col-lg-5">
                                <input type="text" name="judul_informasi" maxlength="100" class="form-control input-sm" placeholder="Judul Informasi" value="<?php echo set_value('judul_informasi', ''); ?>">
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="isi-informasi" class="col-lg-3 control-label">Isi Informasi</label>
                            <div class="col-lg-5">
                                <textarea name="isi_informasi" maxlength="100" class="form-control input-sm" placeholder="Isi Informasi"><?php echo set_value('isi_informasi', ''); ?></textarea>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>
                        <div class="form-group">
                            <label for="jenis-informasi" class="col-lg-3 control-label">Jenis Informasi</label>
                            <div class="col-lg-5">
                                <select name="jenis" class="form-control input-sm" style="width: 150px;">
                                    <option></option>
                                    <option value="Aula" <?php echo set_value('jenis') == 'Aula' ? 'selected = "selected"' : '' ?>>Aula</option>
                                    <option value="Beasiswa" <?php echo set_value('jenis') == 'Beasiswa' ? 'selected = "selected"' : '' ?>>Beasiswa</option>
                                    <option value="Asuransi" <?php echo set_value('jenis') == 'Asuransi' ? 'selected = "selected"' : '' ?>>Asuransi</option>
                                </select>
                            </div>
                            <div class="col-lg-3"><small><em>Harus diisi!</em></small></div>
                        </div>

                        <div class="form-group">
                            <label for="tanggal-informasi" class="col-lg-3 control-label">Tanggal Informasi</label>
                            <div class="col-lg-5">
                                <div class="bfh-datepicker" data-name="tanggal" data-placeholder='tanggal' data-format="y-m-d" data-date="today"></div>
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
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>