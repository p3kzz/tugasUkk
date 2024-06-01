<?php
require 'koneksi.php';
session_start();
$id_pengaduan = $_GET['id_pengaduan'];
    $query1 = mysqli_query($conn, "SELECT * FROM pengaduan
    INNER JOIN masyarakat ON pengaduan.nik = masyarakat.nik
    LEFT JOIN tanggapan ON tanggapan.id_pengaduan = pengaduan.id_pengaduan
    LEFT JOIN petugas ON petugas.id_petugas = tanggapan.id_petugas
    WHERE pengaduan.id_pengaduan = '$id_pengaduan' ORDER BY pengaduan.id_pengaduan DESC
    ");
    $dt = mysqli_fetch_array($query1);
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Pacifico&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css"/>
</head>
<body>
<div class="pdflaporan">
  <h6>Laporan</h6>
  <div class="laporan">
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
                <td><?= $dt['tgl_kejadian']; ?></td>
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
      <script>
	window.print();
	</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>