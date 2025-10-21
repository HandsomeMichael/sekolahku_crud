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

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/output.css">
    <title>MySchool DB</title>

</head>
<body class="flex gap-6 p-10 overflow-hidden">
    <!-- sidebar -->
     <nav class="flex flex-col justify-between shadow-2xl bg-[#F4F4F4]/80 rounded-2xl h-[880px]"> 
        <div class="flex flex-col">
            <div class="p-8 rounded-t-2xl bg-gradient-to-b from-[#7DA0F2] to-[#D9E4FF] flex gap-4 items-center">
                <img class=" max-w-14" src="asset/logo-trans.png" alt="">
                <h1 class="font-medium text-2xl text-[#435E9E]">MySchool <span class="font-bold text-[#182D5F]">DB</span></h1>
            </div>
            <div class="flex flex-col gap-4 p-8">
                <h1 class="text-[#888888]">MENU</h1>
                <a href="#" class="flex gap-5 items-center"><img class="max-w-10" src="asset/dashboard.png" alt=""><h1 class=" text-2xl text-[#1C346C] font-bold">Dashboard</h1></a>
                <a href="#" class="flex gap-5 items-center"><img class="max-w-10" src="asset/siswa.png" alt=""><h1 class=" text-2xl text-[#7B7B7B] font-regular">Siswa</h1></a>
                <a href="#" class="flex gap-5 items-center"><img class="max-w-10" src="asset/guru.png" alt=""><h1 class=" text-2xl text-[#7B7B7B] font-regular">Guru</h1></a>
                <a href="#" class="flex gap-5 items-center"><img class="max-w-10" src="asset/mapel.png" alt=""><h1 class=" text-2xl text-[#7B7B7B] font-regular">Mapel</h1></a>
                <a href="#" class="flex gap-5 items-center"><img class="max-w-10" src="asset/jurusan.png" alt=""><h1 class=" text-2xl text-[#7B7B7B] font-regular">Jurusan</h1></a>
                <a href="#" class="flex gap-5 items-center"><img class="max-w-10" src="asset/ekstra.png" alt=""><h1 class=" text-2xl text-[#7B7B7B] font-regular">Ekstra</h1></a>
                <h1 class="text-[#888888]">GENERAL</h1>
                <a href="#" class="flex gap-5 items-center"><img class="max-w-10" src="asset/siswa.png" alt=""><h1 class=" text-2xl text-[#7B7B7B] font-regular">Administrasi</h1></a>
                <a href="#" class="flex gap-5 items-center"><img class="max-w-10" src="asset/log-out.png" alt=""><h1 class=" text-2xl text-[#C93333] font-bold">Log Out</h1></a>
            </div>
        </div>
        <div class="mx-2 mb-6  flex gap-4 items-center p-2 drop-shadow-2xl bg-white rounded-2xl max-w-[300px]">
            <img class="max-w-[64px]" src="asset/pp.png" alt="">
            <div class="flex flex-col">
                <h1 class="text-2xl text-[#3059BB] font-bold">Tiens Mahasta</h1>
                <h2 class="text-[#5C5E62]">Operator</h2>
            </div>
        </div>
     </nav>
    <!-- sidebar -->
     <!-- main -->
      <section class="flex flex-col gap-6">
            <div class="bg-[#F4F4F4]/80 flex flex-col rounded-2xl shadow-2xl items-center w-[1500px] py-6">
                <div class="flex items-center gap-5">
                    <h1 class=" text-5xl text-[#162956] font-bold">Dashboard</h1>
                    <h2 class="mono text-4xl bg-[#162956] font-bold text-white p-4 rounded-3xl">db_sekolah</h2>
                </div>
                <p class="text-[#A3A3A3] font-medium text-3xl">Selamat datang di Dashboard, Tiens Mahasta</p>
        </div>
        <div class="bg-[#F4F4F4]/80 flex flex-col rounded-2xl shadow-2xl gap-6 items-center w-[1500px] py-6">
            <img class="w-[1420px] h-[170px]" src="asset/dashboard-img.png" alt="">
            <div class="flex gap-4">
                <a href="#" class="bg-[#3059BB] flex gap-24 rounded-3xl p-8 group">
                    <div class="flex flex-col gap-5">
                        <h1 class=" text-3xl text-[#B5C3E6]">Siswa Terdaftar</h1>
                        <div class="flex flex-col gap-3">
                            <h2 class=" text-6xl font-bold text-white">20</h2>
                            <div class="flex items-center gap-2">
                                <img class="max-w-6" src="asset/faris.png" alt="">
                                <h1 class="text-2xl text-[#FFF7B2]">Pendaftaran siswa</h1>
                            </div>
                        </div>
                    </div>
                    <img class="max-w-14 max-h-14 group-hover:rotate-45 transition-all duration-300" src="asset/arrow.png" alt="">
                </a>
                                <a href="#" class="bg-white flex gap-24 rounded-3xl p-8 group">
                    <div class="flex flex-col gap-5">
                        <h1 class=" text-3xl text-[#262626]">Guru Terdaftar</h1>
                        <div class="flex flex-col gap-3">
                            <h2 class=" text-6xl font-bold text-black">5</h2>
                            <div class="flex items-center gap-2">
                                <img class="max-w-6" src="asset/ngajar.png" alt="">
                                <h1 class="text-2xl text-[#08266A]">Pendaftaran pengajar</h1>
                            </div>
                        </div>
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
            </div>
        </div>
      </section>    
     <!-- main -->
</body>
</html>