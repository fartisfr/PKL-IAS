<?php

include('koneksi.php');
$query = mysqli_query($connection, "SELECT * FROM auditplan ORDER BY datecreated DESC");
$no = 1;
echo '<table>';
while ($row = mysqli_fetch_array($query)) {
    $urutan = 1;
    $kode = $row['kode'];
    $subquery = mysqli_query($connection, "SELECT * FROM auditprogram
    where kode_auditplan = $kode ORDER BY datecreated DESC");
    while ($subrow = mysqli_fetch_array($subquery)) {
        $urutan++;
        echo '<tr>';
        echo '<td>' . $no++ . '</td>';
        echo '<td>' . $row['perusahaan'] . '</td>';
        echo '<td>' . $row['auditjob'] . '</td>';
        echo '<td>' . $row['auditor'] . '</td>';
        echo '<td>' . $subrow['strategy'] . '</td>';
        echo '<td>' . $subrow['program'] . '</td>';
        echo '<td>' . $subrow['tools'] . '</td>';
        echo '<td>' . $subrow['schedule'] . '</td>';
        echo '</tr>';
    }
}
echo '</table>';
