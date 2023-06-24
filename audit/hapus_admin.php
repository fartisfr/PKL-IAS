<?php
// echo $_SESSION['status'];
// exit();
	// cek apakah yang mengakses halaman ini sudah login
    // cek level user
	//if($_SESSION['status']=="admin")
    //{        //jika status admin akan melakukan proses delete record
        include('koneksi.php');
        //get id
        $id = $_GET['id'];

        $query = "DELETE FROM user WHERE username = '$id'";

        if($connection->query($query)) {
            header("location: ./akun_admin.php");
        } else {
            echo "DATA GAGAL DIHAPUS!";
        }
   // }
?>