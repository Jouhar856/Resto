
<h3>Menu</h3>

<div class="mt-4 mb-4">
    <?php 
    
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $where = "WHERE idkategori = $id";
            $id = "&id=".$id;
        }else {
            $where = "";
            $id = "";
        }

    ?>
</div>

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

<?php if(!empty($row)) : ?>
    <?php foreach ($row as $key): ?>
            <div class="card" style="width: 15rem; float: left; margin: 10px;">
            <img style="height: 150px;" src="upload/<?php echo $key['gambar'] ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $key['menu'] ?></h5>
                    <p class="card-text"><?php echo $key['harga'] ?></p>
                    <a href="?f=home&m=beli&id=<?php echo $key['idmenu'] ?>" class="btn btn-primary">Beli</a>
                </div>
            </div>
        <?php endforeach ?>
    <?php endif ?>
<div style="clear: both;">
    <?php 

        for ($i=1; $i <= $halaman; $i++) { 
            echo '<a class="link-offset-2 link-underline link-underline-opacity-0" href="?f=home&m=produk&p='.$i.$id.'">'.$i.'</a>';
            echo '&nbsp &nbsp &nbsp';
        }

    ?>
</div>

