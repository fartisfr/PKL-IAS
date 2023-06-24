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
    <title>Audit Plan</title>
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
<h1>Audit Plan</h1>
<table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">PERUSAHAAN</th>
                    <th scope="col">AUDIT JOB</th>
                    <th scope="col">AUDITOR</th>
                    <th scope="col">START DATE</th>
                    <th scope="col">BUDGET</th>
                    <th scope="col">ACTUAL</th>
                    <th scope="col">TARGET DATE</th>
                    <th scope="col">ACTION</th>
                    <th scope="col">STATUS</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php 
                      include('koneksi.php');
                      $no = 1;
                      $query = mysqli_query($connection,"SELECT * FROM auditplan ORDER BY datecreated DESC");
                      while($row = mysqli_fetch_array($query)){
						  
						  
                  ?>

                  <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $row['perusahaan'] ?></td>
                      <td><?php echo $row['auditjob'] ?></td>
                      <td><?php echo $row['auditor'] ?></td>
                      <td><?php echo $row['startdate'] ?></td>
                      <td><?php echo number_format($row['budget'], '0', ',', '.') ?></td>
                      <td><?php echo number_format($row['actual'], '0', ',', '.') ?></td>
                      <td><?php echo $date2 = $row['targetdate'] ?></td>
                      <td>
                        <?php
                          $date_now = strtotime("now");
                          $date2    = strtotime($date2);
                          //$date_now = strtotime($date_now);

                          if ($date_now < $date2) {

                          //"<td style='background-color:#50e73c;'> ON SCHEDULE </td>"; <td style='background-color:#e74c3c;'> OVERDUE </td>";
                          //badge badge-info
                            if ($row['status']=="Done"){
                              echo "<span class='badge badge-success'>DONE</span> ";
                            }else{
                              echo "<span class='badge badge-primary'>ON SCHEDULE</span> ";
                            }
                          } else {
                            if ($row['status']=="Done"){
                              echo "<span class='badge badge-success'>DONE</span> ";
                            }else{
                              echo  "<span class='badge badge-danger'>OVERDUE</span> ";
                            }
                        } ?>
                        </td>
                        <td><?php echo $date2 = $row['status'] ?></td>
                  </tr>

                  <?php } ?>
                  </tfoot>
                </table>
            </body>
</html>
