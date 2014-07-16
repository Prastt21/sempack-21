<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left info">
                <p>Assalamu'alaikum, <?php echo $DATA_LOGIN['Nama_Pengguna']; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <?php echo isset($TPL_SIDE_MENU) ? $TPL_SIDE_MENU : 'Menu belum di-load'; ?>
    </section>
    <!-- /.sidebar -->
</aside>
