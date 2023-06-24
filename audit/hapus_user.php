<?php
    include('koneksi.php');
    //get id

    $username = $_GET['id'];

    $query = "DELETE FROM user WHERE username = '$username'";

    if($connection->query($query)) {
        header("location: ./akun_user.php");
    } else {
        echo "DATA GAGAL DIHAPUS!";
    }

?>