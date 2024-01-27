<div class="float-start me-4">
    <a class="btn btn-primary" href="?f=kategori&m=insert" role="button">Tambah Data</a>
</div>
<h3>Kategori</h3>

<?php 

    $jumlah = $db->getCOUNT("SELECT * FROM kategori");
    $banyak = 3;
    $halaman = ceil($jumlah / $banyak);

    if (isset($_GET['p'])) {
        $p = $_GET['p'];
        $mulai = ($p * $banyak) - $banyak;
    }else {
        $mulai = 0;
    }

    $sql = "SELECT * FROM kategori ORDER BY kategori ASC LIMIT $mulai,$banyak";
    $row = $db->getALL($sql);

    // var_dump($row);
    $no = $mulai + 1;

?>

<table class="table table-bordered w-50 mt-4">
    <thead>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($row)) : ?>
        <?php foreach ($row as $key): ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $key['kategori'] ?></td>
            <td><a href="?f=kategori&m=delete&id=<?php echo $key['idkategori'] ?>">Delete</a></td>
            <td><a href="?f=kategori&m=update&id=<?php echo $key['idkategori'] ?>">Update</a></td>
        </tr>
        <?php endforeach ?>
        <?php endif ?>
    </tbody>
</table>

<?php 

    for ($i=1; $i <= $halaman; $i++) { 
        echo '<a class="link-offset-2 link-underline link-underline-opacity-0" href="?f=kategori&m=select&p='.$i.'">'.$i.'</a>';
        echo '&nbsp &nbsp &nbsp';
    }

?>