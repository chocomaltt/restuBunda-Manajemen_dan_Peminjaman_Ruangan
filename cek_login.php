<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "config/koneksi.php";
include "function/pesan_kilat.php";
include "function/anti_injection.php";

$username = antiinjection($koneksi, $_POST['username']);
$password = antiinjection($koneksi, $_POST['password']);

$query = "SELECT Username, LevelID, Salt, Password as hashed_password FROM Akun WHERE Username = '$username'";
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
        $_SESSION['username'] = $row['Username']; // Perbaiki penulisan kolom 'Username'
        $_SESSION['level'] = $row['LevelID'];    // Perbaiki penulisan kolom 'LevelID'
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
?>
