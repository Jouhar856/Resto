<h3>Insert Kategori</h3>
<div>
    <form action="" method="post" class="form-group">
        <div class="mb-3 w-50">
            <label for="" class="form-label">Kategori</label>
            <input type="text" name="kategori" required placeholder="Isi kategori" class="form-control">
        </div>
        <div class="">
            <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
        </div>
    </form>
</div>

<?php 

    if (isset($_POST['simpan'])) {
        $kategori = $_POST['kategori'];

        $sql = "INSERT INTO kategori VALUES ('','$kategori')";
        // echo $sql;
        $db->runSQL($sql);
        header("location:?f=kategori&m=select");
    }

?>