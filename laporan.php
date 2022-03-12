<?php
	ob_start();
	include ("dataconn.php");
	if (!(isset($_SESSION['loginadmin']) && $_SESSION['loginadmin'] != '')) {

	header ("Location: login.php");

	}
	$sess_id=$_SESSION["loginadmin"];
	$result=mysql_query("select * from Penyelenggara where Penyelenggara_ID=$sess_id");
	$row=mysql_fetch_assoc($result);
	
	$result_maintenance=mysql_query("select count(*) as total from penyelenggaraan");
	$count_maintenance=mysql_fetch_assoc($result_maintenance);
	
	$result_customer=mysql_query("select count(*) as total from pelanggan");
	$count_customer=mysql_fetch_assoc($result_customer);
	
	$result_notification=mysql_query("select count(*) as total from notifikasi");
	$count_notification=mysql_fetch_assoc($result_notification);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Laporan Bulanan</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    <link href="dist/css/Admin.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
	<script language="javascript" type="text/javascript" src="bootstrap/js/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="bootstrap/js/jquery.validate.min.js"></script>
    <link rel="shortcut icon" href="dist/img/icon.png">
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b><?php if ($row["Penyelenggara_Admin"]==1){echo "Admin";} else {echo "";} ?></b>SPPR</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="admin.php" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="dist/img/<?php echo $row["Penyelenggara_Imej"]; ?>" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo $row["Penyelenggara_Nama"]; ?></span>
                </a>
              </li>
			  <li class="dropdown user user-menu">
				<a href="logout.php" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="hidden-xs">Log Keluar</span>
                </a>
			  </li>

            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <a href="admin.php">
			<div class="user-panel">
				<div class="pull-left image">
				  <img src="dist/img/<?php echo $row["Penyelenggara_Imej"]; ?>" class="img-circle" alt="User Image" />
				</div>
				<div class="pull-left info">
				  <p><?php echo $row["Penyelenggara_Nama"]; ?></p>
				</div>
			</div>
		  </a>
          <!-- search form -->
          <form action="carian.php" method="post" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="query" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">NAVIGASI UTAMA</li>
            <li>
              <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Menu Utama</span>
              </a>
            </li>
            <li>
              <a href="senarai.php">
                <i class="fa fa-files-o"></i>
                <span>Senarai Penyelenggaraan</span>
                <span class="label label-primary pull-right"><?php echo $count_maintenance['total']; ?></span>
              </a>
            </li>
            
			<li>
              <a href="baru.php">
                <i class="fa fa-th"></i> <span>Penyelenggaraan Baru</span> <small class="label pull-right bg-green">baru</small>
              </a>
            </li>
			<?php if ($row["Penyelenggara_Admin"]==1)
			{
			?>
			<li>
              <a href="senaraipelanggan.php">
                <i class="fa fa-pie-chart"></i>
				<span>Senarai Pelanggan</span>
                <span class="label pull-right bg-yellow"><?php echo $count_customer['total']; ?></span>
              </a>
            </li>
			<?php
			}
			else {echo "";}
			?>
			<?php if ($row["Penyelenggara_Admin"]==1)
			{
			?>
			<li>
              <a href="senarainotifikasi.php">
                <i class="fa fa-folder"></i> <span>Notifikasi</span>
              </a>
            </li>
			<?php
			}
			else {echo "";}
			?>
            
            <li>
              <a href="maklumbalas.php">
                <i class="fa fa-envelope"></i> <span>Maklum Balas</span>
                <small class="label pull-right bg-yellow"></small>
              </a>
            </li>
			<li>
              <a href="terdekat.php">
                <i class="fa fa-calendar"></i> <span>Jadual Terdekat</span>
                <small class="label pull-right bg-red"><?php echo $count_maintenance['total']; ?></small>
              </a>
            </li>
			<li class="active">
              <a href="laporan.php">
                <i class="fa fa-book"></i> <span>Laporan</span>
                <small class="label pull-right bg-yellow"></small>
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Panel Kawalan</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Utama</a></li>
            <li class="active">Laporan</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $count_maintenance['total']; ?> aktiviti</h3>
                  <p>Senarai penyelenggaraan</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="senarai.php" class="small-box-footer">Info lanjut <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
             <div class="small-box bg-green">
                <div class="inner">
                  <h4>Maklumbalas</h4>
                  <p>Hantar maklumbalas kepada admin</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="maklumbalas.php" class="small-box-footer">Info lanjut <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>Jadual</h3>
                  <p>Jadual aktiviti terdekat</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="terdekat.php" class="small-box-footer">Info lanjut <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>Tambah</h3>
                  <p>Penyelenggaraan baru</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="baru.php" class="small-box-footer">Info lanjut <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
              <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                  <li class="pull-left header"><i class="fa fa-book"></i> Laporan Bulanan</li>
                </ul>
                <div class="tab-content no-padding">
                  <div class="chart tab-pane active" id="revenue-chart" style="position: relative;">
					<!--<h3 style="text-align:center;">Kosong</h3>-->
					
					<!--CONTENT-->
		<div class="box box-info" >
                <div class="box-header">
                </div>
				<div style="padding:75px;">
                <div class="box-body">
                  <form action="laporan.php" method="post" name="laporan" id="laporan" style="text-align:center;">
                    <div class="form-group">
						Sila pilih bulan: 	<select name="bulan" id="bulan" class="required">
												<option value="">Sila pilih</option>
												<option value="1">Januari</option>
												<option value="2">Februari</option>
												<option value="3">Mac</option>
												<option value="4">April</option>
												<option value="5">Mei</option>
												<option value="6">Jun</option>
												<option value="7">Julai</option>
												<option value="8">Ogos</option>
												<option value="9">September</option>
												<option value="10">Oktober</option>
												<option value="11">November</option>
												<option value="12">Disember</option>
											</select>
                    </div>
					<div class="form-group">
						Sila pilih tahun: 	<select name="tahun" id="tahun" class="required">
												<option value="">Sila pilih</option>
												<option value="2013">2013</option>
												<option value="2014">2014</option>
												<option value="2015">2015</option>
											</select>
                    </div>
					<div class="box-footer clearfix">
					  <input type="submit" name="submitbtn" class="btn btn-sm btn-info btn-flat pull-right" value="Hantar" style="margin-right:440px;"/>
					</div>
				</form>
				<h3 style="text-align:center;">atau</h3>
				<p><br/></p>
				<form action="laporan.php" method="post" name="laporanpenyelenggara" id="laporanpenyelenggara" style="text-align:center;">
					<div class="form-group">
						Penyelenggara: <select list="penyelenggara" name="penyelenggara" style="" class="required">
									<option value="" selected>Sila pilih penyelenggara</option>
									<option value="PCCM/TM">PCCM/TM</option>
									<option value="Other/TM">Other/TM</option>
									<option value="Numix">Numix</option>
									<option value="TSGN">TSGN</option>
									<option value="TM">TM</option>
									<option value="GITN">GITN</option>
									<option value="Others">Others</option>
								</select>
                    </div>
					<div class="box-footer clearfix">
					  <input type="submit" name="submitbtn2" class="btn btn-sm btn-info btn-flat pull-right" value="Hantar" style="margin-right:440px;"/>
					</div>
				</form>
                </div>
              </div>
		</div>
					<!-- ./CONTENT-->
					
				  </div>
                </div>
              </div><!-- /.nav-tabs-custom -->  
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Versi</b> 1.0
        </div>
        <strong>Hakcipta Terpelihara &copy; 2015 <a href="#">GITN CSC</a>.</strong>
      </footer>
      
      
      
    </div><!-- ./wrapper -->
  </body>
