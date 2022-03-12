<?php
	ob_start();
	include ("dataconn.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Terlupa Kata Laluan</title>
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
			},
			messages:
			{
				email: {required: "Sila masukkan alamat email anda", email: "Alamat emel tidak lengkap"},
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
        <p class="login-box-msg">Masukkan alamat email anda</p>
        <form name="login" id="login" action="#" method="post">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" name="email" placeholder="Email"/>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <button type="submit" name="submitbtn" class="btn btn-primary btn-block btn-flat" style="margin-left:230px;">Hantar</button>
            </div><!-- /.col -->
          </div>
        </form>

        <a href="login.php">Log masuk</a><br>
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
					$login=mysql_query("select * from penyelenggara where Penyelenggara_Email='$user'");
					$login_row=mysql_fetch_assoc($login);
					
					if(mysql_num_rows($login)==1)
					{
						$memail=$user;
						$mesej="Kata laluan anda adalah: ".$login_row["Penyelenggara_Password"];
						$subject="Terlupa Kata Laluan SPPR";
						$body="Peringatan dari Sistem Pengurusan Penyelenggaraan Rangkaian (SPPR): ".$mesej;
						$headers = $memail;
						
						require 'plugins/PHPMailer/PHPMailerAutoload.php';
						$mail = new PHPMailer;
						$mail->isSMTP();
						$mail->SMTPSecure = 'ssl';
						$mail->SMTPAuth = true;
						$mail->Host = 'smtp.gmail.com';
						$mail->Port = 465;
						$mail->Username = 'spprgitn@gmail.com';
						$mail->Password = 'systempassword';
						$mail->setFrom('your@email-address.com');
						$mail->addAddress($memail);
						$mail->Subject = $subject;
						$mail->Body = $body;
						//send the message, check for errors
						if (!$mail->send()) {
							echo "Mailer Error: " . $mail->ErrorInfo;
						} else {
							echo '<script language="javascript">';
							echo 'alert("Email peringatan telah dihantar.")';
							echo '</script>';
							header("refresh:0.1; url=login.php");
						}
					}
					
					else
					{
						echo '<script language="javascript">';
						echo 'alert("Email tidak wujud dalam pangkalan data.")';
						echo '</script>';
					}
			}
		?>