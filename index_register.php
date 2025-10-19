
<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MySchool DB</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- Ni link cdn nya ko -->
    <!-- https://tailwindcss.com/docs/installation/play-cdn -->

    <style type="text/tailwindcss">      
        @theme 
        {        
        --color-clifford: #da373d;      
        }    
    </style>

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
            <form action="register.php" method="post">

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

                <p>
                    <label>Confirm Password:</label><br>
                    <input type="password" name="confirm_password" required>
                    <button type="button" onclick="">Show</button>
                </p>
                
                <!-- Captcha nya -->
                <div class="g-recaptcha" data-sitekey="<?php echo $site_key; ?>"></div>
                <br>

                <!-- Backend nya ada di login.php -->
                <button type="submit">Daftar</button>

                <button>Balik ke Login</button>
                <!-- <input type="submit" value="Submit"> -->

            </form>
        </section>

        <!-- Ini imagenya -->
        <section>

        </section>
    </main>
</body>
</html>