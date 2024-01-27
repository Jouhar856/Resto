<?php 

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM menu WHERE idmenu = $id";
        $item = $db->getITEM($sql);

        $idkategori = $item['idkategori'];
        $gambar = $item['gambar'];

        // echo $idkategori.' '.$gambar;
    }

    $row = $db->getALL("SELECT * FROM kategori ORDER BY kategori ASC")
?>

<h3>Update Menu</h3>

<div>
    <form action="" method="post" class="form-group" enctype="multipart/form-data">
        <div class="mb-3 w-50">
            <label for="" class="form-label">Kategori</label>
            <br>
            <select name="idkategori">
                <?php foreach ($row as $key) : ?>
                    <option <?php if ($idkategori == $key['idkategori']) echo "selected" ?> value="<?php echo $key['idkategori'] ?>" >
                        <?php echo $key['kategori'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>    
        
        <div class="mb-3 w-50">
            <label for="" class="form-label">Menu</label>
            <input type="text" name="menu" value="<?php echo$item['menu'] ?>" required class="form-control">
        </div>
        <div class="mb-3 w-50">
            <label for="" class="form-label">Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div>
        <div class="mb-3 w-50">
            <label for="" class="form-label">Harga</label>
            <input type="number" name="harga" value="<?php echo$item['harga'] ?>" required class="form-control">
        </div>
        <div class="">
            <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
        </div>
    </form>
</div>

<?php 

    if (isset($_POST['simpan'])) {
        $menu = $_POST['menu'];
        $idkategori = $_POST['idkategori'];
        $gambar = $item['gambar'];
        $temp = $_FILES['gambar']['tmp_name'];
        $harga = $_POST['harga'];

        if (!empty($temp)) {
            $gambar = $_FILES['gambar']['name']; 
            move_uploaded_file($temp,'../upload/'.$gambar);
        }

        $sql = "UPDATE menu SET idkategori = $idkategori, menu = '$menu', gambar = '$gambar', harga = '$harga' WHERE idmenu = $id";

        $db->runSQL($sql);
        header("location:?f=menu&m=select");
        // echo $sql;
        
    }

?>