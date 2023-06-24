<?php
if (session_status() === PHP_SESSION_NONE) {
  session_name('audit_sess');
  session_start();
}

// cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['status'] == "") {
  header("location:index.php?pesan=gagal");
}

?>

<?php

include('koneksi.php');

$id = $_GET['id'];

$query = "SELECT * FROM auditprogram INNER JOIN auditplan WHERE kode_auditplan = auditplan.kode AND auditprogram.kode = $id LIMIT 1";

$result = mysqli_query($connection, $query);

$row = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

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
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
              <h1 class="m-0">Audit Program</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                <li class="breadcrumb-item active">Audit Program</li>
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

          <div class="card card-warning">
            <div class="card-header">
              <h3 class="card-title">Edit Audit Program</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="./update_auditprogram.php" method="POST">
                <div class="row">
                  <div class="col-sm-12">
                    <!-- text input -->

                    <input hidden type="text" name="kode" value="<?php echo $id ?>" placeholder="Input Code" class="form-control">

                    <div class="form-group">
                      <label>Perusahaan</label>
                      <input readonly type="text" name="perusahaan" value="<?php echo $row['perusahaan'] ?>" placeholder="Input Perusahaan" class="form-control" required="">
                    </div>

                    <div class="form-group">
                      <label>Audit Job</label>
                      <input readonly type="text" name="auditjob" value="<?php echo $row['auditjob'] ?>" placeholder="Input Audit Job" class="form-control" required="">
                    </div>

                    <div class="form-group">
                      <label>Auditor</label>
                      <input readonly type="text" name="auditor" value="<?php echo $row['auditor'] ?>" placeholder="Input Auditor" class="form-control" required="">
                    </div>

                    <div class="form-group">
                      <label>Strategy</label>
                      <input type="text" name="strategy" value="<?php echo $row['strategy'] ?>" placeholder="Input Strategy" class="form-control" required="">
                    </div>

                    <div class="form-group">
                      <label>Program</label>
                      <input type="text" name="program" value="<?php echo $row['program'] ?>" placeholder="Input Program" class="form-control" required="">
                    </div>

                    <div class="form-group">
                      <label>Tools</label>
                      <input type="text" name="tools" value="<?php echo $row['tools'] ?>" placeholder="Input tools" class="form-control" required="">
                    </div>

                    <div class="form-group">
                      <label>Schedule</label>
                      <input type="date" name="schedule" value="<?php echo $row['schedule'] ?>" placeholder="Input Schedule" class="form-control" required="">
                    </div>

                    <div class="form-group">
                      <label>Status</label>
                      <select name="statuspr" id="statuspr" class="form-control" required>
                        <option value="<?php echo $row['statuspr'] ?>" selected><?php echo $row['statuspr'] ?></option>
                        <?php $statuspr = array("Not Yet", "On Progress", "Done");
                        foreach ($statuspr as $value) {
                          if ($value == $row['statuspr']) {
                            echo '<option value="' . $value . '" selected>' . $value . '</option>';
                          } else {
                            echo '<option value="' . $value . '">' . $value . '</option>';
                          }
                        }
                        ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Result</label>
                      <select name="result" id="result" class="form-control" required>
                        <option value="<?php echo $row['result'] ?>" selected><?php echo $row['result'] ?></option>
                        <?php $result = array("OK", "NOT OK", "N/A");
                        foreach ($result as $value) {
                          if ($value == $row['result']) {
                            echo '<option value="' . $value . '" selected>' . $value . '</option>';
                          } else {
                            echo '<option value="' . $value . '">' . $value . '</option>';
                          }
                        }
                        ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Note</label>
                      <input type="note" name="note" value="<?php echo $row['note'] ?>" placeholder="Input Note" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <a href="./auditprogram.php" id="cancel" name="cancel" class="btn btn-secondary">Cancel</a>
                  </div>
              </form>
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
  <!-- AdminLTE for demo purposes -->

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
        "buttons": ["csv", "excel", "pdf", "print"]
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


</body>

</html>