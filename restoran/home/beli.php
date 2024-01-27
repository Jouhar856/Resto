<h3>Keranjang :</h3>
<?php 

    if (isset($_GET['hapus'])) {
        $id = $_GET['hapus'];
        unset($_SESSION['_'.$id]);
        header("location:?f=home&m=beli");
    }
    
    if (isset($_GET['tambah'])) {
        $id = $_GET['tambah'];
        $_SESSION['_'.$id]++;
    }
    
    if (isset($_GET['kurang'])) {
        $id = $_GET['kurang'];
        $_SESSION['_'.$id]--;
        if ($_SESSION['_'.$id] == 0) {
            unset($_SESSION['_'.$id]);
            header("location:?f=home&m=beli");
        }
    }

    if (!isset($_SESSION['pelanggan'])) {
        header("location:?f=home&m=login");
    }else {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            isi($id);
            header("location:?f=home&m=beli");
        }else {
            keranjang();
        }
    }

    function isi($id) {
        if (isset($_SESSION['_'.$id])) {
            $_SESSION['_'.$id]++;
        }else {
            $_SESSION['_'.$id]=1;
        }
    }

    function keranjang() {

        global $db, $total;

        $total = 0;

        echo '
            <table class="table table-bordered w-75 mt-4">
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Hapus</th>
                </tr>
            </thead>
            <tbody>
        ';
        foreach ($_SESSION as $key => $value) {
            if ($key <> 'pelanggan' && $key <> 'idpelanggan' && $key <> 'user' && $key <> 'iduser' && $key <> 'level') {
                $id = substr($key,1);

                $sql = "SELECT * FROM menu WHERE idmenu = $id";

                $row = $db->getALL($sql);

                foreach ($row as $r) {
                    echo '<tr>';
                        echo '<td>'.$r['menu'].'</td>';
                        echo '<td>'.$r['harga'].'</td>';
                        echo '<td> <a href="?f=home&m=beli&tambah='.$r['idmenu'].'">[+]</a> &nbsp'.$value.'&nbsp <a href="?f=home&m=beli&kurang='.$r['idmenu'].'">[-]</a></td>';
                        echo '<td>'.$r['harga'] * $value.'</td>';
                        echo '<td><a href="?f=home&m=beli&hapus='.$r['idmenu'].'">Hapus</a></td>';
                    echo '</tr>';
                    $total = $total + ($value * $r['harga']);
                }
            }
            
        }

        echo '
            <tr>
                <td colspan=4><h3>Total Semua</h3></td>
                <td><h3>'.$total.'</h3></td>
           </tr>
           ';

        echo '
            </tbody>
            </table>
        ';
    }

    

?>
<?php if (!empty($total)) :?>
<a href="?f=home&m=checkout&total=<?php echo $total ?>" class="btn btn-primary">Check Out</a>
<?php endif ?>