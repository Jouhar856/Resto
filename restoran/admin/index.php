<?php 

    session_start();
    require_once "../dbcontroller.php";
    $db = new DB;

    if (!isset($_SESSION['user'])) {
        header("location:login.php");
    }

    if (isset($_GET['log'])) {
        session_destroy();
        header("location:index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <title>Admin Page | Aplikasi Restoran</title>
</head>
<body>
    
    <div class="container">
    
        <div class="row">
            <div class="col-md-3 mt-4">
                <h3><a class="link-offset-2 link-underline link-underline-opacity-0" href="index.php">Admin Page</a></h3>
            </div>
            <div class="col-md-9">
                <div class="float-end mt-4 me-4"><a href="?log=logout">Logout</a></div>
                <div class="float-end mt-4 me-4 ms-4">Level : <?php echo $_SESSION['level'] ?></div>
                <div class="float-end mt-4 me-3 ms-4">User : <a href="?f=user&m=updateuser&id=<?php echo $_SESSION['iduser'] ?>"><?php echo $_SESSION['user'] ?></a></div>
                <!-- <?php var_dump($_SESSION) ?> -->
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-3 mt-4">
                <ul class="nav flex-column">
                    <?php 

                        $level = $_SESSION['level'];
                        switch ($level) {
                            case 'Admin':
                                echo '
                                    <li class="nav-item"><a class="nav-link" href="?f=kategori&m=select">Kategori</a></li>
                                    <li class="nav-item"><a class="nav-link" href="?f=menu&m=select">Menu</a></li>
                                    <li class="nav-item"><a class="nav-link" href="?f=pelanggan&m=select">Pelanggan</a></li>
                                    <li class="nav-item"><a class="nav-link" href="?f=order&m=select">Order</a></li>
                                    <li class="nav-item"><a class="nav-link" href="?f=orderdetail&m=select">Order Detail</a></li>
                                    <li class="nav-item"><a class="nav-link" href="?f=user&m=select">User</a></li>
                                    
                                ';
                                break;
                            case 'Kasir' :
                                echo '
                                    <li class="nav-item"><a class="nav-link" href="?f=order&m=select">Order</a></li>
                                    <li class="nav-item"><a class="nav-link" href="?f=orderdetail&m=select">Order Detail</a></li>
                                ';
                                break;
                            case 'Koki' :
                                echo '
                                    <li class="nav-item"><a class="nav-link" href="?f=orderdetail&m=select">Order Detail</a></li>
                                ';
                                break;
                            
                            default:
                                # code...
                                break;
                        }
                    
                    ?>

                    </ul>
            </div>
            <div class="col-md-9">
                <?php 

                    if(isset($_GET['f']) && isset($_GET['m'])){
                        $f = $_GET['f'];
                        $m = $_GET['m'];

                        $file = '../'.$f.'/'.$m.'.php';
                        require_once $file;
                    }

                ?>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col">
                <p class="text-center">
                    copyright@jauhharimu@gmail.com
                </p>
            </div>
        </div>

    </div>

</body>
</html>