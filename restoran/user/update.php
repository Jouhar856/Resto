<?php 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $row = $db->getITEM("SELECT * FROM user WHERE iduser = $id");
    if ($row['status'] == 1) {
        $aktif = 0;
    }else {
        $aktif = 1;
    }
    $sql = "UPDATE user SET status = $aktif WHERE iduser = $id";
    $db->runSQL($sql);
    header("location:?f=user&m=select");
}

?>
