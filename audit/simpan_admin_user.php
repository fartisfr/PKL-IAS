<?php

//include koneksi database
include('koneksi.php');

//get data dari form
$nama = $_POST['nama'];
$email = $_POST['email'];
$userupdt = $_POST['username'];
$password = $_POST['password'];
$password_x = md5($password);
$status = $_POST['status'];

// cek kesamaan username
$query = "SELECT * FROM user WHERE username = '$userupdt'";
$result = $connection->query($query);
$dtQuery = mysqli_fetch_array($result);
$count = mysqli_num_rows($result);

// cek kesamaan email
$query2 = "SELECT * FROM user WHERE email = '$email' ";
$result2 = $connection->query($query2);
$dtQuery2 = mysqli_fetch_array($result2);
$count2 = mysqli_num_rows($result2);

if ($count > 0 && $count2 > 0) {
        echo
        "<script>
        alert('username dan email telah digunakan');
        document.location.href = 'add_admin_user.php';
        </script>
        ";
}
else if ($count > 0) {
        echo
        "<script>
        alert('username telah digunakan');
        document.location.href = 'add_admin_user.php';
        </script>
        ";
}
else if ($count2 > 0) {
    echo
    "<script>
    alert('email telah digunakan');
    document.location.href = 'add_admin_user.php';
    </script>
    ";
}else {

        //query insert data ke dalam database
        $query = "INSERT INTO user (nama, email, username, password, status) VALUES ('$nama', '$email', '$userupdt', '$password_x','$status')";
    
        //kondisi pengecekan apakah data berhasil dimasukkan atau tidak
        if($connection->query($query)) {
            //redirect ke halaman index.php
            if($status == "user"){
                header("location: akun_user.php"); 
            }else{
                header("location: akun_admin.php"); 
            }
        } else {
            //pesan error gagal insert data
            echo "Data Gagal Disimpan!";
        }
}        

?>