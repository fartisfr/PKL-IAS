<?php
if (session_status() === PHP_SESSION_NONE) {
  session_name('audit_sess');
  session_start();
}

// cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['status'] == "") {
  header("location:index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Post Audit</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <script language="JavaScript" type="text/javascript">
    function checkDelete() {
      return confirm('Are you sure?');
    }

    function changeRespon(kode, event) {
      const val = event.target.value;

      const xhr = new XMLHttpRequest();
      xhr.open('POST', 'update_respon_postaudit.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onload = function() {
        console.log(this.responseText);
      }
      xhr.send(`kode=${kode}&respon=${val}`);

    }
  </script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake img-circle" src="dist/img/mgmboscologo.jpg" alt="MGM Bosco Logo" height="80" width="80">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php
    include "./menu.php";
    ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">POST AUDIT</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                <li class="breadcrumb-item active">POST AUDIT</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">POST AUDIT</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="overflow-x:auto;">
              <a href="./add_postaudit.php" class="btn btn-md btn-success" style="margin-bottom: 10px">ADD POST AUDIT</a>
              <a target='_blank' href="./print_postaudit.php" class="btn btn-md btn-primary" style="margin-bottom: 10px">PRINT</a>
              <table id="example1" class="table table-bordered table-striped">
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
                    <th scope="col"></th>
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
                          <td><select name="respon" id="respon" onchange="changeRespon('<?= $row['kode'] ?>', event)">
                              <option value="Not Yet" <?php echo $row['respon'] == "Not Yet" ? "selected" : "" ?>>Not Yet</option>
                              <option value="On Progress" <?php echo $row['respon'] == "On Progress" ? "selected" : "" ?>>On Progress</option>
                              <option value="Done" <?php echo $row['respon'] == "Done" ? "selected" : "" ?>>Done</option>
                            </select></td>
                          <td><?php echo $row['note'] ?></td>
                          <td width="100px" class="text-center">
                            <a href="./edit_postaudit.php?id=<?php echo $row['kode'] ?>" class="btn btn-icon fas fa-edit btn-sm btn-info"></a>
                            <a href="./hapus_postaudit.php?id=<?php echo $row['kode'] ?>" class="btn-icon fas fa-trash btn-sm btn-danger" onclick="return checkDelete()"></a>
                          </td>
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
                          <td><select name="respon" id="respon" onchange="changeRespon('<?= $row['kode'] ?>', event)">
                              <option value="Not Yet" <?php echo $row['respon'] == "Not Yet" ? "selected" : "" ?>>Not Yet</option>
                              <option value="On Progress" <?php echo $row['respon'] == "On Progress" ? "selected" : "" ?>>On Progress</option>
                              <option value="Done" <?php echo $row['respon'] == "Done" ? "selected" : "" ?>>Done</option>
                            </select></td>
                          <td><?php echo $row['note'] ?></td>
                          <td width="100px" class="text-center">
                            <a href="./edit_auditprogram.php?id=<?php echo $row['kode'] ?>" class="btn btn-icon fas fa-edit btn-sm btn-info"></a>
                            <a href="./hapus_auditprogram.php?id=<?php echo $row['kode'] ?>" class="btn-icon fas fa-trash btn-sm btn-danger" onclick="return checkDelete()"></a>
                          </td>
                        </tr>
                  <?php
                      }
                      $urutan++;
                    }
                  } ?>
                  </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>




          <!-- /.row -->
          <!-- Main row -->

          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Internal Audit System</strong>
      <div class="float-right d-none d-sm-inline-block">
        PT Mulia Bosco Utama
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>

  <!-- DataTables  & Plugins -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="plugins/jszip/jszip.min.js"></script>
  <script src="plugins/pdfmake/pdfmake.min.js"></script>
  <script src="plugins/pdfmake/vfs_fonts.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script>
    $(function() {
      $("#auditplan").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["csv", "excel", "print"]
      }).buttons().container().appendTo('#auditplan_wrapper .col-md-6:eq(0)');
      $('#auditplan2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

  <script>
    $(function() {
      $("#example1").DataTable({
        dom: 'Bfrtip',
        buttons: [
          'copy', 'csv', 'excel'
        ]
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "tableTools": {
          "sExtends": "pdf",
          "SPdfOrientation": "landscape",
        }
      });
    });
  </script>



</body>

</html>