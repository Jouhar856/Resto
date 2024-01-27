<h3>Insert User</h3>
<div>
    <form action="" method="post" class="form-group">
        <div class="mb-3 w-50">
            <label for="" class="form-label">Nama User</label>
            <input type="text" name="user" required placeholder="Isi user" class="form-control">
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
        <div class="mb-3 w-50">
            <label for="">Level</label>
            <br>
            <select name="level" id=""  class="mt-2">
                <option value="Admin">Admin</option>
                <option value="Koki">Koki</option>
                <option value="Kasir">Kasir</option>
            </select>
        </div>
        <div class="">
            <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
        </div>
    </form>
</div>

<?php 

    if (isset($_POST['simpan'])) {
        $user = $_POST['user'];
        $email = $_POST['email'];
        $password = hash('sha256',$_POST['password']);
        $konfirmasi = hash('sha256',$_POST['konfirmasi']);
        $level = $_POST['level'];

        if ($password == $konfirmasi) {
            $sql = "INSERT INTO user VALUES ('','$user','$email','$password','$level',1)";
            // echo $sql;
            $db->runSQL($sql);
            header("location:?f=user&m=select");
        }else {
            echo "<h1>Password Tidak Sama</h1>";
        }
        
    }

?>
