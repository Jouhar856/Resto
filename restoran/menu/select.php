<div class="float-start me-4">
    <a class="btn btn-primary" href="?f=menu&m=insert" role="button">Tambah Data</a>
</div>
<h3>Menu</h3>

<!-- php untuk pencarian berdasarkan combobox -->
<?php 

    if (isset($_POST['opsi'])) {
        $opsi = $_POST['opsi'];

        $where = "WHERE idkategori = $opsi";
        // echo $where;
    }else {
        $opsi = 0;
        $where = "";
    }

?>

<!-- php untuk combobox -->
<div class="mt-4 mb-4">
    <?php 
    
        $row = $db->getALL("SELECT * FROM kategori ORDER BY kategori ASC")

    ?>
    <form action="" method="post">
        <select name="opsi" id="" onchange="this.form.submit()">
            <?php foreach ($row as $key) : ?>
            <option <?php if($key['idkategori']==$opsi) echo "selected"; ?> value="<?php echo $key['idkategori'] ?>">
                <?php echo $key['kategori'] ?>
            </option>
            <?php endforeach ?>
        </select>
    </form>

</div>

<!-- php untuk menampilkan data -->
<?php 

    $jumlah = $db->getCOUNT("SELECT * FROM menu $where");
    $banyak = 3;
    $halaman = ceil($jumlah / $banyak);

    if (isset($_GET['p'])) {
        $p = $_GET['p'];
        $mulai = ($p * $banyak) - $banyak;
    }else {
        $mulai = 0;
    }

    $sql = "SELECT * FROM menu $where ORDER BY menu ASC LIMIT $mulai,$banyak";
    $row = $db->getALL($sql);

    // var_dump($row);
    $no = $mulai + 1;

?>

<!-- menampilkan data ditable -->
<table class="table table-bordered w-80">
    <thead>
        <tr>
            <th>No</th>
            <th>Menu</th>
            <th>Gambar</th>
            <th>Harga</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($row)) : ?>
        <?php foreach ($row as $key): ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $key['menu'] ?></td>
            <td><img src="../upload/<?php echo $key['gambar'] ?>" style="width: 80px;" alt=""></td>
            <td><?php echo $key['harga'] ?></td>
            <td><a href="?f=menu&m=delete&id=<?php echo $key['idmenu'] ?>">Delete</a></td>
            <td><a href="?f=menu&m=update&id=<?php echo $key['idmenu'] ?>">Update</a></td>
        </tr>
        <?php endforeach ?>
        <?php endif ?>
    </tbody>
</table>

<!-- untuk pindah halaman -->
<?php 

    for ($i=1; $i <= $halaman; $i++) { 
        echo '<a class="link-offset-2 link-underline link-underline-opacity-0" href="?f=menu&m=select&p='.$i.'">'.$i.'</a>';
        echo '&nbsp &nbsp &nbsp';
    }

?>

