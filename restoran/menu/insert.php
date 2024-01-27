<?php 

    $row = $db->getALL("SELECT * FROM kategori ORDER BY kategori ASC")

?>

<h3>Insert Menu</h3>
<div>
    <form action="" method="post" class="form-group" enctype="multipart/form-data">
        <div class="mb-3 w-50">
            <label for="" class="form-label">Kategori</label>
            <br>
            <select name="idkategori">
                <?php foreach ($row as $key) : ?>
                    <option value="<?php echo $key['idkategori'] ?>">
                        <?php echo $key['kategori'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>    
        <div class="mb-3 w-50">
            <label for="" class="form-label">Menu</label>
            <input type="text" name="menu" required placeholder="Isi menu" class="form-control">
        </div>
        <div class="mb-3 w-50">
            <label for="" class="form-label">Gambar</label>
            <input type="file" name="gambar" required placeholder="Isi gambar" class="form-control">
        </div>
        <div class="mb-3 w-50">
            <label for="" class="form-label">Harga</label>
            <input type="number" name="harga" required placeholder="Isi harga" class="form-control">
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
        echo $idkategori;
        $gambar = $_FILES['gambar']['name'];
        $temp = $_FILES['gambar']['tmp_name'];
        $harga = $_POST['harga'];

        if (empty($gambar)) {
            echo "Gambar Kosong";
        }else {
            $sql = "INSERT INTO menu VALUES ('',$idkategori,'$menu','$gambar',$harga)";
            echo $sql;
            move_uploaded_file($temp,'../upload/'.$gambar);
            $db->runSQL($sql);
            header("location:?f=menu&m=select");
        }
        
    }

?>