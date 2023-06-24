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

<?php

include('koneksi.php');

$id = $_GET['id'];

$query = "SELECT * FROM postaudit INNER JOIN auditplan WHERE kode_auditplan = auditplan.kode AND postaudit.kode = $id LIMIT 1";

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
              <h1 class="m-0">Post Audit</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                <li class="breadcrumb-item active">Post Audit</li>
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
              <h3 class="card-title">Edit Post Audit</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="./update_postaudit.php" method="POST">
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
                      <label>Finding</label>
                      <input type="text" name="finding" value="<?php echo $row['finding'] ?>" placeholder="Input Audit Job" class="form-control">
                    </div>

                    <div class="form-group">
                      <label>Scope</label>
                      <input type="text" name="scope" value="<?php echo $row['scope'] ?>" placeholder="Input Scope" class="form-control" required="">
                    </div>

                    <div class="form-group">
                      <label>Amount</label>
                      <input type="number" name="amount" value="<?php echo $row['amount'] ?>" placeholder="Input Scope" class="form-control">
                    </div>

                    <div class="form-group">
                      <label>Loss Recovery</label>
                      <input type="number" name="lossrecovery" value="<?php echo $row['lossrecovery'] ?>" placeholder="Input Loss" class="form-control">
                    </div>

                    <div class="form-group">
                      <label>Sisa</label>
                      <input type="number" name="sisa" value="<?php echo $row['sisa'] ?>" placeholder="Input Sisa" class="form-control">
                    </div>

                    <div class="form-group">
                      <label>Root</label>
                      <input type="text" name="root" value="<?php echo $row['root'] ?>" placeholder="Input Root" class="form-control">
                    </div>

                    <div class="form-group">
                      <label>Risk For Company</label>
                      <input type="text" name="risk" value="<?php echo $row['risk'] ?>" placeholder="Input Risk" class="form-control">
                    </div>

                    <div class="form-group">
                      <label>Recommendation</label>
                      <input type="text" name="rekomen" value="<?php echo $row['rekomen'] ?>" placeholder="Input Recommendation" class="form-control">
                    </div>

                    <div class="form-group">
                      <label>Weakness</label>
                      <select name="weakness" id="weakness" class="form-control" required>
                        <option value="<?php echo $row['weakness'] ?>" selected><?php echo $row['weakness'] ?></option>
                        <option value="Human Resource">Human Resource</option>
                        <option value="Improve System">Improve System</option>
                        <option value="SOP">SOP</option>
                        <option value="FRAUD">FRAUD</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Target</label>
                      <input type="date" name="target" value="<?php echo $row['target'] ?>" placeholder="Input Loss" class="form-control">
                    </div>



                    <div class="form-group">
                      <label>Respon Auditee</label>
                      <select name="respon" id="respon" class="form-control" required>
                        <option value="<?php echo $row['respon'] ?>" selected><?php echo $row['respon'] ?></option>
                        <?php $respon = array("Not Yet", "On Progress", "Done");
                        foreach ($respon as $value) {
                          if ($value == $row['respon']) {
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
                      <input type="text" name="note" value="<?php echo $row['note'] ?>" placeholder="Input Note" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <a href="./postaudit.php" id="cancel" name="cancel" class="btn btn-secondary">Cancel</a>
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