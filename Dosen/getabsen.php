<!DOCTYPE html>
<html>
<head>
<style>
table {
   width: 100%;
   border-collapse: collapse;
}

table, td, th {
   border: 1px solid black;
   padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
session_start();
include "../include/koneksi.php";

$matkul = intval($_GET['matkul']);

if(isset($_SESSION['nidn'])) {
    $nidn = $_SESSION['nidn'];


    $sql = "SELECT matkul.nama, dosen.nama_dosen, sum(absensi.hadir) as hadir, sum(absensi.sakit) as sakit, sum(absensi.izin) as izin, sum(absensi.alfa) as alfa 
        FROM (((mahasiswa 
        JOIN absensi ON mahasiswa.nim = absensi.nim) 
        JOIN matkul ON absensi.id_matkul = matkul.id_matkul) 
        JOIN detail_matkul_dosen ON matkul.id_matkul = detail_matkul_dosen.id_matkul) 
        JOIN dosen ON detail_matkul_dosen.nidn = dosen.nidn 
        WHERE mahasiswa.nim = '" . $matkul . "' AND dosen.nidn = '" . $nidn . "'
        GROUP BY matkul.id_matkul, dosen.nidn";

    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    echo "<table id='example' class='table table-striped table-bordered' cellspacing='0' width='100%'>
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
        </thead>";

    if ($num > 0) {
        $i = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo "<tbody><tr>";
            echo "<td>" . $i . "</td>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['nama_dosen'] . "</td>";
            echo "<td>" . $row['hadir'] . "</td>";
            echo "<td>" . $row['sakit'] . "</td>";
            echo "<td>" . $row['izin'] . "</td>";
            echo "<td>" . $row['alfa'] . "</td>";
            echo "</tr></tbody>";
            $i++;
        }
    } else {
        echo "<tbody></tbody>";
    }
}

echo "</table>";
mysqli_close($conn);
?>


</body>
</html>
