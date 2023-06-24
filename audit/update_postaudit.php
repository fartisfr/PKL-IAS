<?php

//include koneksi database
include('koneksi.php');

//get data dari form
$kode = $_POST['kode'];
// $perusahaan = $_POST['perusahaan'];
// $auditjob = $_POST['auditjob'];
$finding = $_POST['finding'];
$scope = $_POST['scope'];
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

//query update data ke dalam database berdasarkan ID
$query = "UPDATE postaudit SET finding = '$finding', scope = '$scope', amount = '$amount', lossrecovery = '$lossrecovery', sisa = '$sisa', root = '$root', risk = '$risk', rekomen = '$rekomen', weakness = '$weakness', target = '$target', respon = '$respon', note = '$note' WHERE kode = '$kode'";

//kondisi pengecekan apakah data berhasil diupdate atau tidak
if ($connection->query($query)) {
    //redirect ke halaman index.php 
    header("location: ./postaudit.php");
} else {
    //pesan error gagal update data
    echo "Data Gagal Diupate!";
}
