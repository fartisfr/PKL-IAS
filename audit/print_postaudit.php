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
    <title>Post Audit</title>
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
<h1>Post Audit</h1>
<table style='border: 1px solid black' id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">PERUSAHAAN</th>
                    <th scope="col">AUDIT JOB</th>
                    <th scope="col">AUDITOR</th>
                    <th scope="col">SCOPE</th>
                    <th scope="col">FINDING</th>
                    <th scope="col">AMOUNT</th>
                    <th scope="col">LOSS RECOVERY</th>
                    <th scope="col">SISA</th>
                    <th scope="col">ROOT CAUSE</th>
                    <th scope="col">RISK</th>
                    <th scope="col">RECOMMENDATION</th>
                    <th scope="col">WEAKNESS</th>
                    <th scope="col">TARGET</th>
                    <th scope="col">RESPON AUDITEE</th>
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

                    $query = mysqli_query($connection, "SELECT * FROM postaudit where kode_auditplan = $kode ORDER BY datecreated DESC");
                    $urutan = 1;
                    while ($row = mysqli_fetch_array($query)) {


                      if ($urutan == 1) {

                  ?>
                        <tr>



                          <td><?php echo $no++ ?></td>
                          <td><?php echo $row3['perusahaan'] ?></td>
                          <td><?php echo $row3['auditjob'] ?></td>
                          <td><?php echo $row3['auditor'] ?></td>
                          <td><?php echo $row['scope'] ?></td>
                          <td><?php echo $row['finding'] ?></td>
                          <td><?php echo $row['amount'] ?></td>
                          <td><?php echo $row['lossrecovery'] ?></td>
                          <td><?php echo $row['sisa'] ?></td>
                          <td><?php echo $row['root'] ?></td>
                          <td><?php echo $row['risk'] ?></td>
                          <td><?php echo $row['rekomen'] ?></td>
                          <td><?php echo $row['weakness'] ?></td>
                          <td><?php echo $row['target'] ?></td>
                          <td><?php echo $row['respon'] ?></td>
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
                          <td><?php echo $row['scope'] ?></td>
                          <td><?php echo $row['finding'] ?></td>
                          <td><?php echo $row['amount'] ?></td>
                          <td><?php echo $row['lossrecovery'] ?></td>
                          <td><?php echo $row['sisa'] ?></td>
                          <td><?php echo $row['root'] ?></td>
                          <td><?php echo $row['risk'] ?></td>
                          <td><?php echo $row['rekomen'] ?></td>
                          <td><?php echo $row['weakness'] ?></td>
                          <td><?php echo $row['target'] ?></td>
                          <td><?php echo $row['respon'] ?></td>
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
