<?php 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $row = $db->getITEM("SELECT * FROM pelanggan WHERE idpelanggan = $id");
    if ($row['status'] == 1) {
        $aktif = 0;
    }else {
        $aktif = 1;
    }
    $sql = "UPDATE pelanggan SET status = $aktif WHERE idpelanggan = $id";
    $db->runSQL($sql);
    header("location:?f=pelanggan&m=select");
}

?>
