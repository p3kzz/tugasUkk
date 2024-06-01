<?php
  require "koneksi.php";
  session_start();

  if(isset($_POST["submit"])){
    // $error = "";
    if(!empty($_FILES['foto']['name'])) {
      if($_FILES['foto']['size'] > 50000) {
        $rand = rand();
        $filename = $_FILES['foto']['name'];
        $foto = $rand.'_'.$filename;
      } else {
        $error = "Ukuran file max 500kb";
      }
    } else {
      $foto = "";
    }
    $tgl_pengaduan = date('Y-m-d');
    $tgl_kejadian= $_POST['tgl_kejadian'];
    $nik = $_SESSION['user']['nik'];
    $judul_laporan = $_POST['judul_laporan'];
    $isi_laporan = $_POST['isi_laporan'];

    $status = '0';
    if(!empty($_POST['isi_laporan']) && !empty($_POST['tgl_kejadian']) && !empty($_POST['judul_laporan'])){
      if(!isset($error)) {
        move_uploaded_file($_FILES['foto']['tmp_name'], 'gambar/'.$foto);
        $kirim = mysqli_query($conn,"INSERT INTO pengaduan VALUES('','$tgl_pengaduan','$tgl_kejadian','$nik','$judul_laporan','$isi_laporan','$foto', '$status')");
        if($kirim) {
          $error = "pengaduan berhasil dikirim";
        } else{
          $error = "pengaduan gagal dikirim";
        }
      }
    }else {
      $error = "data tidak boleh kosong";
    }
  }
?>

 

<html>
<link rel="stylesheet" type="text/css" href="style.css" >
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!--<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>-->
       <title>Halaman Beranda</title>
</head>
<body> 
    <?php include 'kodeatas.php';
    ?>
    <nav class="navbar navbar-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Pengaduan masyarakat</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Dark offcanvas</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index1.php">Home</a>
            <!-- <a class="nav-link active" aria-current="page" href="dasboard.php">Dasboard</a> -->
            <a class="nav-link active" aria-current="page" href="lapor.php">Pengaduan</a>
            <a class="nav-link active" aria-current="page" href="lihat_laporan.php">lihat pengaduan</a>
            <a class="nav-link active" aria-current="page" href="logout.php">logout</a>   
          </li>

        </ul>
      </div>
      </form>
    </div>
  </div>
</nav>
<div class="ya">
  <img src="pg17.jpg" class="bg" alt="">
    <div class="apa1">
                <div class="col-md-8 card-shadow form-custom">
                  <div class="judul">
                      <h6>Buat pengaduan</h6>
                      <?php if(isset($error)):?>
                      <center> <p style="color: black; font-style: italic;"><?= $error?></p></center>
                      <?php endif;?>
                  </div>

                    <form class="form-horizontal apa" role="form" method="post" action="" enctype="multipart/form-data">
                        <table class="yoyo">
                          <ul>
                                <div class="form-group">
                                                    <label class="haha" for="tanggal">Tanggal kejadian:</label>
                                                    <input type="date" class="form-control" id="tanggal" name="tgl_kejadian">
                                    </div>

                                <div class="form-group">
                                                    <label for="laporan">Judul Laporan:</label>
                                                    <input class="form-control" rows="4" name="judul_laporan" placeholder="Tuliskan judul laporan"></textarea>
                                    </div>

                                <div class="form-group">
                                                    <label for="laporan">Isi laporan:</label>
                                                    <textarea class="form-control" rows="4" name="isi_laporan" placeholder="Tuliskan Isi laporan"></textarea>
                                    </div>

                                <div class="form-group">
                                                    <label for="foto">Foto:</label>
                                                  <br> <input type="file" id="fileInput" name="foto" >
                                </div>
                                <p><div class="form-group">
                                <button id="submit" name="submit" type="submit" class="btn btn-dark">Kirim Pengaduan</button>
                                </div>     
                          </ul>
                            
                        </table>
                      </form>
                
     </div>
  </div>
</div>
            

    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>