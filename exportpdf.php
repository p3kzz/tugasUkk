<?php
	require 'koneksi.php';
	if(!isset($_SESSION)){
		session_start();
	 }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Membuat Laporan PDF Dengan PHP dan MySQLi</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div class="container">
		<center>
			<h4 style="font-size: 1.2em; margin-top: 30px; border-bottom: 2px solid rgba(0, 0, 0, 5);">LAYANAN <br>PENGADUAN MASYARAKAT</h4>
			<h4 style="font-size: 1em; margin-top: 10px;">DATA SEMUA LAPORAN</h4>
			
		</center>
		<i class="bi bi-arrow-left" href="index2.php?semua_laporan"></i>
		<br>
		<table class="table table-bordered" border="2px" style="margin-top: -10px;">
			<thead>				
				<tr>
					<th style="text-align: center;">Nik</th>
					<th style="text-align: center;">Tanggal pengaduan</th>					
					<th style="text-align: center;">Nama</th>
					<th style="text-align: center;">judul laporan</th>					
					<th style="text-align: center;">Telp</th>					
					<th style="text-align: center;">Status</th>					
				</tr>				
			</thead>
			<tbody>
				<?php
				if(isset($_POST['cetakpdf'])){
					$dari = $_POST['tgl_dari'];
					$sampai = $_POST ['tgl_sampai'];
				if(!empty($dari) && !empty($sampai)) {
				$sql = mysqli_query($conn, "SELECT  * FROM masyarakat INNER JOIN pengaduan ON masyarakat.nik = pengaduan.nik WHERE tgl_pengaduan BETWEEN '$dari' AND '$sampai' ORDER BY pengaduan.id_pengaduan ASC"); // Eksekusi/Jalankan query dari variabel $query
				} else {
				$sql = mysqli_query($conn, "SELECT  * FROM masyarakat INNER JOIN pengaduan ON masyarakat.nik = pengaduan.nik  ORDER BY pengaduan.id_pengaduan ASC"); // Eksekusi/Jalankan query dari variabel $query
				}
				}
				$row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql
				if($row > 0){
				while($d = mysqli_fetch_array($sql)){
					?>
					<tr>
						<td><?php echo $d['nik'] ?></td>
						<td><?php echo date('d F Y', strtotime($d['tgl_pengaduan'])) ?></td>										
						<td><?php echo $d['nama'] ?></td>						
						<td><?php echo $d['judul_laporan'] ?></td>										
						<td><?php echo $d['telp'] ?></td>
						<td><?php echo $d['status']=='0'?'belum dibaca':$d['status'];?></td>										
					</tr>
					<?php
				}}
				?>				
			</tbody>
		</table>
	</div>
	<script>
	window.print();
	</script>
</body>
</html>
        
