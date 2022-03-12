<?php
	ob_start();
	include ("dataconn.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Daftar</title>
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
	<script language="javascript" type="text/javascript" src="plugins/bootstrap-filestyle/src/bootstrap-filestyle.min.js"></script>
	<script>
	$(function() {
	   $( "#register" ).validate({
			rules:
			{
				name: {required: true},
				email: {required: true, email: true},
				password: {required: true, minlength: 5},
				confirmpassword: {required: true, equalTo: "#password"},
				position: {required: true},
				unit: {required: true},
				phone: {required: true, minlength: 10},
			},
			messages:
			{
				name: "Sila masukkan nama penuh anda",
				email: "Sila masukkan alamat email anda",
				password: "Sila masukkan kata laluan anda (minimum 5 karakter)",
				confirmpassword: "Kata laluan tidak sama, sila masukkan semula",
				position: "Sila masukkan jawatan anda",
				unit: "Sila masukkan unit anda",
				phone: "Sila masukkan nombor telefon anda",
			}
		});
	});
	</script>
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="index.php"><h2 style="text-align:center;color:black;">Sistem Pengurusan Penyelenggaraan Rangkaian</h2></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Hantar permohonan pendaftaran baru</p>
        <form name="register" id="register" action="register.php" method="post" enctype="multipart/form-data">
		  <div class="form-group has-feedback">
            <input type="text" class="form-control" name="name" placeholder="Nama Penuh"/>
          </div>
          <div class="form-group has-feedback">
            <input type="email" class="form-control" name="email" placeholder="Email"/>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" id="password" placeholder="Kata Laluan"/>
          </div>
		   <div class="form-group has-feedback">
            <input type="password" class="form-control" name="confirmpassword" placeholder="Sahkan Kata Laluan"/>
          </div>
		  <div class="form-group has-feedback">
            <input type="text" class="form-control" name="unit" placeholder="Unit"/>
          </div>
		  <div class="form-group has-feedback">
            <input type="number" class="form-control" name="phone" placeholder="Nombor Telefon"/>
          </div>
		  <div class="radio-toolbar">
						Pilih Imej Profil:<input type="file" name="imej" id="imej" accept="image/x-png, image/gif, image/jpeg" class="filestyle" data-classButton="btn btn-primary" data-input="false" data-classIcon="icon-plus" data-buttonText="Pilih..">
		  </div>
          <div class="row">
            <div class="col-xs-8">                          
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" name="submitbtn" class="btn btn-primary btn-block btn-flat">Daftar</button>
            </div><!-- /.col -->
          </div>
        </form>

        <a href="forgot.php">Saya terlupa kata laluan</a><br>
        <a href="login.php" class="text-center">Saya sudah mempunyai akaun</a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- Bootstrap 3.3.2 JS -->
    <script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  </body>
</html>
		<?php
			if(isset($_POST["submitbtn"]))
			{
					$name=$_POST["name"];
					$user=$_POST["email"];
					$pass=$_POST["password"];
					$unit=$_POST["unit"];
					$phone=$_POST["phone"];
					
					$tmpName  = $_FILES['imej']['tmp_name'];
					$info = pathinfo($_FILES['imej']['name']);
					$location = "dist/img/profile/" . $sess_id .".". $info['extension'];
					
					if ($_FILES["imej"]["error"] > 0) 
					{echo "Return Code: " . $_FILES["imej"]["error"] . "<br>";}
					else 
					{$imej = "profile/".$sess_id .".". $info['extension'];}
					move_uploaded_file($_FILES["imej"]["tmp_name"],$location);
		
					mysql_query("insert into Penyelenggara (Penyelenggara_Nama,Penyelenggara_Email,Penyelenggara_Password,Penyelenggara_Unit,Penyelenggara_Imej,Penyelenggara_Tel) values ('$name','$user','$pass','$unit','$imej','$phone')");
					echo '<script language="javascript">';
					echo 'alert("Permohonan pendaftaran anda sudah berjaya.")';
					echo '</script>';
					header("refresh:0.1; url=index.php");
			}
		?>