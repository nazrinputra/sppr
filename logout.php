<?php
	ob_start();
	include ("dataconn.php");
	session_destroy();
	echo '<script language="javascript">';
	echo 'alert("Anda sudah log keluar dari sistem.")';
	echo '</script>';
	session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Log Keluar</title>
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
	<script language="javascript" type="text/javascript" src="bootstrap/js/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="bootstrap/js/jquery.validate.min.js"></script>
	<script>
	$(function() {
	   $( "#login" ).validate({
			rules:
			{
				email: {required: true, email: true},
				password: {required: true}
			},
			messages:
			{
				email: {required: "Sila masukkan alamat email anda", email: "Alamat emel tidak lengkap"},
				password: "Sila masukkan kata laluan anda"
			}
		});
	});
	</script>
  </head>
  <body class="login-page">
    <div class="login-box">
      <div>
        <a href="index.php"><h2 style="text-align:center;color:black;">Sistem Pengurusan Penyelenggaraan Rangkaian</h2></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Log masuk untuk memulakan sesi</p>
        <form name="login" id="login" action="login.php" method="post">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" name="email" placeholder="Email"/>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Kata Laluan"/>
          </div>
          <div class="row">
            <div class="col-xs-8">    
              <div style="padding-left:5px;">
                <label>
                  
                </label>
              </div>                        
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" name="submitbtn" class="btn btn-primary btn-block btn-flat">Log Masuk</button>
            </div><!-- /.col -->
          </div>
        </form>
		
        <a href="forgot.php">Saya terlupa kata laluan</a><br>
        <a href="register.php" class="text-center">Pendaftaran baru</a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- Bootstrap 3.3.2 JS -->
    <script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  </body>
</html>
		<?php
			if(isset($_POST["submitbtn"]))
			{
					$user=$_POST["email"];
					$pass=$_POST["password"];
					$login=mysql_query("select * from Penyelenggara where Penyelenggara_Email='$user' and Penyelenggara_Password='$pass'");
					$login_row=mysql_fetch_assoc($login);
					
					if(mysql_num_rows($login)==1)
					{
						$_SESSION['loginadmin']=$login_row["Penyelenggara_ID"];
						
						if($login_row["Penyelenggara_Admin"]==1)
						{
							echo '<script language="javascript">';
							echo 'alert("Anda telah log masuk sebagai Admin")';
							echo '</script>';
						}
						else
						{
							$_SESSION['admin']=0;
							echo '<script language="javascript">';
							echo 'alert("Anda telah log masuk sebagai Penyelenggara")';
							echo '</script>';
						}
						
						header("refresh:0.1; url=index.php");
					}
					
					else
					{
						echo '<script language="javascript">';
						echo 'alert("Email atau kata laluan salah!")';
						echo '</script>';
					}
			}
		?>