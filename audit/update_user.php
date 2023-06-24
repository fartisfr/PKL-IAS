<?php

//include koneksi database
include('koneksi.php');

//get data dari form
$username = $_POST['username'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$password = $_POST['password'];

//get value dari selected user
$id = $_GET['id'];


//mengecek password terisi atau tidak
if(!empty($password)){
    $password_x = md5($password);
    $query = "UPDATE user SET username = '$username', nama = '$nama', email = '$email', password = '$password_x'
                WHERE username = '$id'";
                echo $query; 
} else {
    //asumsinya kalau password tidak diisi,mengunakan password lama
    $query = "UPDATE user SET username = '$username', nama = '$nama', email = '$email'
                WHERE username = '$id'";
}


//kondisi pengecekan apakah data berhasil diupdate atau tidak
if($connection->query($query)) {
    //redirect ke halaman index.php 
    header("location: akun_user.php");
} else {
    //pesan error gagal update data
    echo "Data Gagal Diupate!";
}

?>