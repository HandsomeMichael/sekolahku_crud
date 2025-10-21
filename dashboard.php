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
//                         ?>


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
    <!-- jadiin flex , tapi terserah khe mau body nya dijadiin flex langsung ato gimana dah-->
    <main class="flex">
        
        <!-- sidebarnya -->
        <nav>
            <!-- Males ngisi -->

            <div class="logolagi"> 

            </div>
            
            <div class="menu">
                <p>MENU</p>

                <!-- INI DI HIGHLIGHTIN -->
                <div>
                    <p>Dashboard</p>
                </div>

                <div>
                    <p>Guru</p>
                </div>

                <div>
                    <p>Mapel</p>
                </div>

                <div>
                    <p>Jurusan</p>
                </div>

                <div>
                    <p>Ekstra</p>
                </div>
            </div>

            <div class="general">

                <p>GENERAL</p>
                <?php if ($akses_manajemen): ?>
                    <div>
                        <p>Administrasi</p>
                    </div>
                <?php endif; ?>

                <div class="">
                    <a href="logout.php">Log Out</a>
                </div>

            </div>
        </nav>

        <!-- Konten nya -->
        <section>
            
            <!-- Hero-->
            <section>
                <div><h1>Dashboard</h1> <p>database</p></div>
                <p>Lorem ipsum dolor sit amet conesrfdsdfsfdafsadf</p>
            </section>

            <!-- Konten -->
            <section>
                <!-- gak tau khe mau pake grid atau flexbox, aku taruh je php nya sni -->

                <a href="siswa/index.php">
                    <div>
                        <p>Siswa</p>
                        <h1><?php echo $jumlah_siswa; ?></h1>
                        <p><img src="" alt="">blablablablaba</p>
                    </div>
                    <img class="max-w-10 max-h-10 transition-all duration-300 group-hover:rotate-45" src="asset/arrow-hitam.png" alt="">
                </a>
                    <a href="#" class="bg-white flex gap-24  rounded-3xl p-8 group">
                    <div class="flex flex-col gap-5">
                        <h1 class=" text-3xl text-[#262626]">Mapel</h1>
                        <div class="flex flex-col gap-3">
                            <h2 class=" text-6xl font-bold text-black">3</h2>
                            <div class="flex items-center gap-2">
                                <img class="max-w-6" src="asset/pelajaran.png" alt="">
                                <h1 class="text-2xl text-[#08266A]">Mata pelajaran sekolah</h1>
                            </div>
                        </div>
                    </div>
                    <img class="max-w-10 max-h-10 transition-all duration-300 group-hover:rotate-45" src="asset/arrow-hitam.png" alt="">
                </a>
            </div>
            <div class="flex gap-6">
                <a href="#" class="flex flex-col w-[342px] gap-3 bg-white p-4 rounded-2xl group">
                    <div class="flex justify-between">
                        <h1 class=" text-3xl text-[#262626]">Total Jurusan</h1>
                        <img class="max-w-10 max-h-10 transition-all duration-300 group-hover:rotate-45" src="asset/arrow-hitam.png" alt="">
                    </div>
                    <div class="bg-[#3059BB] flex flex-col items-center gap-3 p-3 rounded-2xl">
                        <h1 class="text-6xl text-white font-bold">6</h1>
                        <h2 class="text-2xl text-white">Terdaftar Jurusan
                        Resmi</h2>
                    </div>
                </a>
                <div class="flex flex-col w-[660px] justify-between bg-white p-4 rounded-2xl">
                        <h1 class=" text-3xl text-[#262626]">Populasi Jurusan</h1>
                        <div class="flex justify-between">
                            <h1 class="text-[#3059BB] text-2xl font-bold">RPL</h1>
                            <div class="flex w-[570px] justify-between rounded-2xl pr-4 items-center bg-[#F1F5FF]">
                                <div class=" w-4/5 bg-[#3059BB] rounded-l-2xl flex items-center pl-4">
                                    <h1 class="text-white text-xl font-bold">35%</h1>
                                </div>
                                <h1 class="text-[#3059BB] text-xl font-bold">10</h1>
                            </div>
                        </div>
                                                <div class="flex justify-between">
                            <h1 class="text-[#3059BB] text-2xl font-bold">DKV</h1>
                            <div class="flex w-[570px] justify-between rounded-2xl pr-4 items-center bg-[#F1F5FF]">
                                <div class=" w-[50%] bg-[#3059BB] rounded-l-2xl flex items-center pl-4">
                                    <h1 class="text-white text-xl font-bold">10%</h1>
                                </div>
                                <h1 class="text-[#3059BB] text-xl font-bold">5</h1>
                            </div>
                        </div>
                                                <div class="flex justify-between">
                            <h1 class="text-[#3059BB] text-2xl font-bold">TKJ</h1>
                            <div class="flex w-[570px] justify-between rounded-2xl pr-4 items-center bg-[#F1F5FF]">
                                <div class=" w-[50%] bg-[#3059BB] rounded-l-2xl flex items-center pl-4">
                                    <h1 class="text-white text-xl font-bold">10%</h1>
                                </div>
                                <h1 class="text-[#3059BB] text-xl font-bold">4</h1>
                            </div>
                        </div>
                </div>
                <div class="flex flex-col p-7 gap-4 bg-white w-[360px] rounded-2xl">
                    <div class="flex gap-6">
                        <h1 class="text-6xl text-black font-bold">5</h1>
                        <div class="flex flex-col">
                            <h1 class="text-3xl text-black">Ekstrakulikuler</h1>
                            <h2 class="text-xl text-black">Komunitas / Grup</h2>
                        </div>
                    </div>
                    <a class="rounded-2xl p-6 bg-[#3059BB] text-white text-2xl font-bold border-2 border-white hover:border-[#3059BB] hover:bg-white hover:text-[#3059BB] transition-all duration-200" href="#">Lihat</a>
                </div>

                <!-- klo ada manajemen -->
                <?php if ($akses_manajemen): ?>
                    <div>

                    </div>
                    <div>

                    </div>
                <?php endif; ?>

                <!-- klo gak ada manajemen -->
                <?php if (!$akses_manajemen): ?>
                <?php endif; ?>

            </section>
        </section>
    </main>
</body>
</html>