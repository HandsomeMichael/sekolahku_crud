

<!-- PHP -->

<?php

session_start();
include "koneksi.php";

// Verify reCAPTCHA

$logpage = "indexbaru.php";

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
} 
else 
{
    // reCAPTCHA FAILED
    echo "<script>alert('Captcha tidak berhasil');window.location='$logpage';</script>";
}

?>