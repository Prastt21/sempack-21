<section class="content-header">
    <h1>
        Laporan Rujukan Asuransi
        <small>Data Rujukan Asuransi bulan <?php echo $bulan[$bulan_skr]; ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Laporan</li>
        <li class="active">Rujukan Asuransi</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-8">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <form class="form-inline" role="form" method="post" action="<?php echo base_url('laporan_asuransi/cari_data'); ?>">
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
                                <a href="<?php echo site_url('laporan_asuransi/download'); ?>" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Download</a>
                                <a href="<?php echo site_url('laporan_asuransi/cetak'); ?>" class="btn btn-default btn-sm"><i class="fa fa-print"></i> Cetak</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <td width="5%">No.</td>
                                        <td width="65%">Jenis Rujukan Asuransi</td>
                                        <td width="15%">Jumlah</td>
                                        <td width="15%">Total</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $rujukan_bulan_ini = 0;
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td colspan="2">Total Rujukan Asuransi KECELAKAAN Bulan sebelumnya</td>
                                        <td align="center"><b><?php echo $total_kecelakaan ?></b></td>
                                    </tr>
                                    
                                    <tr>
                                        <td></td>
                                        <td>Rujukan Asuransi KECELAKAAN Bulan Ini</td>
                                        <td align="center"><?php echo $total_kecelakaan_ini ?><b> </b></td>
                                        <td align="center"><b> </b></td>
                                    </tr>
                                    
                                    <tr>
                                        <td></td>
                                        <td colspan="2">Total Rujukan Asuransi SAKIT Bulan sebelumnya</td>
                                        <td align="center"><b> <?php echo $total_sakit ?></b></td>
                                    </tr>
                                    
                                    <tr>
                                        <td></td>
                                        <td>Rujukan Asuransi SAKIT Bulan Ini</td>
                                        <td align="center"><b> <?php echo $total_sakit_ini ?></b></td>
                                        <td align="center"><b> </b></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td align="center"><b>Jumlah</b></td>
                                        <td align="center"><b><?php echo $result_total ?> </b></td>
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
                                    <td colspan="2"><b>Rujukan Asuransi</b> </td>
                                </tr>
                                <tr>
                                    <td width="55%">Total Pengajuan Asuransi </td>
                                    <td width="45%"></td>
                                </tr>
                                <tr>
                                    <td>Total Transaksi </td>
                                    <td></td>
                                </tr>                                
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12" style="padding-top: 10px;">
                            <table border="0">
                                <tr>
                                    <td colspan="2"><b> Jumlah Asuransi Kecelakaan</b> </td>
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
                                    <td colspan="2"><b> Jumlah Asuransi Sakit</b> </td>
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