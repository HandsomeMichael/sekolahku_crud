<?php

include "redirectsesi.php";
include "koneksi.php";

$tabel_siswa = mysqli_query($koneksi, "SELECT * FROM siswa");
$jumlah_siswa = mysqli_num_rows($tabel_siswa);

$tabel_jurusan = mysqli_query($koneksi, "SELECT * FROM jurusan");
$jumlah_jurusan = mysqli_num_rows($tabel_jurusan);

// $jumlah_siswa_per_jurusan = array();

// if($jumlah_jurusan > 1 && $jumlah_siswa > 1)
// {

//     $data_jurusan = mysqli_fetch_array($tabel_jurusan);

//     for ($i=0; $i < min($jumlah_jurusan,6); $i++) 
//     {
//         $data_jurusan[$i];
//         # code...
//     }
//     while($data_jurusan = mysqli_fetch_array($tabel_jurusan))
//     {
//         $nama_jurusan = $data_jurusan['nama'];
//         $tabel_siswa_per_jurusan = mysqli_query($koneksi, "SELECT * FROM siswa WHERE jurusan='$nama_jurusan'");
//         $jumlah_siswa_per_jurusan[$nama_jurusan] = mysqli_num_rows($tabel_siswa_per_jurusan);
//         $persen_siswa_per_jurusan[$nama_jurusan] = ($jumlah_siswa > 0) ? round(($jumlah_siswa_per_jurusan[$nama_jurusan] / $jumlah_siswa) * 100) : 0;
//     }
// }

?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MySchool DB</title>

</head>
<body>

    <!-- jadiin flex -->
    <main>

        <!-- sidebarnya -->
        <nav>
            <a href="logout.php">Logout</a>
            <!-- Males ngisi -->
        </nav>

        <!-- Konten nya -->
        <section>
            <!-- Hero-->
            <section>

            </section>
            <!-- Konten -->
            <section>
                <!-- gak tau khe mau pake grid atau flexbox, aku taruh je php nya sni -->

                <div>
                    <p>Siswa</p>
                    <h1><?php echo $jumlah_siswa; ?></h1>
                    <p><a href="icon"></a>blablablablaba</p>
                </div>

                <div>
                    <p>Populasi Jurusan</p>
                    <div>
                        
                    </div>
                </div>

            </section>
        </section>
    </main>
</body>
</html>