<?php 
if (session_status() === PHP_SESSION_NONE) {
  session_name('audit_sess');
  session_start();
}
  
	// cek apakah yang mengakses halaman ini sudah login
  // cek level user
	if($_SESSION['status']==""){
    //jika belum login langsung redirect ke halaman login.php
		header("location:login.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Program</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
    <style type="text/css" media="print">
  @page { size: landscape; }
</style>
</head>
<body onload='window.print()'>
<img src="images/mgmbosco.jpg" width="400" height="150" alt="IMG">
<h1>Audit Program</h1>
<table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">PERUSAHAAN</th>
                    <th scope="col">AUDIT JOB</th>
                    <th scope="col">AUDITOR</th>
                    <th scope="col">AUDIT STRATEGY</th>
                    <th scope="col">PROGRAM</th>
                    <th scope="col">TOOLS</th>
                    <th scope="col">SCHEDULE</th>
                    <th scope="col">STATUS</th>
                    <th scope="col">RESULT</th>
                    <th scope="col">NOTE</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  include('koneksi.php');
                  $no = 1;

                  $query2 = mysqli_query($connection, "SELECT * FROM auditplan ORDER BY datecreated DESC");
                  while ($row3 = mysqli_fetch_array($query2)) {
                    $kode = $row3['kode'];
                    $query = mysqli_query($connection, "SELECT * FROM auditprogram
                    where kode_auditplan = $kode ORDER BY datecreated DESC");
                    $urutan = 1;
                    while ($row = mysqli_fetch_array($query)) {


                      if ($urutan == 1) {
                  ?>

                        <tr>
                          <td><?php echo $no++ ?></td>
                          <td><?php echo $row3['perusahaan'] ?></td>
                          <td><?php echo $row3['auditjob'] ?></td>
                          <td><?php echo $row3['auditor'] ?></td>
                          <td><?php echo $row['strategy'] ?></td>
                          <td><?php echo $row['program'] ?></td>
                          <td><?php echo $row['tools'] ?></td>
                          <td><?php echo $row['schedule'] ?></td>
                          <td><?php echo $row['statuspr'] ?></td>
                          <td><?php echo $row['result'] ?></td>
                          <td><?php echo $row['note'] ?></td>
                        </tr>
                      <?php
                      } else {
                      ?>
                        <tr>

                          <td><?php echo $no++ ?></td>
                          <td> </td>
                          <td> </td>
                          <td> </td>
                          <td><?php echo $row['strategy'] ?></td>
                          <td><?php echo $row['program'] ?></td>
                          <td><?php echo $row['tools'] ?></td>
                          <td><?php echo $row['schedule'] ?></td>
                          <td><?php echo $row['statuspr'] ?></td>
                          <td><?php echo $row['result'] ?></td>
                          <td><?php echo $row['note'] ?></td>
                        </tr>
                  <?php
                      }
                      $urutan++;
                    }
                  } ?>
                  </tfoot>
              </table>
            </body>
</html>
