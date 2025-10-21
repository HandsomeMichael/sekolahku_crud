<?php

include "../redirectsesi.php";
include "../koneksi.php";

$akses_manajemen = $_SESSION["level"] == "operator";

if(isset($_GET['id'])) 
{
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id='$id'");
    $data = mysqli_fetch_array($query);
    
    if(!$data) {
        echo "<script>alert('Data siswa tidak ditemukan');window.location='index.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ID siswa tidak valid');window.location='index.php';</script>";
    exit();
}

if(isset($_POST['update']))
{
    $nama = $_POST['name'];
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    
    if(mysqli_query($koneksi, "UPDATE siswa SET 
        nama='$nama', 
        nis='$nis', 
        kelas='$kelas', 
        jurusan='$jurusan' 
        WHERE id='$id'")) 
    {
        echo "<script>alert('Data Siswa berhasil diperbarui');window.location='index.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "');</script>";
    }
}

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
                        <input id="nis" name="nis" value="<?= $data['nis'] ?>" required type="number" class="mt-1 block w-full border rounded px-3 py-2" placeholder="Masukkan NIS">
                    </div>

                    <div>
                        <label for="nama" class="block text-sm font-medium">Nama Lengkap</label>
                        <input id="nama" name="nama" value="<?= $data['nama'] ?>" required type="text" class="mt-1 block w-full border rounded px-3 py-2" placeholder="Masukkan nama">
                    </div>

                    <div>

                        <div class="relative w-full my-3">
                            <label class="my-2 text-primary">Kelas</label>
                            <select name="kelas" required class="">
                                <option value="10" <?= $data['kelas'] == '10' ? 'selected' : '' ?>>X / 10</option>
                                <option value="11" <?= $data['kelas'] == '11' ? 'selected' : '' ?>>XI / 11</option>
                                <option value="12" <?= $data['kelas'] == '12' ? 'selected' : '' ?>>XII / 12</option>
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
                                    <option value="<?= $major['nama_jurusan']; ?>" <?= $data['jurusan'] == $major['nama_jurusan'] ? 'selected' : '' ?>><?= $major['nama_jurusan']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div>
                            <a href="index.php">Cancel</a>
                            <button type="submit" name="simpan" class="flex h-15 w-40 justify-center items-center rounded-[10px] bg-primary text-white">
                                Edit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>