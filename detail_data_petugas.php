<?php
  if(isset($_POST['balas'])) {
    $id_pengaduan = $_POST['id_pengaduan'];
    $tgl_tanggapan = date('Y-m-d');
    $tanggapan = $_POST['tanggapan'];
    $id_petugas = $_SESSION['user']['id_petugas'];
    $status = $_POST['status'];

    if(!empty($tanggapan) && !empty($status)) {
      $kirim = mysqli_query($conn, "INSERT INTO tanggapan 
      VALUES ('', '$id_pengaduan', '$tgl_tanggapan', '$tanggapan', '$id_petugas')");
      $kirim .= mysqli_query($conn, "UPDATE pengaduan SET 
      status = '$status' WHERE id_pengaduan = '$id_pengaduan'");
      if ($kirim) {
        $error = "Tanggapan berhasil terkirim";
        $type = "success";
        if($status = "proses") {
          header('Location: index2.php?laporan_proses');
          exit;
        }else {
          header('Location: index2.php?laporan_selesai');
          exit;
        }
      } 
    } else {
      $error = "Harap Isi Semua Form";
      $type = "danger";
    }
  }
  if(isset($_POST['ubah'])) {
    $id_pengaduan = $_POST['id_pengaduan'];
    $id_tanggapan = $_POST['id_tanggapan'];
    $tanggapan = $_POST['tanggapan'];
    $status = "selesai";
    if(!empty($tanggapan)){
      $kirim = mysqli_query($conn, "UPDATE tanggapan SET tanggapan = '$tanggapan' WHERE id_pengaduan = '$id_pengaduan' ");
      $kirim .= mysqli_query($conn, "UPDATE pengaduan SET status = '$status' WHERE id_pengaduan = '$id_pengaduan' ");
    } else {
      $kirim = mysqli_query($conn, "UPDATE pengaduan SET status = '$status' WHERE id_pengaduan = '$id_pengaduan' ");
    }
  }
  if(isset($_POST['hapus'])){
    $id_pengaduan =$_POST['id_pengaduan'];
    $status =$_POST['status'];
    $kirim = mysqli_query($conn, "DELETE FROM tanggapan WHERE id_pengaduan = '$id_pengaduan'");
    $kirim .= mysqli_query($conn, "DELETE FROM pengaduan WHERE id_pengaduan = '$id_pengaduan'");
    if($status == "selesai") {
      $hal = "laporan_selesai";
    } else if($status == "proses") {
      $hal = "laporan_proses";
    } else {
      $hal = "lihat_laporan_adpt";
    }
    if($kirim) {
        header('Location: index2.php?'.$hal);
    }else{
        echo "laporan gagal dihapus";
    }
  }
  $id_petugas = $_GET['id_petugas'];
  $id_pengaduan = $_GET['id_pengaduan'];
    $query1 = mysqli_query($conn, "SELECT * FROM pengaduan
    INNER JOIN masyarakat ON pengaduan.nik = masyarakat.nik
    LEFT JOIN tanggapan ON tanggapan.id_pengaduan = pengaduan.id_pengaduan
    LEFT JOIN petugas ON petugas.id_petugas = tanggapan.id_petugas
    WHERE pengaduan.id_pengaduan = '$id_pengaduan' ORDER BY pengaduan.id_pengaduan DESC
    ");
    $dt = mysqli_fetch_array($query1);
    //
?>

<div class="laporan_masuk">
<a href="pdflaporan.php?id_pengaduan=<?= $id_pengaduan;?>" target="_blank" class="btn btn-success5"><i class="fa-solid fa-file-pdf"></i></a>
  <div class="card" style="width: 48rem;">
  <h6>Laporan</h6>
  <div class="atas">
    <div class="lebel"><?= $dt ['status'] != 'selesai' && $dt['status'] != 'proses' ? "belum dibaca" : $dt['status'];?></div>
  </div>
  <hr>
  <div class="laporan">
       <table>
         <tr>
             <td>Tanggal kejadian<p>:</p></td>
             <td><?= date('d F Y', strtotime($dt['tgl_kejadian'])); ?></td>
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
            <?php if(!empty($dt['foto'])) { ?>
            <tr>
                <td>Foto<p>:</p></td>
                <td><img class="lp1" src="gambar/<?= $dt['foto']; ?>" alt="<?= $dt['foto']; ?>"></td>
            </tr>   
            <?php } ?>
      </table>
  </div>
  <hr><div class="cord">
  <?php
    if(isset($error)) {
      echo "
        <div class='alert alert-$type alert-dismissible fade show' role='alert'>
          <strong>$error</strong>
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
      ";
      unset($error);
    }
  ?>
  <?php if(!empty($dt['id_tanggapan'])) {?>
    <div class="mb-3">
      <label for="exampleForControlTextarea1" class="form-label"><h6>Tanggapan: <?= $dt['nama_petugas'];?></h6></label>
      <p class="form1"><?= $dt['tanggapan']; ?></p>   
    </div>
    <?php
    if($dt['status'] == "proses") {
      if($_SESSION['user']['id_petugas']== $dt['id_petugas']) {
    ?>
      <form action="" method="post">
      <div class="mb-3">
      <label for="exampleForControlTextarea1" class="form-label"><h6>Tanggapan: <?= $dt['nama_petugas'];?></h6></label>
       <textarea name="tanggapan" class="form-control" id="exampleFormControlTextarea1"></textarea>
       <input type="hidden" name="id_tanggapan" value="<?=$dt['id_tanggapan']; ?>">
       <input type="hidden" name="id_pengaduan" value="<?= $id_pengaduan; ?>">
     </div>
     <div class="aksi1">
      <button type="submit" class="btn btn-dark" name="ubah">Selesai</button>
      <button type="button" class="btn btn-secondary"><a href="index2.php?lihat_laporan_petugas&id_petugas=<?= $id_petugas?>">kembali</a></button>
      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?= $id_pengaduan; ?>">Hapus</button>
     </div>
    </form>
    <?php } } else { ?>
      <div class="aksi2">
        <button type="button" class="btn btn-secondary"><a href="index2.php?lihat_laporan_petugas&id_petugas=<?= $id_petugas?>">kembali</a></button>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?= $id_pengaduan; ?>">Hapus</button>
      </div>
    <?php } } else {?>
    <div class="tanggapan">
      <form action="" method="post">
        <div class="mb-3">
          <textarea name="tanggapan" class="form-control" id="exampleFormControlTextarea1"></textarea>
          <input type="hidden" name="id_pengaduan" value="<?= $id_pengaduan; ?>">
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" value="proses" name="status" id="status1">
          <label class="form-check-label" for="status1">Proses</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" value="selesai" name="status" id="status2">
          <label class="form-check-label" for="status2">Selesai</label>
        </div> 
        <div class="aksi2">
          <button type="submit" class="btn btn-dark" name="balas">Kirim</button>
          <button type="button" class="btn btn-secondary"><a href="index2.php?lihat_laporan_petugas&id_petugas=<?= $id_petugas?>">kembali</a></button>
          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?= $id_pengaduan; ?>">Hapus</button>
        </div>
      </form>
    </div> 
    <?php } ?>
  </div>
  <div class="modal fade" id="hapus<?= $id_pengaduan; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <form action="" method="post">
              <div class="modal-body">
                  <input type="text" name="id_pengaduan" value="<?=$id_pengaduan; ?>">
                  <input type="text" name="status" value="<?=$dt['status']; ?>">
                  Yakin hapus data ini?
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal </button>
                  <button type="submit" class="btn btn-primary" name="hapus">Hapus</button>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>
</div>