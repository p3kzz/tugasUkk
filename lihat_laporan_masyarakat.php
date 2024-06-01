<?php
$nik = $_GET['nik'];
$result = mysqli_query($conn, "SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik = masyarakat.nik WHERE pengaduan.nik = '$nik'");
?>
<div class="semualaporan">
    <h4>LAPORAN MASYARAKAT</h4>
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
             $query  =mysqli_query($conn, "SELECT * FROM masyarakat INNER JOIN pengaduan ON masyarakat.nik = pengaduan.nik ORDER BY pengaduan.id_pengaduan DESC");
            while($dt = mysqli_fetch_array($result)) { ?>
        
            <tr>
                <td><?=$dt['nik']?></td>
                <td><?=date('d F Y', strtotime($dt['tgl_pengaduan']))?></td>
                <td><?=$dt['nama']?></td>
                <td><?=$dt['judul_laporan']?></td>
                <td><?=$dt['telp']?></td>
                <td><?= $dt['status']=='0'?'belum dibaca':$dt['status'];?></td>
                <td>
                <button type="submit" class="btn btn-success" name="login"><a href="index2.php?detail_data_masyarakat&id_pengaduan=<?= $dt['id_pengaduan']?>&nik=<?= $nik?>" style="color:white;text-decoration: none;">detail</a></button>
                </td>
            </tr>
        <?php
        }
        ?>
</div>
</div>