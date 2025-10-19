
<!-- PHP -->
<?php

// Captcha Key, klo bisa pindah ke DB
$site_key = "6Lf8ZewrAAAAAO5sWOwxkXW7_Dp3tLm0auSyj_W9";

// Kalau udah login, langsung ke dashboard
session_start();

// Gak aman kntl
if(isset($_SESSION['nama']) && isset($_SESSION['level']) && isset($_SESSION['id']))
{
    header("Location: dashboard.php");
}

?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MySchool DB</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>
<body>
    <main>
        <!-- Ini loginnya -->
        <section>

            <!-- Kalimat intro -->
            <h1>Halo, Selamat Datang</h1>
            <p>Silahkan masukkan data login mu</p>

            <!-- Formnya, mungkin di wrap pake div lagi -->
             <!-- Klo gagal login gr gr captcha, pake logincap.php -->
            <form action="login.php" method="post">

                <!-- Nama user -->
                <p>
                    <label>Nama:</label><br>
                    <input type="text" name="nama" required>
                </p>

                <!-- Password , klo bisa tambahin button show / hide password nya -->
                <p>
                    <label>Password:</label><br>
                    <input type="password" name="password" required>
                    <button type="button" onclick="">Show</button>
                </p>
                
                <!-- Captcha nya -->
                <div class="g-recaptcha" data-sitekey="<?php echo $site_key; ?>"></div>
                <br>

                <!-- Backend nya ada di login.php -->
                <button type="submit">Masuk</button>

                <div>
                    <p>Belum punya akun? <a href="register.php">Daftar disini</a></p>
                </div>
                <!-- <input type="submit" value="Submit"> -->

            </form>
        </section>

        <!-- Ini imagenya -->
        <section>

        </section>
    </main>
</body>
</html>