</html>

		<?php
			if(isset($_POST["submitbtn"]))
			{
				$month=$_POST["bulan"];
				$year=$_POST["tahun"];
				$query="select * from penyelenggaraan where MONTH(Penyelenggaraan_Tarikh)=".$month." and YEAR(Penyelenggaraan_Tarikh)=".$year;
				$result_report=mysql_query($query);
				if(mysql_num_rows($result_report))
				{
					header("refresh:0.1; url=laporanbulanan.php?month=$month&year=$year");
				}
				else
				{
					echo '<script language="javascript">';
					echo 'alert("Tiada sebarang penyelenggaraan dilakukan pada tempoh tersebut.")';
					echo '</script>';
				}
			}
			
			if(isset($_POST["submitbtn2"]))
			{
				$penyelenggara=$_POST["penyelenggara"];
				$query="select * from penyelenggaraan where Penyelenggaraan_Penyelenggara='$penyelenggara'";
				$result_report=mysql_query($query);
				if(mysql_num_rows($result_report))
				{
					header("refresh:0.1; url=laporanpenyelenggara.php?name=$penyelenggara");
				}
				else
				{
					echo '<script language="javascript">';
					echo 'alert("Tiada sebarang penyelenggaraan dilakukan oleh penyelenggara tersebut.")';
					echo '</script>';
				}
			}
		?>