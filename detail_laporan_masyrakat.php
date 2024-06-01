<?php
    require 'koneksi.php';
    include 'kodeatas.php';
    session_start();

    if(isset($_POST['hapusM'])){
      $id_pengaduan =$_POST['id_pengaduan'];
      $kirim = mysqli_query($conn, "DELETE FROM pengaduan WHERE id_pengaduan = '$id_pengaduan'");
      if($kirim) {
          header('Location:lihat_laporan.php');
      }else{
          echo "laporan gagal dihapus";
      }
    }

    $id_pengaduan = $_GET['id_pengaduan'];
    $query1 = mysqli_query($conn, "SELECT * FROM pengaduan
    INNER JOIN masyarakat ON pengaduan.nik = masyarakat.nik
    LEFT JOIN tanggapan ON tanggapan.id_pengaduan = pengaduan.id_pengaduan
    LEFT JOIN petugas ON petugas.id_petugas = tanggapan.id_petugas
    WHERE pengaduan.id_pengaduan = '$id_pengaduan' ORDER BY pengaduan.id_pengaduan DESC
    ");
    $dt = mysqli_fetch_array($query1);
?>
<nav class="navbar navbar-dark  fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Pengaduan Masyrakat</a>
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
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            <a class="nav-link active" aria-current="page" href="lapor.php">Pengaduan</a>
            <a class="nav-link active" aria-current="page" href="lihat_laporan.php">lihat pengaduan</a>
            <a class="nav-link active" aria-current="page" href="logout.php">Logout </a>
            
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
<div class="ya">
  <img src="pg17.jpg" class="bg" alt="">
<div class="detail_laporan">
    <br>
    <div class="card" style="width: 48rem;">
    <div class="card_body">
        <h5>laporan</h5>
        <div class="atas">
            <div class="lebel"><?= $dt['status'] == "0" ? "belum dibaca" : $dt['status'];?></div>
        </div>
        <hr>
        <table>
            <tr>
                <td>NIK<p>:</p></td>
                <td><?= $dt['nik']; ?></td>
            </tr>
            <tr>
                <td>Nama<p>:</p></td>
                <td><?= $dt['nama']; ?></td>
            </tr>
            <tr>
                <td>Judul<p>:</p></td>
                <td><?= $dt['judul_laporan']; ?></td>
            </tr>
            <tr>
                <td>Isi<p>:</p></td>
                <td><?= $dt['isi_laporan']; ?></td>
            </tr>
            <?php if(!empty($dt['foto'])) {?>
            <tr>
                <td>Lampiran Foto<p>:</p></td>
                <td><img class="foto" src="gambar/<?= $dt['foto'];?>" alt="<?= $dt['foto']; ?>"></td>
            </tr>
            <?php } ?>
        </table>
        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form1"><h6>Tanggapan: <?= $dt['nama_petugas']; ?></h6></label>
          <p><?=$dt['tanggapan']; ?></p>
        </div>
        <div class="aksi">
          <button type="button" class="btn btn-secondary"><a href="lihat_laporan.php">kembali</a></button>
          <?php if(!isset($dt['id_tanggapan'])) {?>
          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusM<?= $id_pengaduan; ?>">Hapus</button>
          <a class="btn btn-danger" href="ubah_lapor.php?id_pengaduan=<?= $id_pengaduan; ?>">Ubah</a>
          <?php } ?>
        </div>
      </div>
    </div>
</div>
</div>
<div class="modal fade" id="hapusM<?= $id_pengaduan; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <form action="" method="post">
              <div class="modal-body">
                  <input type="text" name="id_pengaduan" value="<?=$id_pengaduan; ?>">
                  Yakin hapus data ini?
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal </button>
                  <button type="submit" class="btn btn-primary" name="hapusM">Hapus</button>
              </div>
          </form>
      </div>
    </div>
  </div>
<?php include 'kodebawah.php'; ?>