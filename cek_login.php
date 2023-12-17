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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verifikasi reCAPTCHA
        // (your reCAPTCHA verification code remains unchanged)
    
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
                    $_SESSION['idUser'] = $row['AkunID'];
                    $_SESSION['level'] = $row['LevelID'];
                    
                    // Check if Remember Me is selected
                    $rememberMe = isset($_POST['rememberMe']) ? $_POST['rememberMe'] : 0;
    
                    // if ($rememberMe) {
                    //     // Generate a unique token
                    //     $token = generateToken();
    
                    //     // Save the token in the database (you need a table for this purpose)
                    //     saveRememberMeToken($row['AkunID'], $token);
    
                    //     // Set the Remember Me cookie
                    //     setRememberMeCookie($row['AkunID'], $token);
                    // }
                    header("location:index.php");
                } else {
                    echo "Login gagal. Password Anda Salah.";
                }
            } else {
                echo "Username tidak ditemukan.";
            }
        } else {
            echo "reCAPTCHA verification failed.";
        }
    }
}
?>
