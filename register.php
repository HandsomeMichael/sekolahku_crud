

<!-- PHP -->

<?php

session_start();
include "koneksi.php";

// Verify reCAPTCHA


// Captcha Key, klo bisa pindah ke DB
$secret_key = "6Lf8ZewrAAAAANiJAos8XLq_oOWFsY-CqfCRyONN";

$recaptcha_response = $_POST['g-recaptcha-response'];
$verify_url = "https://www.google.com/recaptcha/api/siteverify";
$data = [
    'secret' => $secret_key,
    'response' => $recaptcha_response
];

$options = [
    'http' => [
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data)
    ]
];

$context = stream_context_create($options);
$result = file_get_contents($verify_url, false, $context);
$result_json = json_decode($result, true);

// Check if reCAPTCHA was successful
if ($result_json['success']) 
{
    // Cek login, tanpa keamanan
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($password_confirm !== $password) 
    {
        echo "<script>alert('Password dan konfirmasi password tidak sesuai');window.location='index_register.php';</script>";
        exit();
    }

    $cek = mysqli_query($koneksi, "SELECT * FROM petugas WHERE nama='$nama'");

    // Cek namanya ada gak
    if(mysqli_num_rows($cek) > 0)
    {
        echo "<script>alert('Username $nama sudah terdaftar');window.location='index_register.php';</script>";
        exit();
    }
    else
    {

        $ketawa = mysqli_query($koneksi, "INSERT INTO petugas (nama, password, level) VALUES ('$nama', '$password', 'guest')");

        if (!isset($ketawa)) 
        {
            echo "<script>alert('Pendaftaran tidak berhasil, silahkan coba lagi');window.location='index_register.php';</script>";
        }
        else     
        {
            $data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM petugas WHERE nama='$nama'"));

            $_SESSION['nama'] = $data['nama'];
            $_SESSION['level'] = $data['level'];
            $_SESSION['id'] = $data['id'];

            header("Location: dashboard.php");
        }
    }
} 
else 
{
    // reCAPTCHA FAILED
    echo "<script>alert('Captcha tidak berhasil');window.location='index_register.php';</script>";
}

?>