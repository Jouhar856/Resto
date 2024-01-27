<h3>Order</h3>

<?php 
    
    $jumlah = $db->getCOUNT("SELECT * FROM vorder ");
    $banyak = 3;
    $halaman = ceil($jumlah / $banyak);

    if (isset($_GET['p'])) {
        $p = $_GET['p'];
        $mulai = ($p * $banyak) - $banyak;
    }else {
        $mulai = 0;
    }

    $sql = "SELECT * FROM vorder ORDER BY status, idorder ASC LIMIT $mulai,$banyak";
    $row = $db->getALL($sql);

    // var_dump($row);
    $no = $mulai + 1;

?>

<table class="table table-bordered w-70 mt-4">
    <thead>
        <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Tanggal Order</th>
            <th>Total</th>
            <th>Bayar</th>
            <th>Kembali</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($row)) : ?>
        <?php foreach ($row as $key): ?>
            <?php 
                if ($key['status'] == 0) {
                    $status = '<a href="?f=order&m=bayar&id='.$key['idorder'].'">Bayar</a>';
                }else {
                    $status = 'Lunas';
                }
            ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $key['pelanggan'] ?></td>
            <td><?php echo $key['tglorder'] ?></td>
            <td><?php echo $key['total'] ?></td>
            <td><?php echo $key['bayar'] ?></td>
            <td><?php echo $key['kembali'] ?></td>
            <td><?php echo $status ?></td>
        </tr>
        <?php endforeach ?>
        <?php endif ?>
    </tbody>
</table>

<?php 

    for ($i=1; $i <= $halaman; $i++) { 
        echo '<a class="link-offset-2 link-underline link-underline-opacity-0" href="?f=order&m=select&p='.$i.'">'.$i.'</a>';
        echo '&nbsp &nbsp &nbsp';
    }

?>