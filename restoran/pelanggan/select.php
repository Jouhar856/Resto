<h3>Pelanggan</h3>

<?php 

    $jumlah = $db->getCOUNT("SELECT * FROM pelanggan");
    $banyak = 3;
    $halaman = ceil($jumlah / $banyak);

    if (isset($_GET['p'])) {
        $p = $_GET['p'];
        $mulai = ($p * $banyak) - $banyak;
    }else {
        $mulai = 0;
    }

    $sql = "SELECT * FROM pelanggan ORDER BY pelanggan ASC LIMIT $mulai,$banyak";
    $row = $db->getALL($sql);

    // var_dump($row);
    $no = $mulai + 1;

?>

<table class="table table-bordered w-80">
    <thead>
        <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Alamat</th>
            <th>Telp</th>
            <th>Email</th>
            <th>Delete</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($row)) : ?>
        <?php foreach ($row as $key): ?>
        <tr>
            <?php 
                if ($key['status'] == 1) {
                    $status = 'Aktif';
                }else {
                    $status = 'Tidak Aktif';
                }
            ?>
            <td><?php echo $no++ ?></td>
            <td><?php echo $key['pelanggan'] ?></td>
            <td><?php echo $key['alamat'] ?></td>
            <td><?php echo $key['telp'] ?></td>
            <td><?php echo $key['email'] ?></td>
            <td><a href="?f=pelanggan&m=delete&id=<?php echo $key['idpelanggan'] ?>">Delete</a></td>
            <td><a href="?f=pelanggan&m=update&id=<?php echo $key['idpelanggan'] ?>"><?php echo $status ?></a></td>
        </tr>
        <?php endforeach ?>
        <?php endif ?>
    </tbody>
</table>

<?php 

    for ($i=1; $i <= $halaman; $i++) { 
        echo '<a class="link-offset-2 link-underline link-underline-opacity-0" href="?f=pelanggan&m=select&p='.$i.'">'.$i.'</a>';
        echo '&nbsp &nbsp &nbsp';
    }

?>