<?php


 include('koneksi.php');

$sql = "SELECT * FROM postaudit";
//$budget = mysqli_query($connection,"select sum(budget) AS Totalbudget from auditplan ");

$result = $connection->query($sql);

if ($result->num_rows > 0) {

    $data[0][0] = 'Browser';
    $data[0][1] = 'Percentage';
    $x = 1;
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $data[$x][0] = $row["browser"];
        $data[$x][1] = (float)$row["percentage"];
        $x++;
    }
} else {
    die("No records");
}

echo(json_encode($data));