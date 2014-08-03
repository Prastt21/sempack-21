<section class="content-header">
    <h1>
        Laporan Pendaftaran Beasiswa
        <small>Data Pendaftaran Beasiswa bulan <?php echo $bulan[$bulan_skr]; ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Laporan</li>
        <li class="active">Pendaftaran Beasiswa</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-8">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <form class="form-inline" role="form" method="post" action="<?php echo base_url('laporan_beasiswa/cari_data'); ?>">
                                <select class="form-control input-sm" name="bulan">
                                    <?php foreach ($bulan as $key => $nama_bulan) : ?>
                                        <option value="<?php echo $key; ?>"<?php echo $key == $bulan_skr ? 'selected="selected"' : ''; ?>><?php echo $nama_bulan; ?></option>';
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                                <select class="form-control input-sm" name="tahun">
                                    <?php foreach ($tahun as $nama_tahun) : ?>
                                        <option value="<?php echo $nama_tahun['tahun']; ?>"<?php echo $nama_tahun['tahun'] == $tahun_skr ? 'selected="selected"' : ''; ?>><?php echo $nama_tahun['tahun']; ?></option>';
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                                <button type="submit" class="btn btn-default btn-sm" name="cari" value="Cari">Pilih</button>
                                <button type="submit" class="btn btn-default btn-sm" name="cari" value="reset">Reset</button>
                            </form>
                        </div>
                        <div class="col-xs-2">
                            <!--                            kosoong-->
                        </div>
                        <div class="col-xs-4">
                            <div class="btn-group">
                                <a href="<?php echo site_url('laporan_beasiswa/download'); ?>" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Download</a>
                                <a href="<?php echo site_url('laporan_beasiswa/cetak'); ?>" class="btn btn-default btn-sm"><i class="fa fa-print"></i> Cetak</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <td width="5%">No.</td>
                                        <td width="65%">Jenis Beasiswa</td>
                                        <td width="15%">Jumlah</td>
                                        <td width="15%">Total Keseluruhan</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $rujukan_bulan_ini = 0;
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td colspan="2">Total Beasiswa PPA Bulan sebelumnya</td>
                                        <td align="right"><b></b></td>
                                    </tr>
                                    
                                    <tr>
                                        <td></td>
                                        <td>Beasiswa PPA Bulan Ini</td>
                                        <td align="right"><b> </b></td>
                                        <td align="right"><b> </b></td>
                                    </tr>
                                    
                                    <tr>
                                        <td></td>
                                        <td colspan="2">Total Beasiswa BBP/PPA Bulan sebelumnya</td>
                                        <td align="right"><b></b></td>
                                    </tr>
                                    
                                    <tr>
                                        <td></td>
                                        <td>Beasiswa BBP/PPA Bulan Ini</td>
                                        <td align="right"><b> </b></td>
                                        <td align="right"><b> </b></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="2">Total Beasiswa Muamalat Bulan sebelumnya</td>
                                        <td align="right"><b></b></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Beasiswa Muamalat Bulan Ini</td>
                                        <td align="right"><b> </b></td>
                                        <td align="right"><b> </b></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td align="right"><b> </b></td>
                                        <td align="left"><b>1000000 </b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="box box-info">
                <div class="box-body">
                    <h4>Statistik</h4>
                    <div class="row">
                        <div class="col-xs-12">
                            <table border="0">
                                <tr>
                                    <td colspan="2"><b>Pendaftaran Beasiswa</b> </td>
                                </tr>
                                <tr>
                                    <td width="55%">Total Pendaftaran Beasiswa </td>
                                    <td width="45%"></td>
                                </tr>
                                <tr>
                                    <td>Total Pendaftaran </td>
                                    <td></td>
                                </tr>                                
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12" style="padding-top: 10px;">
                            <table border="0">
                                <tr>
                                    <td colspan="2"><b> Jumlah Pendaftaran Beasiswa PPA</b> </td>
                                </tr>
                                <tr>
                                    <td width="65%">Total Waiting </td>
                                    <td width="35%"></td>
                                </tr>
                                <tr>
                                    <td width="65%">Total Terverifikasi </td>
                                    <td width="35%"></td>
                                </tr>                                
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12" style="padding-top: 10px;">
                            <table border="0">
                                <tr>
                                    <td colspan="2"><b> Jumlah Pendaftaran Beasiswa BBP/PPA</b> </td>
                                </tr>
                                <tr>
                                    <td width="65%">Total Waiting </td>
                                    <td width="35%"></td>
                                </tr>
                                <tr>
                                    <td width="65%">Total Terverifikasi </td>
                                    <td width="35%"></td>
                                </tr>                                
                            </table>
                        </div>
                        <div class="col-xs-12" style="padding-top: 10px;">
                            <table border="0">
                                <tr>
                                    <td colspan="2"><b> Jumlah Pendaftaran Beasiswa Muamalat</b> </td>
                                </tr>
                                <tr>
                                    <td width="65%">Total Waiting </td>
                                    <td width="35%"></td>
                                </tr>
                                <tr>
                                    <td width="65%">Total Terverifikasi </td>
                                    <td width="35%"></td>
                                </tr>                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.content -->