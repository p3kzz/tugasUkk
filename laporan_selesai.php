<?php
include 'kodeatas.php';
$result = mysqli_query($conn, "SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik = masyarakat.nik
 WHERE pengaduan.status = 'selesai' ORDER BY pengaduan.id_pengaduan DESC");
?>
<!DOCTYPE html>

<div class="yi">
  <h6>LAPORAN SELESAI</h6>
  <hr>
<div class="konten laporanselesai"> 
<?php if($_SESSION['user']['level']=="admin") {?>
<a href="exportPdfStatus.php?status=selesai" target="_blank" class="btn btn2"><i class="fa-solid fa-file-pdf"></i></a>
<?php } ?>
  <?php
  while($pd = mysqli_fetch_array($result)) { ?>
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
              
          <!-- <button type="button" class="btn btn-secondary">Tanggapan</button>-->
  <?php }?>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>