<h3>Registrasi Pelanggan</h3>
<div>
    <form action="" method="post" class="form-group">
        <div class="mb-3 w-50">
            <label for="" class="form-label">Nama Pelanggan</label>
            <input type="text" name="pelanggan" required placeholder="Isi pelanggan" class="form-control">
        </div>
        <div class="mb-3 w-50">
            <label for="" class="form-label">Alamat</label>
            <input type="text" name="alamat" required placeholder="Isi alamat" class="form-control">
        </div>
        <div class="mb-3 w-50">
            <label for="" class="form-label">Telp</label>
            <input type="text" name="telp" required placeholder="Isi telp" class="form-control">
        </div>
        <div class="mb-3 w-50">
            <label for="" class="form-label">Email</label>
            <input type="email" name="email" required placeholder="Isi email" class="form-control">
        </div>
        <div class="mb-3 w-50">
            <label for="" class="form-label">Password</label>
            <input type="password" name="password" required placeholder="Isi password" class="form-control">
        </div>
        <div class="mb-3 w-50">
            <label for="" class="form-label">Konfirmasi Password</label>
            <input type="password" name="konfirmasi" required placeholder="Isi password" class="form-control">
        </div>
        <div class="">
            <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
        </div>
    </form>
</div>

<?php 

    if (isset($_POST['simpan'])) {
        $pelanggan = $_POST['pelanggan'];
        $alamat = $_POST['alamat'];
        $telp = $_POST['telp'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $konfirmasi = $_POST['konfirmasi'];

        if ($password == $konfirmasi) {
            $sql = "INSERT INTO pelanggan VALUES ('','$pelanggan','$alamat','$telp','$email','$password',1)";
            // echo $sql;
            $db->runSQL($sql);
            header("location:?f=home&m=info");
        }else {
            echo "<h1>Password Tidak Sama</h1>";
        }
        
    }

?>
