<?php

//include koneksi database
include('koneksi.php');

//get data dari form
$perusahaan = $_POST['perusahaan'];
$auditjob = $_POST['auditjob'];
$auditor = $_POST['auditor'];
$startdate = $_POST['startdate'];
$budget = $_POST['budget'];
$actual = $_POST['actual'];
$targetdate = $_POST['targetdate'];
$status = $_POST['status'];

//query insert data ke dalam database
$query = "INSERT INTO auditplan (perusahaan, auditjob, auditor, startdate, budget, actual, targetdate, status) VALUES ('$perusahaan', '$auditjob', '$auditor', '$startdate', '$budget', '$actual', '$targetdate', '$status')";
echo $query;
//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if($connection->query($query)) {

    //redirect ke halaman index.php 
    header("location: ./auditplan.php");

} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}

?>