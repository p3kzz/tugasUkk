<?php
if(isset($_POST['ubahP'])){
    $id_petugas=$_POST['id_petugas'];
    $nama_petugas =$_POST['nama_petugas'];
    $username =$_POST['username'];
    $telp =$_POST['telp'];
    $password =$_POST['password'];
    $passNew =$_POST['passNew'];
    $data_lama = mysqli_query($conn, "SELECT * FROM petugas WHERE id_petugas = '$id_petugas'");
    $dtlm = mysqli_fetch_array($data_lama);
    if(!empty($password)) {
        if(md5($password) == $dtlm['password']) {
            if($username !== $dtlm['username']) {
                $cekusername = mysqli_query($conn, "SELECT * FROM petugas WHERE username = '$username'");
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
                mysqli_query($conn, "UPDATE petugas SET nama_petugas='$nama_petugas',username='$username',password='$pass',telp='$telp' WHERE id_petugas='$id_petugas'");
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

if(isset($_POST['hapusM'])){
    $id_petugas =$_POST['id_petugas'];
    $cari = mysqli_query($conn, "SELECT * FROM petugas WHERE id_petugas = '$id_petugas' ");
    if(mysqli_num_rows($cari) > 0) {
     foreach($cari as $i) {
        $a = $i['id_petugas'];
        $hapus = mysqli_query($conn, "DELETE FROM tanggapan WHERE id_petugas = '$a'");
     }
     $hapus = mysqli_query($conn, "DELETE FROM petugas WHERE id_petugas = '$id_petugas'");
     $hapus = mysqli_query($conn, "DELETE FROM tanggapan WHERE id_tanggapan = '$id_petugas'");
    } else {
        $hapus = mysqli_query($conn, "DELETE FROM petugas WHERE id_petugas = '$id_petugas'");
        $hapus = mysqli_query($conn, "DELETE FROM tanggapan WHERE id_tanggapan = '$id_petugas'");
    }
    if($hapus) {
        $error="data berhasil dihapus";
    }else {
        $error = "data gagal dihapus";
    }
} 
if(isset($_POST['tambahm'])){
    $nama_petugas = strtolower(stripslashes($_POST['nama_petugas']));
    $username = strtolower(stripslashes($_POST['username']));
    $password = strtolower(stripslashes($_POST['password']));
    $password2 = strtolower(stripslashes($_POST['password2']));
    $telp = strtolower(stripslashes($_POST['telp']));
    if(!empty($_POST['nama_petugas']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['telp'])){
        //cek konfirmasi password
        if ( $password == $password2) {
            $pass = md5($password);
            mysqli_query($conn, "INSERT INTO petugas VALUES('', '$nama_petugas', '$username','$pass', '$telp', 'petugas')");
            $error = "Tambah petugas Berhasil!";  
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
    if(isset($_POST['hapusm'])){
        $hapus = mysqli_query($conn, "DELETE FROM petugas WHERE id_petugas = '$id_petugas'");
        $hapus = mysqli_query($conn, "DELETE FROM tanggapan WHERE id_petugas = '$id_petugas'");
    }

?>
<div class="datapetugas">
  <h4>DATA PETUGAS</h4>
</div>
<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr class="table-dark">
                <th>Id petugas</th>
                <th>Nama </th>
                <th>Username</th>
                <th>telp</th>
                <th>Laporan yang ditanggapi</th>
                <th>....</th>
            </tr>
            </thead>
            <?php
        $query1  =mysqli_query($conn, "SELECT * FROM petugas ORDER BY petugas.id_petugas ASC");
        $query2= mysqli_query($conn, "SELECT petugas.*, count(tanggapan.id_tanggapan) as jml FROM petugas 
        LEFT JOIN tanggapan ON tanggapan.id_petugas = petugas.id_petugas
        GROUP BY petugas.id_petugas ORDER BY petugas.id_petugas DESC");
        foreach ($query1 as $dt) {
            foreach($query2 as $jml) {
                if($jml['id_petugas'] == $dt['id_petugas']){
        ?> 
        <tr>
            <td><?=$dt['id_petugas']?></td>
            <td><?=$dt['nama_petugas']?></td>
            <td><?=$dt['username']?></td>
            <td><?=$dt['telp']?></td>
            <td><a href="index2.php?lihat_laporan_petugas&id_petugas=<?=$dt['id_petugas']?>" style="color:black;text-decoration: none;">(<?=$jml['jml']?>)laporan yang ditanggapi</td>
            <td> 
                <?php if($dt['level']!='admin'){?>
                <button>
                    <i data-fa-symbol="delete" class="fa-solid fa-trash fa-fw" data-bs-toggle="modal" data-bs-target="#hapusm<?=$dt['id_petugas']?>"></i>
                </button>
                <button>
                    <i class="fa-solid fa-pen-to-square" data-bs-toggle="modal" data-bs-target="#ubah<?=$dt['id_petugas']?>"></i>
                </button>
                <?php } ?>
            </td>
        </tr>
        <div class="modal fade" id="ubah<?=$dt['id_petugas']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                <div class="modal-body">
                <div class="form-group">
                                    <label for="id_petugas">Id petugas:</label>
                                    <input type="text" class="form-control" id="id_petugas" name="id_petugas" value="<?php echo $dt['id_petugas']?>" autocomplete = "off" placeholder="Masukkan nik">
                    </div>

                <div class="form-group">
                                    <label for="nama_petugas">Nama petugas:</label>
                                    <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" value="<?php echo $dt['nama_petugas']?>" autocomplete = "off" placeholder="Masukkan nama">
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
                    <button type="submit" class="btn btn-primary" name="ubahP">Kirim</button>
                </div>
                </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="hapusm<?=$dt['id_petugas']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="id_petugas" value="<?=$dt['id_petugas']?>">
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
 <button type="button" class="btn btn20" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
 <h6> User baru </h6>
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post">
      <div class="modal-body">

		 <div class="form-group">
                        <label for="nama_petugas">nama petugas:</label>
                        <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" autocomplete = "off" placeholder="Masukkan nama">
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
        <button type="submit" class="btn btn-primary" name="tambahm">Kirim</button>
      </div>
      </form>
    </div>
  </div>
</div>
</table>