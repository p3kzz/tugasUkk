<div class="semualaporan">
  <h4>SEMUA LAPORAN</h4>
</div>
<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
<div class="float-right">
  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-file-pdf">
  </i></button>
			<br>
			<br>
            <thead>
            <tr class="table-dark">
                <th>Nik</th>
                <th>Tanggal pegaduan</th>
                <th>Nama</th>
                <th>Judul laporan</th>
                <th>Telp</th>
                <th>Status</th>
                <th>...</th>
            </tr>
            </thead>
            <?php
        $query  =mysqli_query($conn, "SELECT * FROM masyarakat INNER JOIN pengaduan ON masyarakat.nik = pengaduan.nik ORDER BY pengaduan.id_pengaduan DESC");
        while($dt = mysqli_fetch_array($query)){
        ?> 
        <tr>
            <td><?=$dt['nik']?></td>
            <td><?=date('d F Y', strtotime($dt['tgl_pengaduan']))?></td>
            <td><?=$dt['nama']?></td>
            <td><?=$dt['judul_laporan']?></td>
            <td><?=$dt['telp']?></td>
            <td><?= $dt['status']=='0'?'belum dibaca':$dt['status'];?></td>
            <td>
            <button type="submit" class="btn btn-success" name="login"><a href="index2.php?laporan_masuk&id_pengaduan=<?= $dt['id_pengaduan']?>" style="color:white;text-decoration: none;">detail</a></button>
            </td>
        </tr>
        <?php
        }
        ?>
</div>
</table>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Cetak pdf</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="exportpdf.php" method="post">
      <div class="form-group">
                        <label for="tgl_dari">Dari tanggal:</label>
                        <input type="date" class="form-control" id="tgl_dari" name="tgl_dari" type="date" autocomplete = "off" placeholder="Masukkan tanggal">
         </div>

		 <div class="form-group">
                        <label for="tgl_samapi">Sampai tanggal:</label>
                        <input type="date" class="form-control" id="tgl_sampai" name="tgl_sampai" type="date" autocomplete = "off" placeholder="Masukkan nama">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" name="cetakpdf" class="btn btn-primary">Cetak</button>
      </div>
    </form>
    </div>
  </div>
</div>



