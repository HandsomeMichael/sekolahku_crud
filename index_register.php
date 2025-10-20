
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
        <!-- Ini loginnya -->
        <section class="p-20 flex justify-around bg-gradient-to-b from-[#162955] to-[#3059bb] text-white">
            <img class="z-10 absolute bottom-0 left-0" src="asset/background.png" alt="">
            <div class=" z-20">
                <div class="flex flex-col gap-10">
                    <h1 class="flex gap-2.5"><img class=" max-w-[24px]" src="asset/logo.png" alt="">MySchool DB</h1>
                    <div class=" border-l-[5px] border-[#3159BB] pl-5">
                        <h1 class="relative text-[56px] font-semibold leading-12">Halo, Guest  <br>
                            Selamat Datang <img class="absolute top-12 right-32" src="asset/decoration.png" alt=""></h1>
                        <p class="text-[#7288BA] text-2xl font-medium">Silahkan Daftar mas bro</p>
                    </div>
                </div>
            <form class="bg-white text-[#162955] p-8 pr-[68px] max-w-fit mt-10 rounded-xl flex flex-col gap-12" action="register.php"   method="post">
                <div class="flex flex-col gap-6 ">
                    <div class="flex flex-col gap-2">
                        <h1 class="flex gap-2"><img class="max-w-6" src="asset/username.png" alt="">Username</h1>
                        <input class="text-[#152855]/50 p-3 border border-[#162955] rounded-[10px]" type="text" name="nama" placeholder="*Nama user di database" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="flex gap-2"><img class="max-w-6" src="asset/password.png" alt=""> Password:</h1>
                        <div class="flex gap-1.5">
                            <input class="w-[400px] text-[#152855]/50 p-3 border border-[#162955] rounded-[10px]" type="password" name="password" placeholder="*Password user" required>
                            <button class="p-3 border border-[#162955] rounded-[10px] " type="button" onclick=""><img class="max-w-8" src="asset/View.png" alt=""></button>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="flex gap-2"><img class="max-w-6" src="asset/password.png" alt=""> Konfirmasi Password:</h1>
                        <div class="flex gap-1.5">
                            <input class="w-[400px] text-[#152855]/50 p-3 border border-[#162955] rounded-[10px]" type="password" name="password_confirm" placeholder="*Ketik ulang password" required>
                            <button class="p-3 border border-[#162955] rounded-[10px] " type="button" onclick=""><img class="max-w-8" src="asset/View.png" alt=""></button>
                        </div>
                    </div>
                    <div class="g-recaptcha" data-sitekey="<?php echo $site_key; ?>"></div>
                </div>
                <div class="flex gap-7">
                    <a href="#" class="py-3 px-24 bg-[#3059BB] rounded-xl font-bold text-white" type="submit">Daftar</a>
                    <!-- ni balik ke index.php nya ya ko, ku gak ngerti pake button -->
                    <a href="index.php" class="py-3 px-10 bg-white border-2 border-[#3059BB] rounded-xl font-bold text-[#3059BB]" type="submit">Kembali ke Login</a>
                    <!-- <h1 class="flex items-center gap-4 text-[#162955] font-semibold text-xl">Tidak punya akun? <a class="text-lg underline text-[#3059BB] font-normal" href="register.php">Daftar sebagai Tamu</a></h1> -->
                </div>  
            </form>
        </div>  
        <img class="max-w-[641px] max-h-[800px] z-20 border-2 border-[#82A7FF] rounded-xl" src="asset/register-udin.png" alt="">
        </section>
</body>
</html> 