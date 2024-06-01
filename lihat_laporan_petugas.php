<?php
$id_petugas = $_GET['id_petugas'];
$result = mysqli_query($conn, "SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik = masyarakat.nik
LEFT JOIN tanggapan ON tanggapan.id_pengaduan = pengaduan.id_pengaduan
LEFT JOIN petugas ON petugas.id_petugas = tanggapan.id_petugas
WHERE tanggapan.id_petugas = '$id_petugas' ORDER BY pengaduan.id_pengaduan DESC
");
?>
<div class="semualaporan">
    <h4>DATA YANG DI TANGGAPI</h4>
</div>
<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
    <div class="float-right">
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
            while($dt = mysqli_fetch_array($result)) { ?>
            <tr>
                <td><?=$dt['nik']?></td>
                <td><?=date('d F Y', strtotime($dt['tgl_pengaduan']))?></td>
                <td><?=$dt['nama']?></td>
                <td><?=$dt['judul_laporan']?></td>
                <td><?=$dt['telp']?></td>
                <td><?= $dt['status']=='0'?'belum dibaca':$dt['status'];?></td>
                <td>
                <button type="submit" class="btn btn-success" name="login"><a href="index2.php?detail_data_petugas&id_pengaduan=<?= $dt['id_pengaduan']?>&id_petugas=<?= $dt['id_petugas']?>" style="color:white;text-decoration: none;">detail</a></button>
                </td>
            </tr>
        <?php
        }
        ?>
</div>
</div>