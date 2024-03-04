
<!DOCTYPE html>
<html>
<head>
	<title></title>
    <style type="text/css">
        .tombol {
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
	<h1>ABSENSI MAHASISWA</h1>
	<br>

	<div class="box">

		<form onsubmit="return false" class="form-inline">
			<div class="form-grup" style="margin-right:10px;">
				<select id="kelas" class="form-control kelas" name="kelas"  >
					<option value="">Pilih Kelas:</option>
					<?php
							include "../include/koneksi.php";
							$nidn = $_SESSION['nidn'];
							$sql = mysqli_query($conn, "SELECT * FROM kelas ORDER BY nama_kelas");
							while ($hasil = mysqli_fetch_array($sql)) {
					 ?>
					<option value="<?php echo $hasil['id_kelas']; ?>"><?php echo $hasil['nama_kelas']; ?></option>
				<?php } ?>
				</select>
			</div>
			<div class="form-grup">
				<select id="matkul" class="form-control" name="matkul"  style="width: 250px" >
					<option value="">Pilih Mata Kuliah:</option>
					<?php
					include "../include/koneksi.php";

					 $sql = mysqli_query($conn, "SELECT matkul.id_matkul, matkul.nama FROM (matkul join detail_matkul_dosen on matkul.id_matkul = detail_matkul_dosen.id_matkul) join dosen on detail_matkul_dosen.nidn = dosen.nidn WHERE dosen.nidn = '$nidn'");
					while ($hasil = mysqli_fetch_array($sql)) {
					 ?>
					<option value="<?php echo $hasil['id_matkul']; ?>"><?php echo $hasil['nama']; ?></option>
				<?php } ?>
				</select>
			</div>

			<button id="tombol_form" class="btn btn-primary" style="margin-left:10px;">Tampil Mahasiswa</button>
		</form>
		<br>
		<div class="table-responsive">

		<form action='proses_tambah_absensi.php' method='post' >
		<div id="txtHint">
			<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
								<th>NO</th>
                <th>NAMA</th>
                <th>ABSENSI</th>
                <th>WAKTU SEKARANG</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
	</div>
	<input id='tombol' type='submit' name='submit' value='Konfirmasi' class='btn btn-success'></form>

	</div>
</div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
    $('#example').DataTable();

		document.getElementById("tombol_form").addEventListener("click", tampilkan_nilai_form);

			function tampilkan_nilai_form(){
		  var matkul=document.getElementById("matkul").value;
			var kelas=document.getElementById("kelas").value;
			// if (str=="") {
			// 	document.getElementById("txtHint").innerHTML="";
			// 	return;
			// }
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			} else { // code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
					document.getElementById("txtHint").innerHTML=this.responseText;
				}
			}
			xmlhttp.open("GET","getuser.php?kelas="+kelas+"&matkul="+matkul,true);
			xmlhttp.send();

			}
	});
	</script>
</body>
</html>
