<?php
 session_start();
 require 'koneksi.php';
 include 'kodeatas.php';

 $notif = mysqli_query($conn, "SELECT * FROM pengaduan WHERE status = '0' ORDER BY id_pengaduan DESC ");
?>

<nav class="navbar position-fixed" style="background-color: rgb(153, 12, 31); padding-left: 45px;" >
  <div class="laga">
    <h4>Pengaduan masyarakat</h4>
  </div>
  <div class="oke">
    <ul>
        <a href="logout.php" class="logout"><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
    </ul>
  </div>
</nav>
<!-- <?php if($_SESSION['user']['level'] == "petugas") {?>
<nav class="navbar position-fixed" style="background-color: rgb(30, 27, 27, 1); padding-left: 45px;" >
  <div class="laga">
    <h4>Pengaduan masyarakat</h4>
  </div>
  <div class="oke">
    <ul>
        <a href="logout.php" class="logout"><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
    </ul>
  </div>
</nav>
<?php } ?> -->
<div class="sidebar" style="background-color: #851a2d;">

<!-- <?php if($_SESSION['user']['level'] == "petugas") {?>
<div class="sidebar" style="background-color: rgb( 65, 31, 31, 1);">
    <?php } ?> -->
    <ul>
    <?php if($_SESSION['user']['level'] == "admin") {?>
        <a href="index2.php?beranda" class="list">
            <i class="fa-solid fa-house"></i>
            <li>Beranda</li>
        </a> 
        <p>
            <a class="list" data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample1">
            <i class="fa-solid fa-user"></i>Data user
            </a>
        </p>
        <div class="collapse" id="collapseExample1">
            <div class="card card-body">
                <ul>
                    <li><a href="index2.php?data_masyarakat">Data masyarakat</a></li>
                    <li><a href="index2.php?data_petugas">Data petugas</a></li>
                </ul>
            </div>
        </div>
            <a href="index2.php?lihat_laporan_adpt" class="list position-relative">
            <i class="fa-solid fa-message"></i>
            <li>Laporan masuk
            <?php if(mysqli_num_rows($notif) > 0 ){ ?>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pi11 bg-danger">
                    <?= mysqli_num_rows($notif); ?>
                <span class="visually-hidden">unread messages</span>
            <?php } ?>
            </li>
        </a>
        <p>
            <a class="list" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                <i class="apa fa-solid fa-file"></i>Data laporan
            </a>
        </p>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <ul>
                    <li><a href="index2.php?laporan_proses">laporan di proses</a></li>
                    <li><a href="index2.php?laporan_selesai">laporan selesai</a></li>
                </ul>
            </div>
        </div>
        <a href="index2.php?semua_laporan" class="list">
            <i class="fa-solid fa-file-lines"></i>
            <li>Semua laporan</li>
        </a> 
        
        
    <?php } else { ?>
        <a href="index2.php?beranda" class="list">
            <i class="fa-solid fa-house"></i>
            <li>Beranda</li>
        </a> 
        <a href="index2.php?lihat_laporan_adpt" class="list position-relative">
        <i class="fa-solid fa-message"></i>
            <li>Laporan Masuk
            <?php if(mysqli_num_rows($notif) > 0 ){ ?>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pi11 bg-danger">
                    <?= mysqli_num_rows($notif); ?>
                <span class="visually-hidden">unread messages</span>
            <?php } ?>
            </li>
        </a>  
        
        <p>
            <a class="list" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                <i class="apa fa-solid fa-file"></i>Data laporan
            </a>
        </p>
            <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <ul>
                    <li><a href="index2.php?laporan_proses">laporan di proses</a></li>
                    <li><a href="index2.php?laporan_selesai">laporan selesai</a></li>
                </ul>
            </div>
        </div>
        </a> 
    <?php } ?>
    </ul>
</div>
</div>

<div class="content">
    <?php
    if($_SESSION['user']['level'] == "petugas") {
        if(isset($_GET['beranda'])) {
            include 'beranda.php';
        } else if(isset($_GET['lihat_laporan_adpt'])) {
            include 'lihat_laporan_adpt.php';
        }  else if(isset($_GET['laporan_masuk'])) {
            include 'laporan_masuk.php';
        }  else if(isset($_GET['laporan_proses'])) {
            include 'laporan_proses.php';
        }  else if(isset($_GET['laporan_selesai'])) {
            include 'laporan_selesai.php';
        }else {
            include 'beranda.php';
        }
    } else {
        if(isset($_GET['beranda'])) {
            include 'beranda.php';
        } else if(isset($_GET['detail_data_masyarakat'])) {
            include 'detail_data_masyarakat.php';
        } else if(isset($_GET['data_masyarakat'])) {
            include 'data_masyarakat.php';
        } else if(isset($_GET['lihat_laporan_masyarakat'])) {
            include 'lihat_laporan_masyarakat.php';
        } else if(isset($_GET['userbaru'])) {
            include 'userbaru.php';
        } else if(isset($_GET['data_petugas'])) {
            include 'data_petugas.php';
        } else if(isset($_GET['lihat_laporan_petugas'])) {
            include 'lihat_laporan_petugas.php';
        } else if(isset($_GET['detail_data_petugas'])) {
            include 'detail_data_petugas.php';
        } else if(isset($_GET['lihat_laporan_adpt'])) {
            include 'lihat_laporan_adpt.php';
        }   else if(isset($_GET['laporan_masuk'])) {
            include 'laporan_masuk.php';
        } else if(isset($_GET['laporan_proses'])) {
            include 'laporan_proses.php';
        } else if(isset($_GET['laporan_selesai'])) {
            include 'laporan_selesai.php';
        } else if(isset($_GET['semua_laporan'])) {
            include 'semua_laporan.php';
        } else if(isset($_GET['exportpdf'])) {
            include 'exportpdf.php';
        } else {
            include 'beranda.php';
        }
    }
    ?>
</div>
<?php include 'kodebawah.php';?>