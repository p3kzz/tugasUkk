<?php
session_start();
require 'koneksi.php';
include 'kodeatas.php';
$nik = $_SESSION['user']['nik'];
$result = mysqli_query($conn, "SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik = masyarakat.nik WHERE pengaduan.nik = '$nik'");
?>
<!DOCTYPE html>
<nav class="navbar navbar-dark  fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Pengaduan Masyarakat</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel"></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.html">Home</a>
            <!-- <a class="nav-link active" aria-current="page" href="dasboard.php">Dasboard</a> -->
            <a class="nav-link active" aria-current="page" href="lapor.php">Pengaduan</a>
            <a class="nav-link active" aria-current="page" href="lihat_laporan.php">lihat pengaduan</a>
            <a class="nav-link active" aria-current="page" href="logout.php">logout</a>
          </li>
          
        </ul>
      </div>
    </div>
  </div>
</nav>
<div class="ya">
  <img src="pg17.jpg" class="bg" alt="">
<div class="konten lihat_laporan"> 
  <?php
  while($dt = mysqli_fetch_array($result)) { ?>
      <table>
        <tr>
            <td>Nama<p>:</p></td>
            <td><?= $dt['nama']; ?></td>
        </tr>
        <tr>
            <td>Judul<p>:</p></td>
            <td><?= $dt['judul_laporan']; ?></td>
        </tr>
        <tr>
            <td>Tanggal kejadian<p>:</p></td>
            <td><?= date('d F Y', strtotime($dt['tgl_kejadian'])); ?></td>
        </tr>
        <tr>
            <td>Isi<p>:</p></td>
            <td><?= $dt['isi_laporan']; ?></td>
        </tr>
        <tr>
          <td></td>
          <td>
            <button type="submit" class="btn btn-success" name="login"> <a href="detail_laporan_masyrakat.php?id_pengaduan=<?= $dt['id_pengaduan']?>">detail</a></button>
          </td>
        </tr>
      </table>
              
          <!-- <button type="button" class="btn btn-secondary">Tanggapan</button>-->
  <?php }?>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>