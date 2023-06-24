<?php 
if (session_status() === PHP_SESSION_NONE) {
  session_name('audit_sess');
  session_start();
}
 
	// cek apakah yang mengakses halaman ini sudah login
  // cek level user
	if($_SESSION['status']=="admin"){
    //jika admin langsung redirect ke halaman index_admin.php
		header("location:index_admin.php");
	}else{
    if($_SESSION['status']==""){
      header("location:login.php");
    }
  }
  $username = $_SESSION['username'];
  $nama = $_SESSION['nama'];

  ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Dashboard</title>

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
   <!-- chart garis keatas -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

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
    </ul>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php
  include "menu.php";
  ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
            <span>Selamat Datang, <?php echo $nama; ?></span>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
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
        <div class="row">

        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          
        <!-- Left col -->
          <section class="col-lg-6 connectedSortable">
            <div class="card" style="overflow-x:auto;">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-table mr-1 mb-3"></i>
                  Running Plan
                </h3>
              <table id="auditplan" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">AUDIT JOB</th>
                    <th scope="col">TARGET DATE</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php 
                      include('koneksi.php');
                      $no = 1;
                      $query = mysqli_query($connection,"SELECT * FROM auditplan WHERE status = 'Running'");
                      while($row = mysqli_fetch_array($query)){
                  ?>

                  <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $row['auditjob'] ?></td>
                      <td><?php echo $row['targetdate'] ?></td>
                  </tr>

                  <?php } ?>
                  </tfoot>
                </table>
              </div>
            </div>
			
			
            <!-- Custom tabs (Charts with tabs)-->
            

          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-6 connectedSortable">

          
		   <div class="card">
              <div class="card-header bg-warning">
                <h3 class="card-title">
                  <i class="fas fa-chart-bar mr-1"></i>
                  Weakness Spot
                </h3>
			</div>
		  <center><canvas id="myChart" style="margin-bottom: 20px; width:100%;max-width:600px"></canvas></center>
      <script>
      var ctx = document.getElementById("myChart").getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ["Human Resource","Improve System","SOP","FRAUD"],
          datasets: [{
            label: '',
            data: [
            <?php 
            include('koneksi.php');
            ?>
            <?php 
            $HR = mysqli_query($connection,"select * from postaudit where weakness='Human Resource'");
            echo mysqli_num_rows($HR);
            ?>, 
            <?php 
            $IS = mysqli_query($connection,"select * from postaudit where weakness='Improve System'");
            echo mysqli_num_rows($IS);
            ?>, 
            
            <?php 
            $SOP = mysqli_query($connection,"select * from postaudit where weakness='SOP'");
            echo mysqli_num_rows($SOP);
            ?>,
            
            <?php 
            $fraud = mysqli_query($connection,"select * from postaudit where weakness='FRAUD'");
            echo mysqli_num_rows($fraud);
            ?>
            ],
            backgroundColor: [
                          'rgba(255, 99, 132, 0.2)',
                          'rgba(54, 162, 235, 0.2)',
                          'rgba(255, 206, 86, 0.2)',
                          'rgba(75, 192, 192, 0.2)'
                          ],
                          borderColor: [
                          'rgba(255,99,132,1)',
                          'rgba(54, 162, 235, 1)',
                          'rgba(255, 206, 86, 1)',
                          'rgba(75, 192, 192, 1)'
                          ],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero:true
              }
            }]
          },
          
      legend: {display: false},
      title: {
        display: true,
      }
          
        }
        
        
      });
	  </script>
	

			
    </section>
		   
    <section class="col-lg-6 connectedSortable">
		   <div class="card">
              <div class="card-header bg-info">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Plan vs Actual
                </h3>
			</div>
		   <center><canvas id="myChart2" style="margin-bottom: 20px; width:100%;max-width:400px"></canvas></center>

      <script>
      var xValues2 = ["PLAN (%)","ON Progress (%)","Done (%)"];
      //var yValues2 = [55, 49]; // 44, 24, 15
      var barColors2 = [
        "#90dbf4",
        "#fbc4ab",
        "#cfbaf0",
      ];

      new Chart("myChart2", {
        type: "doughnut",
        data: {
          labels: xValues2,
          datasets: [{
            backgroundColor: barColors2,
            data: [
                <?php 
                include('koneksi.php');
                $tot = mysqli_query($connection,"select * from auditplan ");
                $jmh = mysqli_num_rows($tot);
                ?>
              <?php 
                $budget = mysqli_query($connection,"select count(status) AS PLANNYA from auditplan WHERE status='Plan' ");
                if($row = mysqli_fetch_array($budget)){
                $totplan = $row['PLANNYA']/$jmh * 100  ;
                echo $totplan;
                }
                ?>,
                
                <?php 
                $run = mysqli_query($connection,"select count(status) AS RUNINGNYA from auditplan WHERE status='Running' ");
                if($row2 = mysqli_fetch_array($run)){
                  
                $totrun = $row2['RUNINGNYA']/$jmh * 100 ;
                echo $totrun;
                }
                ?>,
                
                <?php 
                $Done2 = mysqli_query($connection,"select count(status) AS dine from auditplan WHERE status='Done' ");
                if($row3 = mysqli_fetch_array($Done2)){
              $totdone = $row3['dine']/$jmh * 100 ;
                echo $totdone;
                }
                
                
                
                
                ?>

        ]
          }]
        },
        options: {
          title: {
            display: true,
          }
        }
      });
      </script>
	
    </section>
			 
			 
		<section class="col-lg-6 connectedSortable">
			<div class="card">
              <div class="card-header bg-success">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Post Audit
                </h3>
			</div>
		   <center><canvas id="myChart66" style="margin-bottom: 20px; width:100%;max-width:400px"></canvas></center>

      <script>
      var xValues2 = ["Not Yet (%)","ON Progress (%)","Done (%)"];
      //var yValues2 = [55, 49]; // 44, 24, 15
      var barColors2 = [
        "#fad2e1",
        "#c5dedd",
        "#eddcd2",
      ];

      new Chart("myChart66", {
        type: "doughnut",
        data: {
          labels: xValues2,
          datasets: [{
            backgroundColor: barColors2,
            data: [
                <?php 
                include('koneksi.php');
                $tot = mysqli_query($connection,"select * from postaudit ");
                $jmh = mysqli_num_rows($tot);
                ?>
              <?php 
                $budget = mysqli_query($connection,"select count(respon) AS PLANNYA from postaudit WHERE respon='Not Yet' ");
                if($row = mysqli_fetch_array($budget)){
                $totplan = $row['PLANNYA']/$jmh * 100  ;
                echo $totplan;
                }
                ?>,
                
                <?php 
                $run = mysqli_query($connection,"select count(respon) AS RUNINGNYA from postaudit WHERE respon='On Progress' ");
                if($row2 = mysqli_fetch_array($run)){
                  
                $totrun = $row2['RUNINGNYA']/$jmh * 100 ;
                echo $totrun;
                }
                ?>,
                
                <?php 
                $Done2 = mysqli_query($connection,"select count(respon) AS dine from postaudit WHERE respon='Done' ");
                if($row3 = mysqli_fetch_array($Done2)){
              $totdone = $row3['dine']/$jmh * 100 ;
                echo $totdone;
                }
                
                
                
                
                ?>

        ]
          }]
        },
        options: {
          title: {
            display: true,
          }
        }
      });
      </script>
		</section>
			 
		  <!-- <section class="col-lg-6 connectedSortable">
			 <div
