<?php
include "../include/koneksi.php";
$nidn = $_SESSION['nidn'];

// Membuat query untuk mengambil daftar kelas yang diajar oleh dosen
$sql_kelas = "SELECT * FROM kelas JOIN mahasiswa ON kelas.id_kelas = mahasiswa.id_kelas
              JOIN absensi ON mahasiswa.nim = absensi.nim
              JOIN matkul ON absensi.id_matkul = matkul.id_matkul
              JOIN detail_matkul_dosen ON matkul.id_matkul = detail_matkul_dosen.id_matkul
              JOIN dosen ON detail_matkul_dosen.nidn = dosen.nidn
              WHERE dosen.nidn = '$nidn'
              GROUP BY kelas.id_kelas
              ORDER BY kelas.nama_kelas";

$result_kelas = mysqli_query($conn, $sql_kelas);
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css">
        .tombol {
            margin-bottom: 20px;
        }

        h1 {
            text-align: center;
        }

        .box {
            border-style: outset;
            padding: 25px;
            border-radius: 40px 40px 40px 40px;
        }

        .btn-danger {
            padding: 5px;
        }

        .btn-warning {
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
        $sql_nama_dosen = mysqli_query($conn, "SELECT nama_dosen FROM dosen WHERE dosen.nidn = '$nidn' ");
        while ($hasil_nama_dosen = mysqli_fetch_array($sql_nama_dosen)) {
            ?>
            <label>Nama Dosen: <?php echo $hasil_nama_dosen['nama_dosen']; ?></label>
            <?php
        }
        ?>
    </div>
    <div class="table-responsive">
        <form method="POST" action="" class="form-inline">
            <div class="form-group">
                <label class="mr-2">Kelas:</label>
                <select name="kelas" class="form-control mr-2">
                    <option value="">Pilih Kelas:</option>
                    <?php
                    while ($hasil_kelas = mysqli_fetch_array($result_kelas)) {
                        ?>
                        <option value="<?php echo $hasil_kelas['id_kelas']; ?>"><?php echo $hasil_kelas['nama_kelas']; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <input type="submit" value="Filter" name="submit" class="btn btn-primary">
            </div>
        </form>
        <br>
        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Kelas</th>
                <th>Matkul</th>
                <th>Nama Dosen</th>
                <th>Kehadiran Dosen</th>
                <th>Kehadiran Mahasiswa</th>
                <th>Presentase Kehadiran</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = 0 + 1;
            $kelas_terpilih = isset($_POST['kelas']) ? $_POST['kelas'] : '';

            // Filter berdasarkan kelas terpilih
            if (!empty($kelas_terpilih)) {
                $sql = "SELECT mahasiswa.nim, mahasiswa.nama AS nama_mhs, kelas.nama_kelas, matkul.nama, dosen.nama_dosen, 
                        SUM(absensi.hadir) AS total_hadir, SUM(absensi.sakit) AS total_sakit, SUM(absensi.izin) AS total_izin, 
                        SUM(absensi.alfa) AS total_alfa, 
                        (SUM(absensi.hadir) + SUM(absensi.sakit) + SUM(absensi.izin) + SUM(absensi.alfa)) AS total_kehadiran 
                        FROM (((((mahasiswa JOIN absensi ON mahasiswa.nim = absensi.nim) 
                        JOIN matkul ON absensi.id_matkul = matkul.id_matkul) 
                        JOIN detail_matkul_dosen ON matkul.id_matkul = detail_matkul_dosen.id_matkul) 
                        JOIN dosen ON detail_matkul_dosen.nidn = dosen.nidn) 
                        JOIN kelas ON mahasiswa.id_kelas = kelas.id_kelas) 
                        WHERE dosen.nidn = '$nidn' AND kelas.id_kelas = '$kelas_terpilih' 
                        GROUP BY kelas.nama_kelas, mahasiswa.nim 
                        ORDER BY kelas.nama_kelas ASC";
            } else {
                $sql = "SELECT mahasiswa.nim, mahasiswa.nama AS nama_mhs, kelas.nama_kelas, matkul.nama, dosen.nama_dosen, 
                        SUM(absensi.hadir) AS total_hadir, SUM(absensi.sakit) AS total_sakit, SUM(absensi.izin) AS total_izin, 
                        SUM(absensi.alfa) AS total_alfa, 
                        (SUM(absensi.hadir) + SUM(absensi.sakit) + SUM(absensi.izin) + SUM(absensi.alfa)) AS total_kehadiran 
                        FROM (((((mahasiswa JOIN absensi ON mahasiswa.nim = absensi.nim) 
                        JOIN matkul ON absensi.id_matkul = matkul.id_matkul) 
                        JOIN detail_matkul_dosen ON matkul.id_matkul = detail_matkul_dosen.id_matkul) 
                        JOIN dosen ON detail_matkul_dosen.nidn = dosen.nidn) 
                        JOIN kelas ON mahasiswa.id_kelas = kelas.id_kelas) 
                        WHERE dosen.nidn = '$nidn' 
                        GROUP BY kelas.nama_kelas, mahasiswa.nim 
                        ORDER BY kelas.nama_kelas ASC";
            }

            $result = mysqli_query($conn, $sql);
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
                    <td><?php echo $hasil['nim']; ?></td>
                    <td><?php echo $hasil['nama_mhs']; ?></td>
                    <td><?php echo $hasil['nama_kelas']; ?></td>
                    <td><?php echo $hasil['nama']; ?></td>
                    <td><?php echo $hasil['nama_dosen']; ?></td>
                    <td><?php echo $hasil['total_kehadiran']; ?></td>
                    <td><?php echo $hasil['total_hadir']; ?></td>
                    <td><?php echo $formatted_presentase . "%" ?></td>
                </tr>
                <?php $i++;
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>
</body>
</html>
