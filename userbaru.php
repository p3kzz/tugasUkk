<?php
 require 'koneksi.php';
 if(isset($_POST["registrasi"])){

	$error = registrasi($_POST);
 }
?>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Launch static backdrop modal
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
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
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>