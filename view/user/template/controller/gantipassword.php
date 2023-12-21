<?php
// Cek apakah metode yang digunakan adalah POST dan ada parameter aksi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['aksi']) && $_GET['aksi'] === 'ubah') {
    // Mendapatkan data dari formulir
    $passwordLama = $_POST['data'][0];
    $passwordBaru = $_POST['data'][1];
    $ulangiPassword = $_POST['data'][2];
    $idUser = $_SESSION['idUser'];

    // Mendapatkan data akun dari session
    $queryAkun = readData($koneksi, "akun", '', '', 'AkunID = "' . $idUser . '"');

    if (!empty($queryAkun)) {
        $rowAkun = $queryAkun[0];
        $hashedPasswordLama = $rowAkun['Password'];

        // Verifikasi password lama
        if (password_verify($passwordLama, $hashedPasswordLama)) {
            // Password lama benar
            // Periksa apakah password baru dan konfirmasi password cocok
            if ($passwordBaru === $ulangiPassword) {
                $combined_password = $rowAkun['Salt'] . $passwordBaru;
                // Hash password baru sebelum menyimpan ke database
                $hashedPasswordBaru = password_hash($combined_password, PASSWORD_BCRYPT);

                // Update password di database
                $updateResult = updateData($koneksi, 'akun', 'AkunID', $idUser, ['Password' => $hashedPasswordBaru]);
                $now = new DateTime();
                $currentTimestamp = $now->format('Y-m-d H:i:s');
                $aksi = $_GET['aksi'];
                $dataHistory = [
                    $idHistory,
                    $_SESSION['idUser'],
                    $aksi,
                    'akun',
                    $idUser,
                    $currentTimestamp
                ];
                
                $insertHistory = insertData($koneksi, 'riwayatakun', $dataHistory);
                
                if ($insertHistory==true &&$deleteResult == true || $insertResult == true || $updateResult == true) {
                    echo '<script>alert("Berhasil.");</script>';
                    echo '<script>window.location.href = "index.php?page=header.php";</script>';
                } else {
                    echo '<script>alert("Gagal.");</script>';
                    echo '<script>window.location.href = "index.php?page=header.php";</script>';
                }
            } else {
                // Jika password baru dan konfirmasi password tidak cocok
                echo '<script>alert("Password Tidak Cocok.");</script>';
                    echo '<script>window.location.href = "index.php?page=header.php";</script>';
            }
        } else {
            // Jika password lama salah
            echo '<script>alert("Password Lama Salah.");</script>';
                    echo '<script>window.location.href = "index.php?page=header.php";</script>';
        }
    }
}
?>
