<?php
if(isset($_POST['kirim'])){
  $nik_lama =$_POST['nik_lama'];
  $nik =$_POST['nik'];
  $nama =$_POST['nama'];
  $username =$_POST['username'];
  $telp =$_POST['telp'];
  $password =$_POST['password'];
    $passNew =$_POST['passNew'];
    $data_lama = mysqli_query($conn, "SELECT * FROM masyarakat WHERE nik = '$nik'");
    $dtlm = mysqli_fetch_array($data_lama);
    if(!empty($password)) {
        if(md5($password) == $dtlm['password']) {
            if($username !== $dtlm['username']) {
                $cekusername = mysqli_query($conn, "SELECT * FROM masyarakat WHERE username = '$username'");
                if(mysqli_num_rows($cekusername) > 0){
                    $error = "username sudah ada";
                    echo"
                        <script>
                            alert('username sudah ada');
                        </script>
                    ";
                }
            }

            if(!empty($passNew)) {
                $pass = md5($passNew);
            } else {
                $pass = md5($password);
            }

            if(!isset($error)) {
                mysqli_query($conn, "UPDATE masyarakat SET nik='$nik', nama='$nama', username='$username',password='$pass', telp='$telp' WHERE nik=$nik_lama");
            }
        } else {
            $error = "Password lama salah";
            echo"
                <script>
                    alert('Password lama salah');
                </script>
            ";
        }
    } else {
        $error = "Password lama tidak boleh kosong";
        echo"
                <script>
                    alert('Password lama tidak boleh kosong');
                </script>
            ";
    }
  }
  
  


if(isset($_POST['tambahM'])) {
    $nik = strtolower(stripslashes($_POST["nik"]));
    $nama = strtolower(stripslashes($_POST["nama"]));
    $username = strtolower(stripslashes($_POST["username"]));
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $password2 = mysqli_real_escape_string($conn, $_POST["password2"]);
    $telp = ($_POST["telp"]);
    if(!empty($_POST['nik']) && !empty($_POST['nama']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['telp'])){
    //cek konfirmasi password
        if ( $password == $password2) {
            $pass = md5($password);
            mysqli_query($conn, "INSERT INTO masyarakat VALUES('$nik', '$nama', '$username', '$pass', '$telp')");
            $error = "Register Berhasil!";  
        } else {
            $error = "konfirmasi password tidak sama!";           
        }
    //enkripsi password
   //$password = password_hash($password, PASSWORD_DEFAULT);
    //tambahkan user baru ke database
    
    } else{
        $error = "data tidak boleh kosong!";
    }
}

if(isset($_POST['hapusM'])){
    $nikh =$_POST['nik'];
    $cari = mysqli_query($conn, "SELECT * FROM pengaduan WHERE nik = '$nikh' ");
    if(mysqli_num_rows($cari) > 0) {
     foreach($cari as $i) {
        $a = $i['id_pengaduan'];
        $hapus = mysqli_query($conn, "DELETE FROM tanggapan WHERE id_pengaduan = '$a'");
     }
     $hapus = mysqli_query($conn, "DELETE FROM pengaduan WHERE nik = '$nikh'");
     $hapus = mysqli_query($conn, "DELETE FROM masyarakat WHERE nik = '$nikh'");
    } else {
        $hapus = mysqli_query($conn, "DELETE FROM pengaduan WHERE nik = '$nikh'");
        $hapus = mysqli_query($conn, "DELETE FROM masyarakat WHERE nik = '$nikh'");
    }
    if($hapus) {
        $error="data berhasil dihapus";
    }else {
        $error = "data gagal dihapus";
    }
}
?>
<div class="datamasyarakat">
  <h4>DATA MASYARAKAT</h4>
