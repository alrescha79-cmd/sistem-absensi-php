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
<h1>PRESENTASE KEHADIRAN</h1>
<br>
<div class="box">
    <div class="form-group">
        <?php
        include "../include/koneksi.php";
        $nim = $_SESSION['nim'];
        $sql = mysqli_query($conn, "SELECT nama FROM mahasiswa WHERE mahasiswa.nim = '$nim' ");
        while ($hasil = mysqli_fetch_array($sql)) {
        ?>

        <label>Nama anda : <?php echo $hasil['nama']; }?> </label>
        <a href="../export_rekap_mahasiswa.php" class="btn btn-danger pull-right" target="_blank">Unduh Presentase Absensi</a>
    </div>
    <div class="table-responsive">

        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>No</th>
                <th>Matkul</th>
                <th>Nama Dosen</th>
                <th>Kehadiran Dosen</th>
                <th>Kehadiran Mahasiswa</th>
                <th>Presentase Kehadiran</th>
            </tr>
            </thead>
            <tbody>
            <?php
            include "../include/koneksi.php";
            $nim = $_SESSION['nim'];
            $i = 0 + 1;
            $sql = "SELECT matkul.nama, dosen.nama_dosen, SUM(absensi.hadir) AS total_hadir, SUM(absensi.sakit) AS total_sakit, SUM(absensi.izin) AS total_izin, SUM(absensi.alfa) AS total_alfa, 
        (SUM(absensi.hadir) + SUM(absensi.sakit) + SUM(absensi.izin) + SUM(absensi.alfa)) AS total_kehadiran 
        FROM (((mahasiswa JOIN absensi ON mahasiswa.nim = absensi.nim) 
        JOIN matkul ON absensi.id_matkul = matkul.id_matkul) 
        JOIN detail_matkul_dosen ON matkul.id_matkul = detail_matkul_dosen.id_matkul) 
        JOIN dosen ON detail_matkul_dosen.nidn = dosen.nidn 
        WHERE absensi.nim = '".$nim."' 
        GROUP BY matkul.id_matkul";

            $result = mysqli_query($conn,$sql);
            while ($hasil = mysqli_fetch_array($result)) {
                $total_hadir = $hasil['total_hadir'];
                $total_kehadiran = $hasil['total_kehadiran'];

                // Cek apakah total kehadiran bukan nol sebelum melakukan perhitungan
                if ($total_kehadiran != 0) {
                    $presentase_kehadiran = ($total_hadir / $total_kehadiran) * 100;
                } else {
                    $presentase_kehadiran = 0; // Atur presentase kehadiran menjadi 0 jika total_kehadiran adalah nol
                }

                // Format presentase kehadiran menjadi tiga digit angka
                $formatted_presentase = number_format($presentase_kehadiran, 2);
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $hasil['nama']; ?></td>
                    <td><?php echo $hasil['nama_dosen']; ?></td>
                    <td><?php echo $hasil['total_kehadiran']; ?></td>
                    <td><?php echo $hasil['total_hadir']; ?></td>
                    <td><?php echo $formatted_presentase . "%" ?></td>
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
