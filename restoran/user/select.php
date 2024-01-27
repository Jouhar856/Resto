<div class="float-start me-4">
    <a class="btn btn-primary" href="?f=user&m=insert" role="button">Tambah Data</a>
</div>
<h3>User</h3>

<?php 

    $jumlah = $db->getCOUNT("SELECT * FROM user");
    $banyak = 3;
    $halaman = ceil($jumlah / $banyak);

    if (isset($_GET['p'])) {
        $p = $_GET['p'];
        $mulai = ($p * $banyak) - $banyak;
    }else {
        $mulai = 0;
    }

    $sql = "SELECT * FROM user ORDER BY user ASC LIMIT $mulai,$banyak";
    $row = $db->getALL($sql);

    // var_dump($row);
    $no = $mulai + 1;

?>

<table class="table table-bordered w-80 mt-4">
    <thead>
        <tr>
            <th>No</th>
            <th>User</th>
            <th>Email</th>
            <th>Level</th>
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
                    $status = 'Banned';
                }
            ?>
            <td><?php echo $no++ ?></td>
            <td><?php echo $key['user'] ?></td>
            <td><?php echo $key['email'] ?></td>
            <td><?php echo $key['level'] ?></td>
            <td><a href="?f=user&m=delete&id=<?php echo $key['iduser'] ?>">Delete</a></td>
            <td><a href="?f=user&m=update&id=<?php echo $key['iduser'] ?>"><?php echo $status ?></a></td>
        </tr>
        <?php endforeach ?>
        <?php endif ?>
    </tbody>
</table>

<?php 

    for ($i=1; $i <= $halaman; $i++) { 
        echo '<a class="link-offset-2 link-underline link-underline-opacity-0" href="?f=user&m=select&p='.$i.'">'.$i.'</a>';
        echo '&nbsp &nbsp &nbsp';
    }

?>