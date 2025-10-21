
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
   <link rel="stylesheet" href="src/output.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- Ni link cdn nya ko -->
    <!-- https://tailwindcss.com/docs/installation/play-cdn -->

</head>
<body class="overflow-hidden ">

    <script>
        function togglePasswordVisibility(input_id) 
        {
            const passwordInput = document.getElementById(input_id);
            const button = document.getElementById(input_id + '_img');

            button.setAttribute('src', button.getAttribute('src') === 'asset/View.png' ? 'asset/Hide.png' : 'asset/View.png');

            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        }
    </script>

    <section class="p-20 flex justify-around bg-gradient-to-b from-[50%] from-[#162955] to-[100%] to-[#3059bb] text-white">
        <img class="z-10 absolute bottom-0 left-0" src="asset/background.png" alt="">
        <div class=" z-20">
            <div class="flex flex-col gap-20">
                <h1 class="flex gap-2.5"><img class=" max-w-[24px]" src="asset/logo.png" alt="">MySchool DB</h1>
                <div class=" border-l-[5px] border-[#3159BB] pl-5">
                    <h1 class="relative text-[56px] font-semibold leading-12">Halo, <br>
                        Selamat Datang  <img class="absolute top-12 right-[108px]" src="asset/decoration.png" alt=""></h1>
                    <p class="text-[#7288BA] text-2xl font-medium">Silahkan masukkan data login mu</p>
                </div>
            </div>
        <form class="bg-white text-[#162955] p-8 pr-[68px] max-w-fit mt-10 rounded-xl flex flex-col gap-20" action="login.php"   method="post">
            <div class="flex flex-col gap-6 ">
                <div class="flex flex-col gap-2">
                    <h1 class="flex gap-2"><img class="max-w-6" src="asset/username.png" alt="👤">Username</h1>
                    <input class="text-[#152855]/50 p-3 border border-[#162955] rounded-[10px]" type="text" name="nama" placeholder="*Nama user" required>
                </div>
                <div class="flex flex-col gap-2">
                    <h1 class="flex gap-2"><img class="max-w-6" src="asset/password.png" alt="🔑"> Password:</h1>
                    <div class="flex gap-1.5">
                        <input id="password" class="w-[400px] text-[#152855]/50 p-3 border border-[#162955] rounded-[10px]" type="password" name="password" placeholder="*Password user" required>
                        <button class="p-3 border border-[#162955] rounded-[10px] " type="button" onclick="togglePasswordVisibility('password')"><img id="password_img" class="max-w-8" src="asset/View.png" alt=""></button>
                    </div>
                </div>
                <!-- Captcha -->
                <div class="g-recaptcha" data-sitekey="<?php echo $site_key; ?>"></div>
            </div>
            <div class="flex flex-col gap-7">
            <button class="py-3 px-24 bg-[#3059BB] rounded-xl font-bold text-white" type="submit">Masuk</button>
                <h1 class="flex items-center gap-4 text-[#162955] font-semibold text-xl">Tidak punya akun? <a class="text-lg underline text-[#3059BB] font-normal" href="index_register.php">Daftar sebagai Tamu</a></h1>
            </div>
        </form>
    </div>

    <img class="max-w-[641px] z-20 border-2 border-[#82A7FF] rounded-xl" src="asset/login-udin.png" alt="">

    </section>
</body>
</html> 