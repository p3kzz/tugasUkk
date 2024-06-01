<?php
include 'kodeatas.php';
$result = mysqli_query($conn, "SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik = masyarakat.nik WHERE pengaduan.status = '0' ORDER BY pengaduan.id_pengaduan DESC");
?>
<?php 
          if(isset($_GET['cari'])){
            $cari = $_GET['cari'];
            echo "<b>Hasil pencarian : ".$cari."</b>";
          }
        ?>
<?php 
	if(isset($_GET['search'])){
		$cari = $_GET['search'];
    $data = mysqli_query($conn,"SELECT * FROM masyarakat where nama like '%".$cari."%'");
  }else{
		$data = mysqli_query($conn,"SELECT * FROM masyarakat");		
	}
  while($pd = mysqli_fetch_array($data)){
	?>
  <tr>
            <td>Nama<p>:</p></td>
            <td><?= $pd['nama']; ?></td>
        </tr>
	<?php }?>
<!DOCTYPE html>

<div class="ya">
  <!-- <img src="pg17.jpg" class="bg" alt=""> -->
<div class="konten lihat_laporan1"> 
<form class="d-flex mt-3" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button>
        </form>
  <?php while($pd = mysqli_fetch_array($result)) { ?>
    <table>
      <tr class="atas">
        <td class="lebel" colspan="2"><?= $pd ['status'] != 'selesai' && $pd['status'] != 'proses' ? "belum dibaca" : $pd['status'];?></td>
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
            <td>Tanggal kejadian<p>:</p></td>
            <td><?= $pd['tgl_kejadian']; ?></td>
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
              
          <!-- <button type="button" class="btn btn-secondary">Tanggapan</button>-->
  <?php }?>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>