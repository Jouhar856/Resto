<?php 
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    $jumlahdata = $db->getCOUNT("SELECT idorderdetail FROM vdetail WHERE idorder = $id");
    $banyak = 3;
    $halaman = ceil($jumlahdata / $banyak);


    if (isset($_GET['p'])) {
        $p = $_GET['p'];
        $mulai = ($p * $banyak) - $banyak;
    }else {
        $mulai = 0;
    }

    $sql = "SELECT * FROM vdetail WHERE idorder = $id ORDER BY idorderdetail ASC LIMIT $mulai,$banyak";
    $row = $db->getALL($sql);

    // var_dump($row);
    $no = $mulai + 1;

?>

<h3>Detail Histori</h3>

<table class="table table-bordered w-70 mt-4">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Order</th>
            <th>Menu</th>
            <th>Harga</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($row)) : ?>
        <?php foreach ($row as $key): ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $key['tglorder'] ?></td>
            <td><?php echo $key['menu'] ?></td>
            <td><?php echo $key['harga'] ?></td>
            <td><?php echo $key['jumlah'] ?></td>
            
        </tr>
        <?php endforeach ?>
        <?php endif ?>
    </tbody>
</table>

<?php 

    for ($i=1; $i <= $halaman; $i++) { 
        echo '<a class="link-offset-2 link-underline link-underline-opacity-0" href="?f=home&m=detail&id='.$id.'&p='.$i.'">'.$i.'</a>';
        echo '&nbsp &nbsp &nbsp';
    }

?>