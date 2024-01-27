<?php 

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM mainorder WHERE idorder = $id";
        $row = $db->getITEM($sql);
    }

?>

<h3>Pembayaran</h3>
<div>
    <form action="" method="post" class="form-group">
        <div class="mb-3 w-50">
            <label for="" class="form-label">Total</label>
            <input type="number" name="total" disabled class="form-control" value="<?php echo$row['total'] ?>" >
        </div>
        <div class="mb-3 w-50">
            <label for="" class="form-label">Bayar</label>
            <input type="number" name="bayar" required class="form-control">
        </div>
        <div class="">
            <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
        </div>
    </form>
</div>

<?php 

    if (isset($_POST['simpan'])) {
        $bayar = $_POST['bayar'];
        $total = $_POST['total'];
        $kembali = ceil($bayar - $row['total']);

        $sql = "UPDATE mainorder SET bayar = $bayar, kembali = $kembali, status = 1 WHERE idorder = $id";
        if ($kembali < 0) {
            echo '<h3>Pembayaran Kurang</h3>';
        }else {
            // echo $sql;
            $db->runSQL($sql);
            header("location:?f=order&m=select");
        }
    }

?>
