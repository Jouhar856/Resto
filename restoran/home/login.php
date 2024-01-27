
 <div class="row">
    <div class="col-4 mx-auto mt-4">
        <div>
            <h3>Login Restoran</h3>
            </div>
                <div>
                    <form action="" method="post" class="form-group">
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" name="email" required placeholder="Isi Email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Password</label>
                            <input type="password" name="password" required placeholder="Isi Password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <center><input type="submit" name="login" value="Login" class="btn btn-primary"></center>
                      </div>
            </form>
        </div>
    </div>
</div>


<?php 

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM pelanggan WHERE email = '$email' AND password = '$password' AND status = 1";
        // echo $sql;
        $c = $db->getCOUNT($sql);
        // echo $c."";
        if ($c == 0) {
            echo "<h3>Email atau password salah</h3>";
        }else {
            $sql = "SELECT * FROM pelanggan WHERE email = '$email' AND password = '$password'";
            $row = $db->getITEM($sql);

            $_SESSION['pelanggan'] = $row['email'];
            $_SESSION['idpelanggan'] = $row['idpelanggan'];
            header("location:index.php");
            // var_dump($_SESSION['user']);
        }
    }

?>