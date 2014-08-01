<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<section class="content">    
    <div class="row">
        <div class="col-xs-8">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Berita Dan Informasi Terkini</h3>
                </div>
                <div class="box-body">
                        <table class="table" width="100%">
                            <tr>
                            <?php
                            if (isset($rs_pengumuman)) {                                
                                foreach ($rs_pengumuman as $dt_pengumuman):
                                    ?>
                                    <tr>                                        
                                        <td><?php echo $dt_pengumuman['Pengumuman_Sistem']; ?></td>
                                    </tr>
                                    <?php
                                endforeach;
                            }                            
                            ?>
                            </tr>                            
                        </table>
                    </div>
            </div><!-- /.box -->
        </div>
        <div class="col-xs-4">
            <div class="row">
                <div class="box box-info">
                    <div class="box-header">
                        <span class="box-title">Info Peminjaman Aula</span>
                    </div>
                    <div class="box-body">
                        <table class="table" width="100%">
                            <tr>
                            <?php
                            if (isset($rs_info_aula)) {                                
                                foreach ($rs_info_aula as $dt_info_aula):
                                    ?>
                                    <tr>                                        
                                        <td><?php echo $dt_info_aula['Judul_Info']; ?></td>
                                    </tr>
                                    <?php
                                endforeach;
                            }                            
                            ?>
                            </tr>                            
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="box box-info">
                    <div class="box-header">
                        <span class="box-title">Info Beasiswa</span>
                    </div>
                    <div class="box-body">
                        <table class="table" width="100%">
                            <tr>
                            <?php
                            if (isset($rs_info_beasiswa)) {                                
                                foreach ($rs_info_beasiswa as $dt_info_beasiswa):
                                    ?>
                                    <tr>                                        
                                        <td><?php echo $dt_info_beasiswa['Judul_Info']; ?></td>
                                    </tr>
                                    <?php
                                endforeach;
                            }                            
                            ?>
                            </tr>                            
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="box box-info">
                    <div class="box-header">
                        <span class="box-title">Info Rujukan Asuransi</span>
                    </div>
                    <div class="box-body">
                        <table class="table" width="100%">
                            <tr>
                            <?php
                            if (isset($rs_info_asuransi)) {                                
                                foreach ($rs_info_asuransi as $dt_info_asuransi):
                                    ?>
                                    <tr>                                        
                                        <td><?php echo $dt_info_asuransi['Judul_Info']; ?></td>
                                    </tr>
                                    <?php
                                endforeach;
                            }                            
                            ?>
                            </tr>                            
                        </table>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</section><!-- /.content -->
<div class="modal fade" id="modal-registrasi" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Registrasi</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" role="form" action="<?php echo base_url('dashboard_kasir/proses_registrasi'); ?>" id="form-modal" onsubmit="return false">
                    <input type="hidden" name="id_pelanggan" value="" id="text-id">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <p class="form-control-static">Masukkan jumlah modal untuk transaksi hari ini :</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-5">
                            <input name="modal" class="form-control input-sm" type="text" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- page script -->
