<?php

$conn = mysqli_connect('localhost','root','','pengaduan_masyarakat');
if(!$conn) {
    echo"ok";
}

function registrasi($data) {
    global $conn;
    $nik = strtolower(stripslashes($data["nik"]));
    $nama = strtolower(stripslashes($data["nama"]));
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $telp = ($data["telp"]);
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
        return $error;
    }
//pengaduan
function pengaduan($data){
    global $conn;
$tgl_pengaduan = $data['tgl_pengaduan'];
$tujuan_laporan = $data['tujuan_laporan'];
$nik = $_SESSION['user']['nik'];
$isi_laporan = $data['isi_laporan'];
$foto = "apa";

mysqli_query($conn,"INSERT INTO pengaduan VALUES('','$tgl_pengaduan','$nik',''$tujuan_laporan', $isi_laporan','$foto')");
header("location:lapor.php");
return mysqli_affected_rows($conn);
}

?>



