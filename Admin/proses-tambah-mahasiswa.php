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
	echo "<script language='javascript'>alert('Gagal di tambahkan');</script>";
	echo '<meta http-equiv="refresh" content="0; url=tambah_data_mahasiswa.php">';
}else{
	$sql = "INSERT INTO `mahasiswa` (`nim`, `nama`, `jk`, `agama`, `alamat`, `no_hp`, `username`, `password`, `id_kelas`)
			VALUES ('$nim', '$nama_mahasiswa', '$jenis_kelamin', '$agama', '$alamat', '$no_hp', '$username', '$password', '$kelas')";
			$kueri = mysqli_query($conn, $sql);
			echo "<script language='javascript'>alert('Berhasil di tambahkan');</script>";
			echo '<meta http-equiv="refresh" content="0; url=data_mahasiswa.php">';
}
?>
