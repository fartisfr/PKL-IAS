<?php

//include koneksi database
include('koneksi.php');

$perusahaan = $_POST['perusahaan'];
$auditjob = $_POST['auditjob'];
$scope = $_POST['scope'];
$finding = $_POST['finding'];
$amount = $_POST['amount'];
$lossrecovery = $_POST['lossrecovery'];
$sisa = $_POST['sisa'];
$root = $_POST['root'];
$risk = $_POST['risk'];
$rekomen = $_POST['rekomen'];
$weakness = $_POST['weakness'];
$target = $_POST['target'];
// $auditor = $_POST['auditor'];
$respon = $_POST['respon'];
$note = $_POST['note'];

// Get the kode from auditplan
$query_auditplan = "SELECT kode FROM auditplan WHERE perusahaan = '$perusahaan' AND auditjob = '$auditjob'";
$result_auditplan = $connection->query($query_auditplan);
$row_auditplan = $result_auditplan->fetch_assoc();
$kode_auditplan = $row_auditplan['kode'];

//query insert data ke dalam database
$query = "INSERT INTO postaudit (kode_auditplan, scope, finding, amount, lossrecovery, sisa, root, risk, rekomen, weakness, target, respon, note) 
VALUES ('$kode_auditplan', '$scope', '$finding', '$amount', '$lossrecovery', '$sisa', '$root', '$risk', '$rekomen', '$weakness', '$target', '$respon', '$note')";

//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if ($result = $connection->query($query)) {

    //redirect ke halaman index.php 
    header("location: ./postaudit.php");
} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";
}
