<?php
	ob_start();
	include ("dataconn.php");
	if (!(isset($_SESSION['loginadmin']) && $_SESSION['loginadmin'] != '')) {

	header ("Location: login.php");

	}
	$sess_id=$_SESSION["loginadmin"];
	$result=mysql_query("select * from Penyelenggara where Penyelenggara_ID=$sess_id");
	$row=mysql_fetch_assoc($result);
	
	$mid=$_REQUEST["mid"];
	$result_maintenance=mysql_query("select * from penyelenggaraan where Penyelenggaraan_ID='$mid'");
	$row_maintenance=mysql_fetch_assoc($result_maintenance);
	
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
    <title>Tukar Butiran Penyelenggaraan</title>
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
            <li class="active">
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
            <li>
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
            <li class="active">Butiran Penyelenggaraan</li>
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
                  <li class="pull-left header"><i class="fa fa-pie-chart"></i> Butiran Penyelenggaraan</li>
                </ul>
                <div class="tab-content no-padding">
                  <div class="chart tab-pane active" id="revenue-chart" style="position: relative;">
					<!--<h3 style="text-align:center;">Kosong</h3>-->
					
					<!--CONTENT-->
				<div class="box box-info">
						<div class="box-header">
						</div>
				<div style="padding:75px;">
					<div class="box-body">
							<form action="#" method="post" style="align:justify;">
								<div class="form-group">
									ID Penyelenggaraan <span style="margin-left:25px">: <?php echo "MW";printf('%05d',$row_maintenance["Penyelenggaraan_ID"]); ?></span>
								</div>
								<div class="form-group">
									Nombor Rujukan <span style="margin-left:43px">: <input type="text" name="rujukan" id="rujukan" value="<?php echo $row_maintenance["Penyelenggaraan_Rujukan"]; ?>"/></span>
								</div>
								<div class="form-group">
									Status <span style="width:15%;margin-left:102px;">: 
										<select list="status" name="status" style="" class="required">
											<option value="">Sila pilih status</option>
											<option value="Biasa(Normal)" <?php if($row_maintenance["Penyelenggaraan_Status"]=="Biasa(Normal)"){echo "selected";} ?>>Biasa(Normal)</option>
											<option value="Segera(Urgent)" <?php if($row_maintenance["Penyelenggaraan_Status"]=="Segera(Urgent)"){echo "selected";} ?>>Segera(Urgent)</option>
											<option value="Tunda(Reschedule)" <?php if($row_maintenance["Penyelenggaraan_Status"]=="Tunda(Reschedule)"){echo "selected";} ?>>Tunda(Reschedule)</option>
											<option value="Batal(Cancel)" <?php if($row_maintenance["Penyelenggaraan_Status"]=="Batal(Cancel)"){echo "selected";} ?>>Batal(Cancel)</option>
										</select></span>
								</div>
								<div class="form-group">
									Tarikh <span style="margin-left:106px">: <input type="date" name="tarikh" id="tarikh" value="<?php echo $row_maintenance["Penyelenggaraan_Tarikh"]; ?>"/></span>
								</div>
								<div class="form-group">
									Lokasi <span style="margin-left:103px">: 
															<select list="lokasi" name="lokasi" style="width:20%;" class="required">
																	<option value="">Sila pilih lokasi</option>
																	<option value="Kuala Lumpur" <?php if($row_maintenance["Penyelenggaraan_Lokasi"]=="Kuala Lumpur"){echo "selected";} ?>>Kuala Lumpur</option>
																	<option value="Johor" <?php if($row_maintenance["Penyelenggaraan_Lokasi"]=="Johor"){echo "selected";} ?>>Johor</option>
																	<option value="Melaka" <?php if($row_maintenance["Penyelenggaraan_Lokasi"]=="Melaka"){echo "selected";} ?>>Melaka</option>
																	<option value="Negeri Sembilan" <?php if($row_maintenance["Penyelenggaraan_Lokasi"]=="Negeri Sembilan"){echo "selected";} ?>>Negeri Sembilan</option>
																	<option value="Putrajaya" <?php if($row_maintenance["Penyelenggaraan_Lokasi"]=="Putrajaya"){echo "selected";} ?>>Putrajaya</option>
																	<option value="Selangor" <?php if($row_maintenance["Penyelenggaraan_Lokasi"]=="Selangor"){echo "selected";} ?>>Selangor</option>
																	<option value="Pahang" <?php if($row_maintenance["Penyelenggaraan_Lokasi"]=="Pahang"){echo "selected";} ?>>Pahang</option>
																	<option value="Perak" <?php if($row_maintenance["Penyelenggaraan_Lokasi"]=="Perak"){echo "selected";} ?>>Perak</option>
																	<option value="Terengganu" <?php if($row_maintenance["Penyelenggaraan_Lokasi"]=="Terengganu"){echo "selected";} ?>>Terengganu</option>
																	<option value="Kelantan" <?php if($row_maintenance["Penyelenggaraan_Lokasi"]=="Kelantan"){echo "selected";} ?>>Kelantan</option>
																	<option value="Penang" <?php if($row_maintenance["Penyelenggaraan_Lokasi"]=="Penang"){echo "selected";} ?>>Penang</option>
																	<option value="Kedah" <?php if($row_maintenance["Penyelenggaraan_Lokasi"]=="Kedah"){echo "selected";} ?>>Kedah</option>
																	<option value="Perlis" <?php if($row_maintenance["Penyelenggaraan_Lokasi"]=="Perlis"){echo "selected";} ?>>Perlis</option>
																	<option value="Sarawak" <?php if($row_maintenance["Penyelenggaraan_Lokasi"]=="Sarawak"){echo "selected";} ?>>Sarawak</option>
																	<option value="Sabah" <?php if($row_maintenance["Penyelenggaraan_Lokasi"]=="Sabah"){echo "selected";} ?>>Sabah</option>
															</select></span>
								</div>
								<div class="form-group">
									Aktiviti <span style="margin-left:99px">: <input type="text" name="aktiviti" id="aktiviti" style="width:50%;" value="<?php echo $row_maintenance["Penyelenggaraan_Aktiviti"]; ?>"/></span>
								</div>
								<div class="form-group">
								Penyelenggara <span style="margin-left:50px;">:
								<select list="penyelenggara" name="penyelenggara" class="required">
									<option value="" selected>Sila pilih penyelenggara</option>
									<option value="PCCM/TM" <?php if($row_maintenance["Penyelenggaraan_Penyelenggara"]=="PCCM/TM"){echo "selected";} ?>>PCCM/TM</option>
									<option value="Other/TM" <?php if($row_maintenance["Penyelenggaraan_Penyelenggara"]=="Other/TM"){echo "selected";} ?>>Other/TM</option>
									<option value="Numix" <?php if($row_maintenance["Penyelenggaraan_Penyelenggara"]=="Numix"){echo "selected";} ?>>Numix</option>
									<option value="TSGN" <?php if($row_maintenance["Penyelenggaraan_Penyelenggara"]=="TSGN"){echo "selected";} ?>>TSGN</option>
									<option value="TM" <?php if($row_maintenance["Penyelenggaraan_Penyelenggara"]=="TM"){echo "selected";} ?>>TM</option>
									<option value="GITN" <?php if($row_maintenance["Penyelenggaraan_Penyelenggara"]=="GITN"){echo "selected";} ?>>GITN</option>
									<option value="Others" <?php if($row_maintenance["Penyelenggaraan_Penyelenggara"]=="Others"){echo "selected";} ?>>Others</option>
								</select>
								</div>
					</div>
                </div>
				</div>
				<div class="box-footer clearfix">
					<a href="butiran.php?mid=<?php echo $row_maintenance["Penyelenggaraan_ID"]; ?>" class="btn btn-sm btn-info btn-flat pull-right" style="margin-right:550px;">Batal</a>
					<input type="submit" class="btn btn-sm btn-info btn-flat pull-right" style="margin-right:200px;" value="Simpan maklumat" name="submitbtn"/>
                </div>
							</form>
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
					$date=$_POST["tarikh"];
					$status=$_POST["status"];
					$reference=$_POST["rujukan"];
					$location=$_POST["lokasi"];
					$activity=$_POST["aktiviti"];
					$penyelenggara=$_POST["penyelenggara"];
					mysql_query("update penyelenggaraan set Penyelenggaraan_Tarikh='$date',Penyelenggaraan_Status='$status',Penyelenggaraan_Rujukan='$reference',Penyelenggaraan_Lokasi='$location',Penyelenggaraan_Aktiviti='$activity',Penyelenggaraan_Penyelenggara='$penyelenggara' where Penyelenggaraan_ID='$mid'") or die ('Error updating database: '.mysql_error());;
					echo '<script language="javascript">';
					echo 'alert("Penyelenggaraan telah dikemaskini dalam pangkalan data.")';
					echo '</script>';
					header("refresh:0.1; url=butiran.php?mid=$mid");
			}
		?>