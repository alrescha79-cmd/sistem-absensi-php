<?php
session_start();
if(isset($_SESSION['id_admin'])){

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Hello Administrator</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <style type="text/css">
    .jumbotron{
      background-color: #90caf9;
    }

    .judul {
      padding: 30px 0;
    }
  </style>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">ABSENSI AKADEMIK</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" style="padding: 20px;">
          <a href=class="nav-link" href="index.php">
          <center>
          <div class="avatar"><img src="https://66.media.tumblr.com/avatar_faa95867d2b3_128.png" width="100px" height="100px" />
          </div>
          <div style="color: white; font-weight: bold;">
            <?php
                include "../include/koneksi.php";
                $id = $_SESSION['id_admin'];
                $sql = mysqli_query($conn, "SELECT nama FROM admin WHERE admin.id_admin = '$id' ");
                while ($hasil = mysqli_fetch_array($sql)) {
             ?>

              nama : <?php echo $hasil['nama']; }?>
          </div>
          </center>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="data_mahasiswa.php">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Data Mahasiswa</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="data_dosen.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Data Dosen</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="data_kelas.php">
            <i class="fa fa-fw fa-sitemap"></i>
            <span class="nav-link-text">Data Kelas</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="data_mata_kuliah.php">
            <i class="fa fa-fw fa-sitemap"></i>
            <span class="nav-link-text">Data Mata Kuliah</span>
          </a>
        </li>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <div class="">
        <div class="jumbotron">
          <div class="judul">
          <h1 style="text-align: center; padding-bottom: 20px; color: white; font-weight: bold; font-family: sans-serif;">SELAMAT DATANG ADMIN</h1>
          <p style="text-align: center; font-family: sans-serif; font-weight: bold;">Silahkan pilih menu sesuai yang diinginkan</p>
          <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
          </div>
        </div>
      </div>
      <!-- Icon Cards-->
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-user-o"></i>
              </div>
              <div class="mr-5">Data Mahasiswa</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="data_mahasiswa.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-user-circle-o"></i>
              </div>
              <div class="mr-5">Data Dosen</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="data_dosen.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-list-ol"></i>
              </div>
              <div class="mr-5">Data Kelas</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="data_kelas.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-clipboard"></i>
              </div>
              <div class="mr-5">Data Mata Kuliah</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="data_mata_kuliah.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
      </div>
      <!-- Area Chart Example-->
        <div class="row col-xl-12 col-sm-6 justify-content-between">
        <div class="border border-secondary my-4 h-25  py-2" style="width: 500px; height: 500px; border-radius: 10px;
        background: azure;">
            <h3 style="text-align: center">Data Mahasiswa</h3>
            <canvas id="chart-mhs"></canvas>
        </div>
        <div class="border border-secondary my-4 h-25  py-2" style="width: 500px; height: 500px; border-radius: 10px;
        background: mintcream;">
            <h3 style="text-align: center">Dosen & Mahasiswa</h3>
            <canvas id="chart-all"></canvas>
        </div>
        </div>

<!--        data untuk chart mhs-->
        <?php
        include "../include/koneksi.php";
        $sql = mysqli_query($conn, "SELECT COUNT(jk) AS boy FROM mahasiswa WHERE jk=\"L\"");
        while ($hasil = mysqli_fetch_array($sql)) {
            $boy = $hasil['boy'];
        } $sql = mysqli_query($conn, "SELECT COUNT(jk) AS girl FROM mahasiswa WHERE jk=\"P\"");
        while ($hasil = mysqli_fetch_array($sql)) {
            $girl = $hasil['girl'];
        } $sql = mysqli_query($conn, "SELECT COUNT(nidn) AS dosen FROM dosen");
        while ($hasil = mysqli_fetch_array($sql)) {
            $dosen = $hasil['dosen'];
        } $sql = mysqli_query($conn, "SELECT COUNT(nim) AS mhs FROM mahasiswa");
        while ($hasil = mysqli_fetch_array($sql)) {
            $mhs = $hasil['mhs'];
        }
        
        ?>

    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © TA Basis Data Lanjut 2023</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="../logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
  </div>

      <script>
          const data = {
              labels: [
                  'Laki-Laki',
                  'Perempuan',
              ],
              datasets: [{
                  label: 'Absensi',
                  data: [<?php echo $boy; ?>, <?php echo $girl; ?>],
                  backgroundColor: [
                      'rgb(54, 162, 235)',
                      'rgb(255, 99, 132)'
                  ],
                  hoverOffset: 12
              }]
          };
          const config = {
              type: 'pie',
              data: data,
          };
          const myChart = new Chart(
              document.getElementById('chart-mhs'),
              config
          );

          const data1 = {
              labels: [
                  'Dosen',
                  'Mahasiswa',
              ],
              datasets: [{
                  label: '',
                  data: [<?php echo $dosen; ?>, <?php echo $mhs; ?>],
                  backgroundColor: [
                      '#4caf50',
                      '#ff9800'
                  ],
                  hoverOffset: 12
              }]
          };
          const config1= {
              type: 'doughnut',
              data: data1,
          };
          const myChart1 = new Chart(
              document.getElementById('chart-all'),
              config1
          );
      </script>
</body>

</html>

<?php
}else{
	header("location:../login/login.php");
}
?>
