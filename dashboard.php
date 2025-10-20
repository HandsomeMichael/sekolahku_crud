<?php

include "redirectsesi.php";
include "koneksi.php";

$tabel_siswa = mysqli_query($koneksi, "SELECT * FROM siswa");
$jumlah_siswa = mysqli_num_rows($tabel_siswa);

$tabel_jurusan = mysqli_query($koneksi, "SELECT * FROM jurusan");
$jumlah_jurusan = mysqli_num_rows($tabel_jurusan);


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



?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MySchool DB</title>

</head>
<body>
    <!-- jadiin flex , tapi terserah khe mau body nya dijadiin flex langsung ato gimana dah-->
    <main>
        
        <!-- sidebarnya -->
        <nav>
            <!-- Males ngisi -->

            <div class="logolagi"> 

            </div>
            
            <div class="menu">

            </div>

            <div class="general">

                <div class="">
                    <a href="logout.php">Logout</a>
                </div>

            </div>

            <div class="akun">

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

                <div>
                    <p>Siswa</p>
                    <h1><?php echo $jumlah_siswa; ?></h1>
                    <p><a href="icon"></a>blablablablaba</p>
                </div>

                <div>
                    <p>Populasi Jurusan</p>
                    <?php
                        $counter = 1;
                        foreach($topJurusan as $row) {
                            echo "<div>";
                            echo "<p>" . $counter . "<p>";
                            echo "<p>" . htmlspecialchars($row['jurusan']) . "</p>";
                            echo "<p>" . $row['total_siswa'] . "</p>";
                            echo "<p>" . $row['persentase'] . "%</p>";
                            echo "</div>";
                            $counter++;
                        }
                        ?>
                    <div>
                        
                    </div>
                </div>

            </section>
        </section>
    </main>
</body>
</html>