</div>
<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
            <div class="hi">
            <thead>
            <tr class="table-dark">
                <th>Nik</th>
                <th>Nama</th>
                <th>Username</th>
                <th>telp</th>
                <th>Laporan  yang dikirim</th>
                <th>....</th>
            </tr>
            </thead>
            </div>
            <?php
        $query1  =mysqli_query($conn, "SELECT * FROM masyarakat ORDER BY masyarakat.nik DESC");
        $query2= mysqli_query($conn, "SELECT masyarakat.*, count(pengaduan.id_pengaduan) as jml FROM masyarakat LEFT JOIN pengaduan ON masyarakat.nik = pengaduan.nik
        GROUP BY masyarakat.nik ORDER BY masyarakat.nik DESC");
        foreach ($query1 as $dt) {
            foreach($query2 as $jml) {
                if($jml['nik'] == $dt['nik']){
        ?> 
        <tr>
            <td><?=$dt['nik']?></td>
            <td><?=$dt['nama']?></td>
            <td><?=$dt['username']?></td>
            <td><?=$dt['telp']?></td>
            <td><a href="index2.php?lihat_laporan_masyarakat&nik=<?=$dt['nik']?>" style="color:black;text-decoration: none;">(<?=$jml['jml']?>)laporan</a></td>
            <td>  
            <button><i data-fa-symbol="delete" class="fa-solid fa-trash fa-fw" data-bs-toggle="modal" data-bs-target="#hapusM<?=$dt['nik']?>"></i></button>
            <button><i class="fa-solid fa-pen-to-square" data-bs-toggle="modal" data-bs-target="#kirim<?=$dt['nik']?>"></i></button>
            </td>
    </tr>
    <div class="modal fade" id="kirim<?=$dt['nik']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="post">
          <div class="modal-body">
          <input type="hidden" id="nik_lama" name="nik_lama" value="<?php echo $dt['nik']?>">
          <div class="form-group">
                            <label for="nik">Nik:</label>
                            <input type="text" class="form-control" id="nik" name="nik" value="<?php echo $dt['nik']?>" autocomplete = "off" placeholder="Masukkan nik">
            </div>

        <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $dt['nama']?>" autocomplete = "off" placeholder="Masukkan nama">
            </div>

        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $dt['username']?>" autocomplete = "off" placeholder="Masukkan username">
            </div>
            <div class="form-group">
                                    <label for="password">Password Lama:</label>
                                    <input type="password" class="form-control" id="password" name="password" value="" autocomplete = "off" placeholder="Masukkan password lama">
                    </div>
                    <div class="form-group">
                                    <label for="passNew">Password Baru:</label>
                                    <input type="password" class="form-control" id="passNew" name="passNew" value="" autocomplete = "off" placeholder="Ubah Password?">
                    </div>
        <div class="form-group">
                            <label for="telp">Telp:</label>
                            <input type="text" class="form-control" id="telp" name="telp" value="<?php echo $dt['telp']?>" autocomplete = "off" placeholder="Masukkan No. telp">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary" name="kirim">ubah</button>
          </div>
          </form>
        </div>
      </div>
    </div>
<!-- Modal -->
<div class="modal fade" id="hapusM<?=$dt['nik']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action="" method="post">
            <div class="modal-body">
                <input type="hidden" name="nik" value="<?=$dt['nik']?>">
                Yakin hapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal </button>
                <button type="submit" class="btn btn-primary" name="hapusM">Hapus</button>
            </div>
        </form>
    </div>
  </div>
</div>
        <?php
        }}}
        ?>
<!-- Button trigger modal -->
<button type="button" class="btn btn10" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
 <h6> User baru </h6>
</button>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">user baru</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post">
      <div class="modal-body">
      <div class="form-group">
                        <label for="nik">Nik:</label>
                        <input type="text" class="form-control" id="nik" name="nik" autocomplete = "off" placeholder="Masukkan nik">
         </div>

		 <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" autocomplete = "off" placeholder="Masukkan nama">
        </div>

		 <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" autocomplete = "off" placeholder="Masukkan username">
        </div>

		<div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" autocomplete = "off" placeholder="Masukkan password">
        </div>

		<div class="form-group">
                        <label for="password2">Konfirmasi Password:</label>
                        <input type="password" class="form-control" id="password" name="password2" autocomplete = "off" placeholder="Masukkan kembali password">
                    </div>

		<div class="form-group">
                        <label for="telp">Telp:</label>
                        <input type="text" class="form-control" id="telp" name="telp" autocomplete = "off" placeholder="Masukkan No. telp">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" name="tambahM">Kirim</button>
      </div>
      </form>
    </div>
  </div>
</div>
</table>