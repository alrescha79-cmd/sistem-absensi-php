<?php
include "../include/koneksi.php";

$nim = $_POST["nim"];
$nama_mahasiswa = $_POST["nama_mahasiswa"];
$jenis_kelamin = $_POST["jenis_kelamin"];
$alamat = $_POST["alamat"];
$agama = $_POST["agama"];
$no_hp = $_POST["no_hp"];
$kelas = $_POST["kelas"];
$username = $_POST["username"];
$password = $_POST["password"];

if(empty($_POST["nim"]) || empty($_POST["nama_mahasiswa"]) || empty($_POST["jenis_kelamin"]) || empty($_POST["alamat"])
	|| empty($_POST["agama"]) || empty($_POST["no_hp"]) || empty($_POST["kelas"]) || empty($_POST["username"])
 || empty($_POST["password"]) ){
	echo "<script language='javascript'>alert('Gagal di Edit');</script>";
	echo '<meta http-equiv="refresh" content="0; url=edit_data_mahasiswa.php">';
}else{
	$sql = "UPDATE `mahasiswa` SET `nama`='$nama_mahasiswa',`jk`='$jenis_kelamin', `agama`='$agama', `alamat`='$alamat', `no_hp`='$no_hp', `username`='$username', `password`='$password', `id_kelas`='$kelas'  WHERE `nim` = '$nim'";
				$kueri = mysqli_query($conn, $sql);
				echo "<script language='javascript'>alert('Berhasil di Edit');</script>";
				echo '<meta http-equiv="refresh" content="0; url=data_mahasiswa.php">';
	}
?>
