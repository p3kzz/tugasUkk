<?php
 require 'koneksi.php';
 if(isset($_POST["registrasi"])){

	$error = registrasi($_POST);
 }
?>
<html>
<head>
	<title>Registrasi</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<style>
		label {
			display: block;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="style.css" >
</head>
<body>

<form action="" method="Post">
	<div class="box_regis">
	<!-- <img src="pg1.jpg" alt="" class="bg"> -->
	<div class="box">
	<center><h4> Register </h4></center>
	<?php if(isset($error)):?>
       <center> <p style="color: black; font-style: italic;"><?= $error?></p></center>
    <?php endif;?>
	<table align="center">
		<ul>
		<div class="form-group">
                        <label for="nik">Nik:</label>
                        <input type="text" class="form-control" id="nik" name="nik" autocomplete = "off" placeholder="Masukkan nik">
         </div>

		 <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" autocomplete = "off" placeholder="Masukkan nama">
        </div>

		 <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" autocomplete = "off" placeholder="Masukkan username">
        </div>

		<div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" autocomplete = "off" placeholder="Masukkan password">
        </div>

		<div class="form-group">
                        <label for="password2">Konfirmasi Password:</label>
                        <input type="password" class="form-control" id="password" name="password2" autocomplete = "off" placeholder="Masukkan kembali password">
                    </div>

		<div class="form-group">
                        <label for="telp">Telp:</label>
                        <input type="text" class="form-control" id="telp" name="telp" autocomplete = "off" placeholder="Masukkan No. telp">
        </div>
		<br><button type="submit" class="btn btn-dark" name="registrasi">Registrasi</button></br>
		<div class="form-footer mt-2">
         <p> Sudah punya account? <a href="login.php">Login</a></p>
     </div>

	</ul>
	</table>
	</div>
	</div>
	</form>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>

