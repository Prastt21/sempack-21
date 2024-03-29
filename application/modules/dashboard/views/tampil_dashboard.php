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
                    <h3 class="box-title">Statistik Operasional Sistem</h3>
                </div>
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" data-identifier="gharian">Harian</a></li>
                        <li><a href="#tab_2" data-toggle="tab" data-identifier="gbulanan">Bulanan</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab_1">
                            <div class="box-body chart-responsive">
                                <div class="chart" id="line-chart-1" style="height: 310px;"></div>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane fade" id="tab_2">
                            <div class="box-body chart-responsive">
                                <div class="chart" id="line-chart-2" style="height: 310px;"></div>
                            </div><!-- /.box-body -->
                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div><!-- nav-tabs-custom -->
                <div class="overlay loading-process"></div>
                <div class="loading-img loading-process"></div>
            </div><!-- /.box -->
        </div>        
        <div class="col-xs-4">
            <div class="row">
                <div class="box box-info">
                    <div class="box-header">
                        <span class="box-title">Pengumuman Sistem</span>
                    </div>
                    <div class="box-body">
                        <table class="table" width="100%">
                            <tr>
                            <tr>                                        
                                <td><?php echo $rs_pengumuman['Pengumuman_Sistem']; ?></td>
                            </tr>
                            </tr>                            
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="box box-info">
                    <div class="box-header">
                        <span class="box-title">Chat Request</span>
                    </div>
                    <div class="box-body">
                        <table class="table" width="100%">
                            <tr>
                            <tr>                                        
                                <td align="center"><a href="ymsgr:sendim?prastt21" target="_blank"><img src="http://opi.yahoo.com/online?u=prastt21&amp;m=g&amp;t=14" /></a><br /></td>
                            </tr>
                            </tr>                            
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="box box-info">
                    <div class="box-header">
                        <span class="box-title">Login Terakhir User</span>
                    </div>
                    <div class="box-body">
                        <table class="table" width="100%">
                            <?php
                            if (isset($rs_last_login)) {
                                foreach ($rs_last_login as $dt_login) {
                                    ?>
                                    <tr>                                        
                                        <td><?php echo $dt_login['Nama_Pengguna']; ?></td>
                                    </tr> 
                                    <?php
                                }
                            }
                            ?>
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
