<?php

//include koneksi database
include('koneksi.php');

$perusahaan = $_POST['perusahaan'];
$auditjob = $_POST['auditjob'];
$strategy = $_POST['strategy'];
$program = $_POST['program'];
// $auditee = $_POST['auditee'];
$tools = $_POST['tools'];
$schedule = $_POST['schedule'];
$statuspr = $_POST['statuspr'];
$result = $_POST['result'];
$note = $_POST['note'];

// Get the kode from auditplan
$query_auditplan = "SELECT kode FROM auditplan WHERE perusahaan = '$perusahaan' AND auditjob = '$auditjob'";
$result_auditplan = $connection->query($query_auditplan);
$row_auditplan = $result_auditplan->fetch_assoc();
$kode_auditplan = $row_auditplan['kode'];


//query insert data ke dalam database
$query = "INSERT INTO auditprogram (kode_auditplan, strategy, program, tools, schedule, statuspr, result, note) VALUES ('$kode_auditplan', '$strategy', '$program', '$tools', '$schedule', '$statuspr', '$result', '$note')";

//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if ($result = $connection->query($query)) {

    //redirect ke halaman index.php 
    header("location: ./auditprogram.php");
} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";
}
