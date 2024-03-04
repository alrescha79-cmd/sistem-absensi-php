<!DOCTYPE html>
<html>
<head>
	<title></title>
    <style type="text/css">
        .tombol{
            margin-bottom: 20px;
        }

        h1{
        	text-align: center;
        }

        .box {
        	border-style: outset;
        	padding: 25px;
        	border-radius: 40px 40px 40px 40px;
        }

        .btn-danger{
        	padding: 5px;
        }

        .btn-warning{
        	padding: 5px;
        }
    </style>
</head>
<body>
	<h1>TAMPIL DATA ABSENSI MAHASISWA</h1>
	<br>
	<div class="box">
		<div class="form-group">
			<?php
					include "../include/koneksi.php";
					$nim = $_SESSION['nim'];
					$sql = mysqli_query($conn, "SELECT nama, nim FROM mahasiswa WHERE mahasiswa.nim = '$nim' ");
					while ($hasil = mysqli_fetch_array($sql)) {
			 ?>
				<label>Nama : <?php echo $hasil['nama']; }?> </label>
<!--            tombol untuk download tabel absensi-->
            <a href="../export_absensi_mahasiswa.php" class="btn btn-danger pull-right" target="_blank">Unduh Data Absensi</a>
        </div>
	<div class="table-responsive">
	<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
				<th>No</th>
                <th>Matkul</th>
                <th>Nama Dosen</th>
                <th>Hadir</th>
                <th>Sakit</th>
                <th>Izin</th>
                <th>Alfa</th>

            </tr>
        </thead>
        <tbody>
					<?php
							include "../include/koneksi.php";
							$nim = $_SESSION['nim'];
							$i = 0 + 1;
							$sql="SELECT matkul.nama, dosen.nama_dosen, sum(absensi.hadir) as hadir, sum(absensi.sakit) as sakit, sum(absensi.izin) as izin, sum(absensi.alfa) as alfa FROM (((mahasiswa join absensi on mahasiswa.nim = absensi.nim) join matkul on absensi.id_matkul = matkul.id_matkul) join detail_matkul_dosen
						        on matkul.id_matkul = detail_matkul_dosen.id_matkul) join dosen on detail_matkul_dosen.nidn = dosen.nidn WHERE absensi.nim = '".$nim."' GROUP BY matkul.id_matkul";
						  $result = mysqli_query($conn,$sql);
							while ($hasil = mysqli_fetch_array($result)) {
					 ?>
			<tr>
				<td><?php echo $i ?></td>
				<td><?php echo $hasil['nama']; ?></td>
				<td><?php echo $hasil['nama_dosen']; ?></td>
				<td><?php echo $hasil['hadir']; ?></td>
        <td><?php echo $hasil['sakit']; ?></td>
        <td><?php echo $hasil['izin']; ?></td>
        <td><?php echo $hasil['alfa']; ?></td>
			</tr>
			<?php $i++; } ?>
        </tbody>
    </table>
    </div>
	</div>
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
    $('#example').DataTable();
	} );
	</script>
</body>
</html>