id="myChart3" style="width:100%; max-width:600px; height:500px;">
</div>

<script>
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

	
function drawChart() {
				
var data = google.visualization.arrayToDataTable([
	
  ['respon', 'Mhl'],
  ['Not Yet',22],
  ['On Progress',55],
  ['Done',43]
]);

var options = {
  title:'POST AUDIT',
  is3D:true
};

var chart = new google.visualization.PieChart(document.getElementById('myChart3'));
  chart.draw(data, options);
}
</script>
 </section>-->
 
   <section class="col-lg-6 connectedSortable">
    <div class="card">
          <div class="card-header bg-danger">
              <h3 class="card-title">
                  <i class="fas fa-chart-bar mr-1"></i>
                  Audit Plan Budget
              </h3>
      </div>
          
      <center><canvas id="myChart11" style="margin-bottom: 20px; width:100%;max-width:600px"></canvas></center>
      <script>
          var ctx = document.getElementById("myChart11").getContext('2d');
          var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: ["Budget","Actual","Sisa"],
              datasets: [{
                label: '',
                data: [
              <?php 
                include('koneksi.php');
                ?>
              <?php 
                $budget = mysqli_query($connection,"select sum(budget) AS Totalbudget from auditplan ");
                $row = mysqli_fetch_array($budget);
              
                echo ($row['Totalbudget']);
                
                ?>,
                
                <?php 
                $actual = mysqli_query($connection,"select sum(actual) AS loss from auditplan ");
                $row2 = mysqli_fetch_array($actual);
              
                echo ($row2['loss']);
                
                ?>,
                
                <?php 
                $budget2 = mysqli_query($connection,"select sum(budget) AS Totalbudget2 from auditplan ");
                $row11 = mysqli_fetch_array($budget2);
                $budgetnya = $row11['Totalbudget2'];
                
                $actual2 = mysqli_query($connection,"select sum(actual) AS loss2 from auditplan ");
                $row22 = mysqli_fetch_array($actual2);
                $actualnya = $row22['loss2'];
                
                $sis = $budgetnya - $actualnya;
              
                echo ($sis);
                
                ?>
                
                ],
                  backgroundColor: [
                              'rgba(255, 99, 132, 0.2)',
                              'rgba(54, 162, 235, 0.2)',
                              'rgba(255, 206, 86, 0.2)',
                              'rgba(75, 192, 192, 0.2)'
                              ],
                              borderColor: [
                              'rgba(255,99,132,1)',
                              'rgba(54, 162, 235, 1)',
                              'rgba(255, 206, 86, 1)',
                              'rgba(75, 192, 192, 1)'
                              ],
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                yAxes: [{
                  ticks: {
                    beginAtZero:true
                  }
                }]
              },
              
          legend: {display: false},
          title: {
            display: true,
          }
              
            }
            
            
          });
        </script>
    </section> 

		<section class="col-lg-6 connectedSortable">   
		<div class="card">
              <div class="card-header bg-secondary">
                <h3 class="card-title">
                  <i class="fas fa-chart-bar mr-1"></i>
                  Loss Recovery
                </h3>
			</div>
		  <center><canvas id="myChart12" style="margin-bottom: 20px; width:100%;max-width:600px"></canvas></center>
      <script>
          var ctx = document.getElementById("myChart12").getContext('2d');
          var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: ["Amount","Loss Recovery","Sisa"],
              datasets: [{
                label: '',
                data: [
              <?php 
                include('koneksi.php');
                ?>
              <?php 
                $budget = mysqli_query($connection,"select sum(amount) AS Totalbudget from postaudit ");
                if($row = mysqli_fetch_array($budget)){
              
                echo ($row['Totalbudget']);
                }
                ?>,
                
                <?php 
                $actual = mysqli_query($connection,"select sum(lossrecovery) AS loss from postaudit ");
                if($row2 = mysqli_fetch_array($actual)){
              
                echo ($row2['loss']);
                }
                ?>,
                
                <?php 
                $actual2 = mysqli_query($connection,"select sum(sisa) AS sisanya from postaudit ");
                if($row3 = mysqli_fetch_array($actual2)){
              
                echo ($row3['sisanya']);
                }
                ?>
                
                ],
                backgroundColor: [
                              'rgba(255, 99, 132, 0.2)',
                              'rgba(54, 162, 235, 0.2)',
                              'rgba(255, 206, 86, 0.2)',
                              'rgba(75, 192, 192, 0.2)'
                              ],
                              borderColor: [
                              'rgba(255,99,132,1)',
                              'rgba(54, 162, 235, 1)',
                              'rgba(255, 206, 86, 1)',
                              'rgba(75, 192, 192, 1)'
                              ],
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                yAxes: [{
                  ticks: {
                    beginAtZero:true
                  }
                }]
              },
              
          legend: {display: false},
          title: {
            display: true,
          }
              
            }
            
            
          });
        </script>
    </section>
          <!-- right col -->
        </div>
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
</body>
</html>
