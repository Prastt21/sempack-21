<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>SEMPAK | Sistem Pengelolaan Administrasi Kemahasiswaan</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->
		<!--        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>-->
        <!-- bootstrap 3.0.2 -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="assets/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="assets/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="assets/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- Jquery Alert -->
        <link href="assets/css/alertify/alertify.core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/alertify/alertify.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="assets/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />
	</head>
	<body class="skin-blue">
        <header class="header">
            <a href="#" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                SEMPAKemahasiswaan
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <!--                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                                   <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </a>-->
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
						<li class="grey">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="icon-tasks"></i>
								Note Operator</span>
							</a>
						</li>
						<li class="grey">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="icon-tasks"></i>
								Nama Operator
							</a>
						</li>
						<li class="grey">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="icon-tasks"></i>
								Bantuan
							</a>
						</li>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $DATA_LOGIN['NAMA_LENGKAP'] != null ? $DATA_LOGIN['NAMA_LENGKAP'] : 'Nama'; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo base_url('assets/img/avatar3.png'); ?>" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $DATA_LOGIN['NAMA_LENGKAP'] != null ? $DATA_LOGIN['NAMA_LENGKAP'] : 'Nama'; ?>
                                        <small><?php echo $DATA_LOGIN['NAMA_LEVEL'] != null ? $DATA_LOGIN['NAMA_LEVEL'] : 'Level'; ?></small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo base_url('profil/user/' . $DATA_LOGIN['ID_PENGGUNA']); ?>" class="btn btn-default btn-flat">Profil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo base_url('autentifikasi/proses_logout'); ?>" class="btn btn-default btn-flat">Keluar</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
			<aside class="left-side sidebar-offcanvas">
				<!-- sidebar: style can be found in sidebar.less -->
				<section class="sidebar">
					<!-- Sidebar user panel -->
					<div class="user-panel">
						<div class="pull-left info">
							<p>Selamat Datang, Pengguna</p>
							<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
						</div>
					</div>
				<ul class="nav nav-list">
					<li class="active">
						<a href="#">
							<i class="icon-dashboard"></i>
							<span class="menu-text"> Dashboard </span>
						</a>
					</li>

					<li>
						<a href="#">
							<i class="icon-text-width"></i>
							<span class="menu-text"> Berita dan Informasi </span>
						</a>
					</li>
						
					<li>
						<a href="#" class="dropdown-toggle">
							<i class="icon-tag"></i>
							<span class="menu-text"> Submit Pendaftaran </span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu">
							<li>
								<a href="#">
									<i class="icon-double-angle-right"></i>
									Peminjaman Aula BSC
								</a>
							</li>
						</ul>
						<ul class="submenu">
							<li>
								<a href="#">
									<i class="icon-double-angle-right"></i>
									Pendaftaran Beasiswa
								</a>
							</li>
						</ul>
						<ul class="submenu">
							<li>
								<a href="#">
									<i class="icon-double-angle-right"></i>
									Pendaftaran Rujukan Asuransi
								</a>
							</li>
						</ul>
					</li>	
					
					<li>
						<a href="#" class="dropdown-toggle">
							<i class="icon-tag"></i>
							<span class="menu-text"> More Pages </span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu">
							<li>
								<a href="#">
									<i class="icon-double-angle-right"></i>
									Profil Pengguna
								</a>
							</li>
						</ul>
					</li>
				</ul><!--/.nav-list-->

				</section>
				<!-- /.sidebar -->
			</aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- isi dari konten -->
                Isinya
				<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
	</body>
</html>