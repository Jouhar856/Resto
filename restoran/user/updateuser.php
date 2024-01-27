<?php 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $row = $db->getITEM("SELECT * FROM user WHERE iduser = $id");
}

?>

<h3>Update User</h3>
<div>
    <form action="" method="post" class="form-group">
        <div class="mb-3 w-50">
            <label for="" class="form-label">Nama User</label>
            <input type="text" name="user" required value="<?php echo $row['user'] ?>" class="form-control">
        </div>
        <div class="mb-3 w-50">
            <label for="" class="form-label">Email</label>
            <input type="email" name="email" required value="<?php echo $row['email'] ?>" class="form-control">
        </div>
        <div class="mb-3 w-50">
            <label for="" class="form-label">Password</label>
            <input type="password" name="password" required value="<?php echo $row['password'] ?>" class="form-control">
        </div>
        <div class="mb-3 w-50">
            <label for="" class="form-label">Konfirmasi Password</label>
            <input type="password" name="konfirmasi" required value="<?php echo $row['password'] ?>" class="form-control">
        </div>
        <div class="mb-3 w-50">
            <label for="">Level</label>
            <br>
            <select name="level" id=""  class="mt-2">
                <option value="admin" <?php if($row['level'] == "Admin") echo "selected" ?>>Admin</option>
                <option value="koki" <?php if($row['level'] == "Koki") echo "selected" ?>>Koki</option>
                <option value="kasir" <?php if($row['level'] == "Kasir") echo "selected" ?>>Kasir</option>
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
            $sql = "UPDATE user SET user = '$user', email = '$email', password = '$password', level = '$level' WHERE iduser = $id";
            // echo $sql;
            $db->runSQL($sql);
            header("location:?f=user&m=select");
        }else {
            echo "<h1>Password Tidak Sama</h1>";
        }
        
    }

?>
