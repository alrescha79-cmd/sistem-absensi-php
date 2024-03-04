<?php
include "../include/koneksi.php";

$nidn = $_POST["nidn"];
$nama_dosen = $_POST["nama_dosen"];
$no_hp = $_POST["no_hp"];
$alamat = $_POST["alamat"];
$username = $_POST["username"];
$password = $_POST["password"];
$matkul = $_POST["matkul"];

if(empty($_POST["nidn"]) || empty($_POST["nama_dosen"]) || empty($_POST["no_hp"]) || empty($_POST["alamat"]) || empty
	($_POST["username"]) || empty($_POST["password"])){
	echo "<script language='javascript'>alert('Gagal di tambahkan');</script>";
	echo '<meta http-equiv="refresh" content="0; url=tambah_data_dosen.php">';
}else{
	$sql = "INSERT INTO `dosen`(`nidn`, `nama_dosen`, `alamat`, `no_hp`, `username`, `password`)
			VALUES ('$nidn', '$nama_dosen', '$alamat', '$no_hp', '$username', '$password')";
			$kueri = mysqli_query($conn, $sql);
			$sql2 = "INSERT INTO `detail_matkul_dosen`(`id_matkul_dosen`, `nidn`, `id_matkul`)
			VALUES (NULL, '$nidn', '$matkul')";
			$kueri2 = mysqli_query($conn, $sql2);
			echo "<script language='javascript'>alert('Berhasil di tambahkan');</script>";
			echo '<meta http-equiv="refresh" content="0; url=data_dosen.php">';
}
?>
