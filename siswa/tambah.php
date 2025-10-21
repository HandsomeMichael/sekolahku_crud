<?php

include "../redirectsesi.php";
include "../koneksi.php";

$akses_manajemen = $_SESSION["level"] == "operator";

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

                <a href="">
                    <div class="selector"></div>
                    <!-- icon -->
                    <img src="" alt="">
                    <p>Administrasi</p>
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

            <!-- INI AJA YANG DI PERTAHANKAN, YG LAIN HAPUS HAPUS HAPUS BOM BOM BOOM -->
            <div>
                <form method="POST">
                    <div>
                        <label for="nis" class="block text-sm font-medium">NIS</label>
                        <input id="nis" name="nis" required type="number" class="mt-1 block w-full border rounded px-3 py-2" placeholder="Masukkan NIS">
                    </div>

                    <div>
                        <label for="nama" class="block text-sm font-medium">Nama Lengkap</label>
                        <input id="nama" name="nama" required type="text" class="mt-1 block w-full border rounded px-3 py-2" placeholder="Masukkan nama">
                    </div>

                    <div>

                        <div class="relative w-full my-3">
                            <label class="my-2 text-primary">Kelas</label>
                            <select name="kelas" required class="">
                                <option value="">Pilih Kelas</option>
                                <option value="10">X / 10</option>
                                <option value="11">XI / 11</option>
                                <option value="12">XII / 12</option>
                            </select>
                        </div>
                        
                        <div class="relative w-full my-3">
                            <label class="my-2 text-primary">Jurusan</label>
                            <select name="jurusan" required class="">
                                <option value="">Pilih Jurusan</option>
                                <?php
                                $major_query = mysqli_query($koneksi, "SELECT * FROM jurusan ORDER BY nama_jurusan");
                                while($major = mysqli_fetch_array($major_query)){
                                ?>
                                    <option value="<?= $major['nama_jurusan']; ?>"><?= $major['nama_jurusan']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div>
                            <a href="index.php">Cancel</a>
                            <button type="submit" name="simpan" class="flex h-15 w-40 justify-center items-center rounded-[10px] bg-primary text-white">
                                Daftarkan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>

<?php
if(isset($_POST['simpan'])){
    mysqli_query($conn, "INSERT INTO siswa (nama, nis, kelas, jurusan)
    VALUES ('$_POST[name]','$_POST[nis]','$_POST[kelas]','$_POST[jurusan]')");
    echo "<script>alert('Data siswa berhasil disimpan');window.location='student.php';</script>";
}
?>