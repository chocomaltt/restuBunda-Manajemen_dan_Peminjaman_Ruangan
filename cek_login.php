<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifikasi reCAPTCHA
    $recaptchaSecretKey = "6Ld5qhgpAAAAAGVQJeOny9_1CAUQL9aIu4qBduan";
    $recaptchaResponse = $_POST["g-recaptcha-response"];

    $recaptchaUrl = "https://www.google.com/recaptcha/api/siteverify";
    $recaptchaData = [
        "secret" => $recaptchaSecretKey,
        "response" => $recaptchaResponse,
    ];

    $recaptchaOptions = [
        "http" => [
            "method" => "POST",
            "content" => http_build_query($recaptchaData),
        ],
    ];

    $recaptchaContext = stream_context_create($recaptchaOptions);
    $recaptchaResult = json_decode(file_get_contents($recaptchaUrl, false, $recaptchaContext), true);


    // Cek apakah reCAPTCHA valid
    if ($recaptchaResult["success"]) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        include "config/koneksi.php";
        include "function/pesan_kilat.php";
        include "function/anti_injection.php";
        
        $username = antiinjection($koneksi, $_POST['username']);
        $password = antiinjection($koneksi, $_POST['password']);
        
        $query = "SELECT AkunID, Username, LevelID, Salt, Password as hashed_password FROM Akun WHERE Username = '$username'";
        $result = mysqli_query($koneksi, $query);
        
        // Tambahkan kode untuk menampilkan query jika terjadi kesalahan
        if (!$result) {
            die('Error in query: ' . mysqli_error($koneksi));
        }
        
        $row = mysqli_fetch_assoc($result);
        mysqli_close($koneksi);
        
        $salt = $row['Salt'];
        $hashed_password = $row['hashed_password'];
        
        if ($salt !== null && $hashed_password !== null) {
            $combined_password = $salt . $password;
            if (password_verify($combined_password, $hashed_password)) {
                $_SESSION['idUser'] = $row['AkunID']; // Perbaiki penulisan kolom 'Username'
                $_SESSION['level'] = $row['LevelID'];    // Perbaiki penulisan kolom 'LevelID'
                echo "ooo";
                // Tambahkan kode Remember Me
                // if (isset($_POST['rememberMe']) && $_POST['rememberMe'] == 1) {
                //     $expire = time() + 30 * 24 * 60 * 60; // Cookie berlaku selama 30 hari
                //     setcookie('remembered_user', $row['Username'], $expire, '/');
                // }
                $rememberMe = isset($_POST['rememberMe']) ? $_POST['rememberMe'] : 0;

                if ($rememberMe) {
                    // Jika Remember Me diaktifkan, atur cookie
                    setRememberMeCookie($userID, generateToken());
                }
                header("location:index.php");
            } else {
                // pesan('danger', "Login gagal. Password Anda Salah.");
                // header("Location: login.php");
                echo "Login gagal. Password Anda Salah.";
            }
        } else {
            // pesan('warning', "Username tidak ditemukan.");
            // header("Location: login.php");
            echo "Username tidak ditemukan.";
        }
    } else {
        // Tampilkan pesan error jika reCAPTCHA tidak valid
        echo "reCAPTCHA verification failed.";
    }
}
?>
