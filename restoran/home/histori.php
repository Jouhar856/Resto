<h3>Histori</h3>

<?php 
    $email = $_SESSION['pelanggan'];
    $jumlah = $db->getCOUNT("SELECT * FROM vorder WHERE email = '$email'");
    $banyak = 2;
    $halaman = ceil($jumlah / $banyak);

    if (isset($_GET['p'])) {
        $p = $_GET['p'];
        $mulai = ($p * $banyak) - $banyak;
    }else {
        $mulai = 0;
    }

    $sql = "SELECT * FROM vorder WHERE email = '$email' ORDER BY tglorder DESC LIMIT $mulai,$banyak";
    $row = $db->getALL($sql);

    // var_dump($row);
    $no = $mulai + 1;

?>

<table class="table table-bordered w-70 mt-4">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Order</th>
            <th>Total</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($row)) : ?>
        <?php foreach ($row as $key): ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $key['tglorder'] ?></td>
            <td><?php echo $key['total'] ?></td>
            <td><a href="?f=home&m=detail&id=<?php echo $key['idorder'] ?>">Detail</a></td>
        </tr>
        <?php endforeach ?>
        <?php endif ?>
    </tbody>
</table>

<?php 

    for ($i=1; $i <= $halaman; $i++) { 
        echo '<a class="link-offset-2 link-underline link-underline-opacity-0" href="?f=home&m=histori&p='.$i.'">'.$i.'</a>';
        echo '&nbsp &nbsp &nbsp';
    }

?>