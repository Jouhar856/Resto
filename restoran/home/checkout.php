<?php 

    if (isset($_GET['total'])) {
        $total = $_GET['total'];
        $idorder = idOrder();
        $idpelanggan = $_SESSION['idpelanggan'];
        $tgl = date("Y-m-d");

        $sql = "SELECT * FROM mainorder WHERE idorder = $idorder";
        $count = $db->getCOUNT($sql);
        if ($count == 0) {
            insertOrder($idorder, $idpelanggan, $tgl, $total);
            insertOrderDetail($idorder);
        }else {
            insertOrderDetail($idorder);
        }
        kosongSession();
        header("location:?f=home&m=checkout");
    }else {
        info();
    }

    function idOrder() {
        global $db;
        $sql = "SELECT * FROM mainorder ORDER BY idorder DESC";
        $jumlah = $db->getCOUNT($sql);

        if ($jumlah == 0) {
            $id = 1;
        }else {
            $item = $db->getITEM($sql);
            $id = $item['idorder']+1;
        }

        return $id;
    }

    function insertOrder($idorder, $idpelanggan, $tgl, $total) {
        global $db;

        $sql = "INSERT INTO mainorder VALUES ($idorder, $idpelanggan, '$tgl', $total, 0, 0, 0)";
        // echo $sql;
        $db->runSQL($sql);
    }

    function insertOrderDetail($idorder) {
        global $db;

        foreach ($_SESSION as $key => $value) {
            if ($key <> 'pelanggan' && $key <> 'idpelanggan' && $key <> 'user' && $key <> 'iduser' && $key <> 'level') {
                $id = substr($key,1);
                $sql = "SELECT * FROM menu WHERE idmenu = $id";
                $row = $db->getALL($sql);

                foreach ($row as $r) {
                    $idmenu = $r['idmenu'];
                    $harga = $r['harga'];
                    $sql = "INSERT INTO orderdetail VALUES ('', $idorder, $idmenu, $value, $harga)";
                    $db->runSQL($sql);
                    // echo $sql;
                }

            }
        }
    }

    function kosongSession() {
        foreach ($_SESSION as $key => $value) {
            if ($key <> 'pelanggan' && $key <> 'idpelanggan') {
                $id = substr($key,1);
               
                unset($_SESSION['_'.$id]);
            }
        }
    }

    function info() {
        echo '<h3>Terima Kasih Sudah Berbelanja</h3>';
    }

?>