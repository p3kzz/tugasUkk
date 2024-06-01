<?php
$lp = mysqli_query($conn, "SELECT * FROM pengaduan");
$lp1 = mysqli_query($conn, "SELECT * FROM pengaduan WHERE status = '0'");
$lp2 = mysqli_query($conn, "SELECT * FROM pengaduan WHERE status ='proses'");
$lp3 = mysqli_query($conn, "SELECT * FROM pengaduan WHERE status ='selesai'");
$pt = mysqli_query($conn, "SELECT * FROM petugas  WHERE level = 'petugas'");
$pt1 = mysqli_query($conn, "SELECT * FROM petugas  WHERE level = 'admin'");
$ms = mysqli_query($conn, "SELECT * FROM masyarakat");
?>
<div class="diti">
    <h4>Beranda</h4>
</div>
<br>
<div class="beranda">
    <div class="data">
        <?php if($_SESSION['user']['level']== 'admin') {?>
        <div class="kotak pt bg-success">
            <div class="kotak1">
            <i class="fa-solid fa-user"></i>
            <p><?= mysqli_num_rows($pt);?> Petugas</p>
            </div>
            <a class="kotak2" href="index2.php?data_petugas">
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
        <div class="kotak pt bg-success">
            <div class="kotak1">
            <i class="fa-solid fa-user"></i>
            <p><?= mysqli_num_rows($pt1);?> Admin</p>
            </div>
            <a class="kotak2" href="index2.php?data_petugas">
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
        <div class="kotak lp1 bg-danger">
            <div class="kotak1">
        <i class="fa-solid fa-users"></i>
            <p><?= mysqli_num_rows($ms);?> Masyarakat</p>
            </div>
            <a class="kotak2" href="index2.php?data_masyarakat">
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
        <div class="kotak lp bg-danger">
            <div class="kotak1">
                <i class="fa-solid fa-file-lines"></i>
                <p><?= mysqli_num_rows($lp);?> Semua laporan</p>
            </div>
            <a class="kotak2" href="index2.php?semua_laporan">
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
        <?php } ?>
        <div class="kotak lp1 bg-danger">
            <div class="kotak1">
            <i class="fa-solid fa-message"></i>
                <p><?= mysqli_num_rows($lp1);?> Laporan belum ditanggapi</p>
            </div>
            <a class="kotak2" href="index2.php?lihat_laporan_adpt">
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
        <div class="kotak lp2 bg-danger">
            <div class="kotak1">
                <i class="fa-solid fa-file"></i>
                <p><?= mysqli_num_rows($lp2); ?> laporan proses</p>
            </div>
            <a class="kotak2" href="index2.php?laporan_proses">
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
        <div class="kotak lp3 bg-danger">
            <div class="kotak1">
            <i class="fa-solid fa-file"></i>
                <p><?= mysqli_num_rows($lp3); ?> laporan selesai</p>
            </div>
            <a class="kotak2" href="index2.php?laporan_selesai">
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>