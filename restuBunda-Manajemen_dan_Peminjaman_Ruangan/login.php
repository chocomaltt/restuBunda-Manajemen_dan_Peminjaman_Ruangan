<?php
if(session_status() === PHP_SESSION_NONE)
    session_start();
include "function/pesan_kilat.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="restuBunda">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Manajemen dan Peminjaman Ruangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/custom_color.css">
    <!-- recaptcha v2 -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        @font-face {
            font-family: 'Plus Jakarta Sans';
            src: url('assets/font/PlusJakartaSans-VariableFont_wght.ttf') format('.ttf'),
            url('assets/font/PlusJakartaSans-Italic-VariableFont_wght.ttf') format('.ttf');
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .custom-label{
            background-color: #f4f6ff;
        }
    </style>
</head>
<body>
    <section class="container-fluid text-center" style="height: 100vh;">
        <div class="row" style="height: 100%">
            <div class="col d-flex justify-content-center align-items-center" style="width:100%; height:100vh; background-color: #10375C; opacity: 1; background-image: url(assets/img/gedung_sipil_login.png);  background-size:100% 100%;">
                <h2 class="text-white fw-medium">Selamat Datang</h2>
            </div>
            <div class="col bg-biru d-flex flex-column justify-content-center align-items-center">
                <form action="cek_login.php" class="d-flex flex-column gap-3 w-75 px-3 py-5 bg-white rounded-4" method="post">
                    <div class="w-100 justify-content-center">
                        <img src="assets/img/logo_jti_baru.png" style="width: 13%;" class="justify-content-center" alt="">
                    </div>
                    <h1 class="h3 mb-5 fw-bolder">Peminjaman Ruangan</h1>
                    <div class="form-floating">
                        <input type="text" class="form-control form-default shadow bg-body-tetiary-rounded" id="floatingInput" placeholder="Username" name="username" required>
                        <label for="floatingInput" class="label-hitam">Username</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control form-default shadow bg-body-tetiary-rounded" id="floatingPassword" placeholder="Password" name="password" required>
                        <label for="floatingPassword">Password</label>
                    </div>
                    <!-- recaptcha v2 -->
                    <div class="g-recaptcha" data-sitekey="6Ld5qhgpAAAAAPaPpVpRRO2_4TfMCMZMqHDKgObt"></div>
                    <div class="d-flex justify-content-between">
                        <div class="form-check text-start mt-2 ">
                            <input type="checkbox" class="form-check-input border border-black" value="remember-me" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">Remember me</label>
                        </div>
                        <button class="btn btn-hijau pt-2" type="submit" style="width: 35%;">Login</button>
                    </div>  
                </form>
            </div>
        </div>
    </section>
</body>
</html>