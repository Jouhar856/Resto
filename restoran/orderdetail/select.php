<h3>Detail Pembelian</h3>

<div>
    <form action="" method="post" class="form-group">
        <div class="mb-3 w-30 float-start">
            <label for="" class="form-label mt-1">Tanggal Awal</label>
            <input type="date" name="tawal" required class="form-control">
        </div>
        <div class="mb-3 w-30 float-start ms-2">
            <label for="" class="form-label mt-1">Tanggal Akhir</label>
            <input type="date" name="takhir" required class="form-control">
        </div>
        <div class="ms-3 float-start mt-4">
            <input type="submit" name="simpan" value="Cari" class="btn btn-primary">
        </div>
    </form>
</div>

<?php 

    $jumlah = $db->getCOUNT("SELECT * FROM vdetail ");
    $banyak = 4;
    $halaman = ceil($jumlah / $banyak);

    if (isset($_GET['p'])) {
        $p = $_GET['p'];
        $mulai = ($p * $banyak) - $banyak;
    }else {
        $mulai = 0;
    }

    $sql = "SELECT * FROM vdetail ORDER BY status, idorderdetail DESC LIMIT $mulai,$banyak";
    if (isset($_POST['simpan'])) {
        $tawal = $_POST['tawal'];
        $takhir = $_POST['takhir'];

        // $sql = "SELECT * FROM vdetail WHERE tglorder BETWEEN '$tawal' AND '$takhir'";

    }
    
    $row = $db->getALL($sql);

    // var_dump($row);
    $no = $mulai + 1;
    $total = 0;
?>

<table class="table table-bordered w-70 mt-4">
    <thead>
        <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Menu</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($row)) : ?>
        <?php foreach ($row as $key): ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $key['pelanggan'] ?></td>
            <td><?php echo $key['tglorder'] ?></td>
            <td><?php echo $key['menu'] ?></td>
            <td><?php echo $key['harga'] ?></td>
            <td><?php echo $key['jumlah'] ?></td>
            <td><?php echo $key['harga'] * $key['jumlah'] ?></td>
            <td><?php echo $key['alamat'] ?></td>

            <?php 
                $total = $total + ($key['harga'] * $key['jumlah'])
            ?>

        </tr>
        <?php endforeach ?>
        <?php endif ?>
        <tr>
            <td colspan="6"><h3>Grand Total</h3></td>
            <td colspan="2"><h4><?php echo $total ?></h4></td>
        </tr>
    </tbody>
</table>

<?php 

    for ($i=1; $i <= $halaman; $i++) { 
        echo '<a class="link-offset-2 link-underline link-underline-opacity-0" href="?f=orderdetail&m=select&p='.$i.'">'.$i.'</a>';
        echo '&nbsp &nbsp &nbsp';
    }

?>