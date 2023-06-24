<?php
        include('koneksi.php');

//get id
$id = $_GET['id'];

//Begin transaction
$connection->begin_transaction();

$query1 = "DELETE FROM auditplan WHERE kode = '$id'";
$query2 = "DELETE FROM auditprogram WHERE kode_auditplan = '$id'";
$query3 = "DELETE FROM postaudit WHERE kode_auditplan = '$id'";

if ($connection->query($query1) && $connection->query($query2) && $connection->query($query3)) {
    //Commit transaction if all queries execute successfully
    $connection->commit();
    header("location: ./auditplan.php");
} else {
    //Rollback transaction if any query fails
    $connection->rollback();
    echo "DATA GAGAL DIHAPUS!";
}

?>