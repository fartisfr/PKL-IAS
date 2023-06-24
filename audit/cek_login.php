<?php

//aktif session
if (session_status() === PHP_SESSION_NONE) {
    session_name('audit_sess');
    session_start();
}else{
    session_destroy();
    session_name('audit_sess');
    session_start();
}
include('koneksi.php');

$username = $_POST['username'];
$password = $_POST['password'];
$password_x = md5($password);

//menyeleksi data user
$query = "SELECT * from user where username='$username' and password='$password_x'";

$resQuery = mysqli_query($connection,$query);
$dtQuery = mysqli_fetch_array($resQuery);


//menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($resQuery);

//cek apakah username dan password ditemukan pada database
if($cek>0){

    //memasukkan data dari login ke $data dalam bentuk array
    $data=mysqli_fetch_assoc($resQuery);

    //cek jika user login sebagai admin
    //if($data['status']=="user"){

        //buat session login dan username
        $_SESSION['username'] = $username;
        $_SESSION['nama']= $dtQuery['nama'];
        $_SESSION['email']= $dtQuery['email'];
        $_SESSION['status'] = $dtQuery['status'];

        //alihkan ke halaman dashboard mahasiswa
        header("location:index.php");
    //}
}
else{
    header("location:login.php?pesan=gagal");
}
?>