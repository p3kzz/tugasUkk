<?php
require 'koneksi.php';
session_start();
if(isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    if(!empty($_POST['username']) && !empty($_POST['username'])){
    $result = mysqli_query($conn, "SELECT * FROM masyarakat WHERE username = '$username'");

    //cek username
    if(mysqli_num_rows($result) > 0){
        //cek password
        $row = mysqli_fetch_assoc($result);
       if($password == $row["password"]) {
        $_SESSION['user'] = $row;
        header("Location: lapor.php");
        exit;
       } 
       
    }
    $error= "username dan pasword salah";
} else{
  $error= "Data tidak boleh kosong";
}
}

?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>halaman login</title>
    <style>
		label {
			display: block;
		}
	</style>
  <link rel="stylesheet" type="text/css" href="style.css" >
</head>
<body>
<form action="" method="POST";>
<div class="box_login">
  <!-- <img src="pg1.jpg" alt="" class="bg"> -->
    <div class="box_a"></div>
    <div class="box_y">
    <?php if(isset($error)):?>
       <center> <p style="color: black; font-style: italic;"><?= $error?></p></center>
    <?php endif;?>
    <center> <h4>Sign-in</h4> </center>
  <table align="center">

    <ul>

    <div class="form-group">
                        <label for="username"  >Username:</label>
                        <input type="text" class="form-control" id="username" name="username" autocomplete = "off" placeholder="Masukkan username">
    </div>
    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password">
    </div>
  
    <br><button type="submit" class="btn btn-dark" name="login">login</button></br>
    
    <div class="apa">
        <p> Belum punya account? <a href="registrasi.php">Registrasi</a></p>
        <p> Masuk sebagai admin atau petugas? <a href="login1.php">Masuk</a></p>
     </div>
    </ul>
    </table>
    </div>
    </div>
</form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>

