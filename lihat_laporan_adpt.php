<?php
include 'kodeatas.php';
$result = mysqli_query($conn, "SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik = masyarakat.nik WHERE pengaduan.status = '0' ORDER BY pengaduan.id_pengaduan DESC");
$cari = "";
if(isset($_POST['cariin'])){
  $cari = $_POST['cari'];
  $query = mysqli_query($conn, "SELECT *FROM pengaduan INNER JOIN masyarakat ON masyarakat.nik = pengaduan.nik
  LEFT JOIN tanggapan ON tanggapan.id_pengaduan = pengaduan.id_pengaduan LEFT JOIN petugas ON petugas.id_petugas = tanggapan.id_petugas WHERE
  pengaduan.isi_laporan LIKE '%" .$cari. "%' OR 
  pengaduan.tgl_pengaduan LIKE '%" .$cari. "%' OR 
  pengaduan.judul_laporan LIKE '%" .$cari. "%' OR 
  pengaduan.tgl_kejadian LIKE '%" .$cari. "%' OR 
  pengaduan.status LIKE '%" .$cari. "%' OR 
  masyarakat.nama LIKE '%" .$cari. "%' OR 
  petugas.nama_petugas LIKE '%" .$cari. "%' OR 
  tanggapan.tanggapan LIKE '%" .$cari. "%' ");
} else{
  $query = mysqli_query($conn, "SELECT * FROM pengaduan INNER JOIN masyarakat ON masyarakat.nik = pengaduan.nik
  ORDER BY pengaduan.id_pengaduan DESC");
}
?>
<!DOCTYPE html>
<div class="ya">
<h6>LAPORAN MASUK</h6>
  <form class="d-flex mt-3" role="search" method="post" action="">
          <input value="<?=$cari;?>" class="form-control me-2" type="search" placeholder="Search" name="cari" aria-label="Search">
          <button class="btn btn11" name="cariin" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
  </form>
<hr>
<div class="konten lihat_laporan1"> 
<?php if($_SESSION['user']['level']=="admin") {?>
<a href="exportPdfStatus.php?status=0" target="_blank" class="btn btn3"><i class="fa-solid fa-file-pdf"></i></a>
  <?php } ?>
  <?php 
    while($pd = mysqli_fetch_array($query)) { 
      if($pd['status'] == "0") {
  ?>
    <table>
      <tr class="atas">
        <td class="lebel" colspan="2"><?= $pd ['status'] != 'selesai' && $pd['status'] != 'proses' ? "belum dibaca" : $pd['status'];?></td>
      </tr>
      <tr>
          <td>Tanggal kejadian<p>:</p></td>
          <td><?= date('d F Y', strtotime($pd['tgl_kejadian'])); ?></td>
      </tr>
        <tr>
            <td>Nama<p>:</p></td>
            <td><?= $pd['nama']; ?></td>
        </tr>
        <tr>
            <td>Judul<p>:</p></td>
            <td><?= $pd['judul_laporan']; ?></td>
        </tr>
        <tr>
            <td>Isi<p>:</p></td>
            <td><?= $pd['isi_laporan']; ?></td>
        </tr>
        <tr>
          <td></td>
          <td>
            <button type="submit" class="btn btn-success" name="login"> <a href="index2.php?laporan_masuk&id_pengaduan=<?= $pd['id_pengaduan']?>">detail</a></button>
          </td>
        </tr>
      </table>
  <?php } }?>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>