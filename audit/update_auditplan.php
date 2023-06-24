<?php

//include koneksi database
include('koneksi.php');

//get data dari form
$kode = $_POST['kode'];
$perusahaan = $_POST['perusahaan'];
$auditjob = $_POST['auditjob'];
$auditor = $_POST['auditor'];
$startdate = $_POST['startdate'];
$budget = $_POST['budget'];
$actual = $_POST['actual'];
$targetdate = $_POST['targetdate'];
$status = $_POST['status'];

//query update data ke dalam database berdasarkan ID
$query = "UPDATE auditplan SET perusahaan = '$perusahaan', auditjob = '$auditjob', auditor = '$auditor', startdate = '$startdate', budget = '$budget', actual = '$actual', targetdate = '$targetdate', status = '$status'
WHERE kode = '$kode'";
echo $query;

//kondisi pengecekan apakah data berhasil diupdate atau tidak
if($connection->query($query)) {
    //redirect ke halaman index.php 
    header("location: ./auditplan.php");
} else {
    //pesan error gagal update data
    echo "Data Gagal Diupate!";
}

?>