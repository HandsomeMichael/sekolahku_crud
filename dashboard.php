<?php

include "redirectsesi.php";
include "koneksi.php";

$tabel_siswa = mysqli_query($koneksi, "SELECT * FROM siswa");
$jumlah_siswa = mysqli_num_rows($tabel_siswa);

$jumlah_guru = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM guru"));
$jumlah_mapel = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM mapel"));
$jumlah_ekstra = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM ekstra"));

$tabel_jurusan = mysqli_query($koneksi, "SELECT * FROM jurusan");
$jumlah_jurusan = mysqli_num_rows($tabel_jurusan);

$akses_manajemen = $_SESSION["level"] == "operator";


// sql katuk jek
$sql = "
SELECT 
    j.nama_jurusan AS jurusan,
    COUNT(s.id) AS total_siswa,
    ROUND(
        (COUNT(s.id) / NULLIF((SELECT COUNT(*) FROM siswa), 0) * 100),
        2
    ) AS persentase
FROM jurusan j
LEFT JOIN siswa s ON s.jurusan = j.nama_jurusan
GROUP BY j.nama_jurusan
ORDER BY total_siswa DESC
LIMIT 4;
";

$result = $koneksi->query($sql);

$topJurusan = [];
while ($row = $result->fetch_assoc()) 
{
    // kalau persentase NULL, ubah ke 0
    $persentase = $row['persentase'] ?? 0;
    if ($persentase === null) $persentase = 0;

    $topJurusan[] = [
        'jurusan' => $row['jurusan'],
        'total_siswa' => (int)$row['total_siswa'],
        'persentase' => (float)$persentase
    ];
}

// <?php
//                         $counter = 1;
//                         foreach($topJurusan as $row) {
//                             echo "<div>";
//                             echo "<p>" . $counter . "<p>";
//                             echo "<p>" . htmlspecialchars($row['jurusan']) . "</p>";
//                             echo "<p>" . $row['total_siswa'] . "</p>";
//                             echo "<p>" . $row['persentase'] . "%</p>";
//                             echo "</div>";
//                             $counter++;
//                         }
//                         

?>



<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/output.css">
    <title>MySchool DB</title>

</head>
<body>

    <!-- Background Image -->
    <div class="-z-20 absolute w-[100%] h-[100%] bg-[url(../asset/mammot.png)] bg-cover"></div>

    <!-- jadiin flex , tapi terserah khe mau body nya dijadiin flex langsung ato gimana dah-->
    <main class="flex p-7 gap-5">
        
        <!-- sidebarnya -->
        <nav>

            <div class="logolagi"> </div>
            
            <div class="menu">

                <p>MENU</p>

                <!-- INI DI HIGHLIGHTIN -->
                <a href="">
                    <div class="selector"></div>
                    <!-- icon -->
                    <img src="" alt="">
                    <p>Dashboard</p>
                </a>

                <!-- YG LAINNYA KAGAK -->
                <a href="">
                    <div class="selector"></div>
                    <!-- icon -->
                    <img src="" alt="">
                    <p>Siswa</p>
                </a>
                <a href="">
                    <div class="selector"></div>
                    <!-- icon -->
                    <img src="" alt="">
                    <p>Guru</p>
                </a>
                <a href="">
                    <div class="selector"></div>
                    <!-- icon -->
                    <img src="" alt="">
                    <p>Mapel</p>
                </a>
                <a href="">
                    <div class="selector"></div>
                    <!-- icon -->
                    <img src="" alt="">
                    <p>Jurusan</p>
                </a>
                <a href="">
                    <div class="selector"></div>
                    <!-- icon -->
                    <img src="" alt="">
                    <p>Ekstra</p>
                </a>
            </div>

            <div class="general">

                <p>GENERAL</p>
                <?php if ($akses_manajemen): ?>
                    <a href="">
                        <div class="selector"></div>
                        <!-- icon -->
                        <img src="" alt="">
                        <p>Administrasi</p>
                    </a>
                <?php endif; ?>

                <a href="logout.php">
                    <div class="selector"></div>
                    <!-- icon -->
                    <img src="" alt="">
                    <p>Log Out</p>
                </a>

            </div>
        </nav>

        <!-- Konten nya -->
        <div>
            
            <!-- Hero-->
            <div>
                <div><h1>Dashboard</h1> <p>database</p></div>
                <p>Lorem ipsum dolor sit amet conesrfdsdfsfdafsadf</p>
            </div>

            <!-- Konten -->
            <div>
                <!-- gak tau khe mau pake grid atau flexbox, aku taruh je php nya sni -->

                <a href="siswa/index.php">
                    <div>
                        <p>Siswa</p>
                        <h1><?php echo $jumlah_siswa; ?></h1>
                        <p><img src="" alt="">blablablablaba</p>
                    </div>
                </a>

                <a href="guru/index.php">
                    <div>
                        <p>Guru</p>
                        <h1><?php echo $jumlah_guru; ?></h1>
                        <p><img src="" alt="">blablabla</p>
                    </div>
                </a>

                <a href="mapel/index.php">
                    <div>
                        <p>Mapel</p>
                        <h1><?php echo $jumlah_mapel; ?></h1>
                        <p><img src="" alt="">blablabla</p>
                    </div>
                </a>

                <a href="jurusan/index.php">
                    <div>
                        <p>Total Jurusan</p>
                        <div>
                            <h1><?php echo $jumlah_mapel; ?></h1>
                            <p>blabablablabl</p>
                        </div>
                    </div>
                </a>


                <div>
                    <p>Top Populasi Jurusan</p>

                    <!-- serah khe gimana, bikin bikin aja dlu. tapi setidaknya responsif dikit soalnya data nya mungkin cuma 1 atau 2 -->
                </div>

                <!-- klo ada manajemen -->
                <?php if ($akses_manajemen): ?>
                    <div>
                        <div>
                            <h1><?php echo $jumlah_ekstra; ?></h1>
                            <div class="dividor"></div>
                            <div>
                                <h1>Ekstrakulikuler</h1>
                                <p>Komunitas / Grup</p>
                            </div>
                        </div>
                        <a href="ekstra/index.php">
                            Lihat
                            <img src="" alt="">
                        </a>
                    </div>

                    <a href="admin/index.php">
                        <img src="" alt="">
                        <p>Manajemen Pengguna</p>
                        <img src="" alt="">
                    </a>

                <?php endif; ?>

                <!-- klo gak ada manajemen -->
                <?php if (!$akses_manajemen): ?>
                    <div>
                        <div>
                            <h1><?php echo $jumlah_ekstra; ?></h1>
                            <div class="dividor"></div>
                            <div>
                                <h1>Ekstrakulikuler</h1>
                                <p>Komunitas / Grup</p>
                            </div>
                        </div>
                        <a href="ekstra/index.php">
                            Lihat
                            <img src="" alt="">
                        </a>
                    </div>
                <?php endif; ?>

            </div>
        </div>

    </main>

</body>
</html>