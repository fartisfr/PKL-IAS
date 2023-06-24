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
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Post Audit</title>

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
              <h3 class="card-title">Add Post</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="./simpan_postaudit.php" method="POST">
                <div class="row">
                  <div class="col-sm-12">
                    <!-- text input -->

                    <div class="form-group">
                      <label>Perusahaan</label>
                      <select name="perusahaan" id="perusahaan" class="form-control" required>
                        <option value="" disabled selected hidden>Choose Perusahaan</option>
                        <?php

                        $query = "SELECT * FROM auditplan ORDER BY perusahaan ASC";
                        // $query = mysqli_query($con, $qr);
                        $result = $connection->query($query);
                        if ($result->num_rows > 0) {
                          $perusahaan = '';
                          while ($row = mysqli_fetch_assoc($result)) {
                            if ($perusahaan != $row['perusahaan']) {
                              $perusahaan = $row['perusahaan'];
                        ?>
                              <option value="<?php echo $row['perusahaan']; ?>"><?php echo $perusahaan; ?></option>
                        <?php
                            }
                          }
                        }

                        ?>
                        <?php
                        // Pertama2 buat file index.php kemudian masukkan kode berikut
                        if (isset($_GET['perusahaan'])) {
                          echo 'user ada di url, valuenya =' . $_GET['perusahaan'];
                        } else {
                          echo 'tidak ada user di url anda';
                        }    ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="auditjob">Audit Job</label>
                      <select name="auditjob" id="auditjob" class="form-control" required>
                        <option value="" disabled selected hidden>Choose Audit Job</option>
                        <?php

                        $query = "SELECT * FROM auditplan";
                        // $query = mysqli_query($con, $qr);
                        $result = $connection->query($query);
                        if ($result->num_rows > 0) {
                          while ($row = mysqli_fetch_assoc($result)) {

                        ?>
                            <option value="<?php echo $row['auditjob']; ?>"><?php echo $row['auditjob']; ?></option>
                        <?php
                          }
                        }

                        ?>
                        <?php
                        // Pertama2 buat file index.php kemudian masukkan kode berikut
                        if (isset($_GET['auditjob'])) {
                          echo 'user ada di url, valuenya =' . $_GET['auditjob'];
                        } else {
                          echo 'tidak ada user di url anda';
                        }    ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Scope</label>
                      <input type="text" name="scope" placeholder="Input Scope" class="form-control" required="">
                    </div>

                    <div class="form-group">
                      <label>Finding</label>
                      <input type="text" name="finding" placeholder="Input Finding" class="form-control" required="">
                    </div>

                    <div class="form-group">
                      <label>Amount</label>
                      <input type="number" name="amount" placeholder="Input Amount" class="form-control" required="">
                    </div>

                    <div class="form-group">
                      <label>Loss Recovery</label>
                      <input type="number" name="lossrecovery" placeholder="Input Loss Recovery" class="form-control" required="">
                    </div>

                    <div class="form-group">
                      <label>Sisa</label>
                      <input type="number" name="sisa" placeholder="Input Sisa" class="form-control" required="">
                    </div>

                    <div class="form-group">
                      <label>Root Cause</label>
                      <input type="text" name="root" placeholder="Input Root Cause" class="form-control" required="">
                    </div>

                    <div class="form-group">
                      <label>Risk for Company</label>
                      <input type="text" name="risk" placeholder="Input Risk" class="form-control" required="">
                    </div>

                    <div class="form-group">
                      <label>Recommendation</label>
                      <input type="text" name="rekomen" placeholder="Input Recommendation" class="form-control" required="">
                    </div>

                    <div class="form-group">
                      <label>Weakness Spot</label>
                      <select name="weakness" id="weakness" class="form-control" required="">
                        <option value="" disabled selected hidden>Choose Weakness</option>
                        <option value="Human Resource">Human Resource</option>
                        <option value="Improve System">Improve System</option>
                        <option value="SOP">SOP</option>
                        <option value="FRAUD">FRAUD</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Target</label>
                      <input type="date" name="target" placeholder="Input Target Date" class="form-control" required="">
                    </div>

                    <div class="form-group">
                      <label>Respon Auditee</label>
                      <select name="respon" id="respon" class="form-control" required="">
                        <option value="" disabled selected hidden>Choose Weakness</option>
                        <option value="Not Yet">Not Yet</option>
                        <option value="On Progress">On Progress</option>
                        <option value="Done">Done</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Note</label>
                      <input type="text" name="note" placeholder="Input Note" class="form-control">
                    </div>

                    <td>
                      <button type="submit" class="btn btn-success">SAVE</button>
                      <button type="reset" class="btn btn-warning">RESET</button>
                      <a href="./postaudit.php" id="cancel" name="cancel" class="btn btn-secondary">Cancel</a>
                    </td>

                  </div>
                </div>
              </form>
            </div>
            <!-- /.card-body -->
          </div>


          <!-- /.row -->
          <!-- Main row -->

          <!-- /.row (main row) -->
        </div>
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
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
  <script src="dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>

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
    $("#perusahaan").change(function() {
      // variabel dari nilai combo box kendaraan
      var nama_perusahaan = $("#perusahaan").val();
      console.log(perusahaan);
      // Menggunakan ajax untuk mengirim dan dan menerima data dari server
      $.ajax({
        type: "POST",
        dataType: "html",
        url: "ambil_data.php",
        data: "perusahaan=" + nama_perusahaan,

        success: function(data) {
          $("#auditjob").html(data);
        }
      });
    });
  </script>

  <script>
    // $(document).ready(function() {
    //     $("#perusahaan").on('change', function() {
    //         var perusahaan = $(this).val();

    //         $.ajax({
    //             method: "POST",
    //             url: "cascadingauditprogram.php",
    //             data: {
    //                 id: perusahaan
    //             },
    //             datatype: "html",
    //             success: function(data) {
    //                 $("#auditjob").html(data);
    //                 $("#auditjob").html('<option value="">Select Audit Job</option>');

    //             }
    //         });
    //     });
    // });

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