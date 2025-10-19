

<!-- PHP -->

<?php

session_start();
include "koneksi.php";

$nama = $_POST['nama'];
$password = $_POST['password'];

$cek = mysqli_query($koneksi, "SELECT * FROM petugas WHERE nama='$nama' AND password='$password'");

if(mysqli_num_rows($cek) > 0)
{
    $data = mysqli_fetch_array($cek);

    $_SESSION['nama'] = $data['nama'];
    $_SESSION['level'] = $data['level'];
    $_SESSION['id'] = $data['id'];

    header("Location: dashboard.php");
}
else
{
    echo "<script>alert('Username atau password salah');window.location='$logpage';</script>";
}

?>