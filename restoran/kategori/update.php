<?php 

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM kategori WHERE idkategori = $id";
        $row = $db->getITEM($sql);
    }

?>

<h3>Update Kategori</h3>
<div>
    <form action="" method="post" class="form-group">
        <div class="mb-3 w-50">
            <label for="" class="form-label">Kategori</label>
            <input type="text" name="kategori" required class="form-control" value="<?php echo$row['kategori'] ?>" >
        </div>
        <div class="">
            <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
        </div>
    </form>
</div>

<?php 

    if (isset($_POST['simpan'])) {
        $kategori = $_POST['kategori'];

        $sql = "UPDATE kategori SET kategori = '$kategori' WHERE idkategori = $id";
        // echo $sql;
        $db->runSQL($sql);
        header("location:?f=kategori&m=select");
    }

?>