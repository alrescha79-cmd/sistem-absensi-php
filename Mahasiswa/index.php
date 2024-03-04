<?php
session_start();
if(isset($_SESSION['nim'])){
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
    <?php
    include "../include/koneksi.php";
    $nim = $_SESSION['nim'];
    $sql = mysqli_query($conn, "SELECT nama FROM mahasiswa WHERE mahasiswa.nim = '$nim' ");
    while ($hasil = mysqli_fetch_array($sql)) {
        ?>
  <title>Hello <?php echo $hasil['nama']; }?></title>
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
        margin-top: 4px;
      padding-top: 4%;
      padding-bottom: 4%;
      background-color: #00e676;
    }
    .detail:hover {
        transform: scale(1.1);
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
        <li style="padding: 20px;">
          <center>
          <div class="avatar"><img src="https://66.media.tumblr.com/avatar_faa95867d2b3_128.png" width="100px" height="100px" />
          </div>
          <div style="color: white; font-weight: bold;">
            <?php
                include "../include/koneksi.php";
                $nim = $_SESSION['nim'];
                $sql = mysqli_query($conn, "SELECT nama FROM mahasiswa WHERE mahasiswa.nim = '$nim' ");
                while ($hasil = mysqli_fetch_array($sql)) {
             ?>

              Nama Mahasiswa : <?php echo $hasil['nama']; }?>
          </div>
          </center>

        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="tampil_data_absensi.php">
            <i class="fa fa-fw fa-sitemap"></i>
            <span class="nav-link-text">Tampil Data Absensi</span>
          </a>
        </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="rekap-absen.mahasiswa.php">
            <i class="fa fa-fw fa-sitemap"></i>
            <span class="nav-link-text">Rekap Absensi</span>
          </a>
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
      <div class="">
        <div class="jumbotron">
            <?php
            include "../include/koneksi.php";
            $nim = $_SESSION['nim'];
            $sql = mysqli_query($conn, "SELECT nama FROM mahasiswa WHERE mahasiswa.nim = '$nim' ");
            while ($hasil = mysqli_fetch_array($sql)) {
                ?>
          <h1 style="text-align: center; padding-bottom: 20px; color: white;">SELAMAT DATANG <span
                      class="font-weight-bold text-success bg-light px-2 rounded"><?php
                  echo
                  $hasil['nama'];}?></span></h1>
          <p style="text-align: center; font-weight: bold;">Silahkan pilih menu sesuai yang diinginkan</p>
          <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
        </div>
      </div>

        <!--        chart-->
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-warning o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fa fa-fw fa-list"></i>
                        </div>
                        <div class="mr-5">Lihat Presensi</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1 detail" href="tampil_data_absensi.php">
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
                            <i class="fa fa-fw fa-percent"></i>
                        </div>
                        <div class="mr-5">Presentase Presensi</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1 detail" href="rekap-absen.mahasiswa.php">
                        <span class="float-left">View Details</span>
                        <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
                    </a>
                </div>
        </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-3 mt-5 ">
            <div class="border p-2 pb-5 rounded " style="width: 400px; height: 400px;">
                <h3 style="text-align: center">Rekap Presensi</h3>
                <canvas id="chart" style="height: 70%; width: 70%;"></canvas>
            </div>
        </div>
        <!--        end chart-->

        <!--        data untuk chart-->
            <?php
            include "../include/koneksi.php";
            $nim = $_SESSION['nim'];
            $sql = mysqli_query($conn, "SELECT mahasiswa.nama, SUM(absensi.hadir) AS hadir FROM absensi INNER JOIN mahasiswa ON absensi.nim = mahasiswa.nim WHERE mahasiswa.nim = '$nim' ");
            while ($hasil = mysqli_fetch_array($sql)) {
                $hadir = $hasil['hadir'];
            }
            $sql = mysqli_query($conn, "SELECT mahasiswa.nama, SUM(absensi.izin) AS izin FROM absensi INNER JOIN mahasiswa ON absensi.nim = mahasiswa.nim WHERE mahasiswa.nim = '$nim' ");
            while ($hasil = mysqli_fetch_array($sql)) {
                $izin = $hasil['izin'];
            }
            $sql = mysqli_query($conn, "SELECT mahasiswa.nama, SUM(absensi.sakit) AS sakit FROM absensi INNER JOIN mahasiswa ON absensi.nim = mahasiswa.nim WHERE mahasiswa.nim = '$nim' ");
            while ($hasil = mysqli_fetch_array($sql)) {
                $sakit = $hasil['sakit'];
            }
            $sql = mysqli_query($conn, "SELECT mahasiswa.nama, SUM(absensi.alfa) AS alfa FROM absensi INNER JOIN mahasiswa ON absensi.nim = mahasiswa.nim WHERE mahasiswa.nim = '$nim' ");
            while ($hasil = mysqli_fetch_array($sql)) {
                $alfa = $hasil['alfa'];
            }
            ?>

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
        <script src="vendor/chart.js/Chart.min.js"></script>
        <script>
            const data = {
                labels: [
                    'Hadir',
                    'Izin',
                    'Sakit',
                    'Alfa'
                ],
                datasets: [{
                    label: '',
                    data: [<?php echo $hadir; ?>, <?php echo $izin; ?>, <?php echo $sakit; ?>, <?php echo $alfa; ?>
                    ],
                    backgroundColor: [
                        'rgb(55, 159, 64)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
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
                document.getElementById('chart'),
                config
            );
        </script>

</body>

</html>
<?php
}else{
	header("location:../login/login.php");
}
?>
