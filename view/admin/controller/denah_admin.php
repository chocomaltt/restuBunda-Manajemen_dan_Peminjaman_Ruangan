<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['aksi']) && $_GET['aksi'] === 'ubah') {
    $tableName = "denah";
    $idTable = 'DenahID';
    // Mendapatkan data dari formulir
    $denahID = $_POST['data'][0]; // Sesuaikan indeks dengan data yang sesuai
    $deskripsiLantai = $_POST['data'][2]; // Sesuaikan indeks dengan data yang sesuai

    // Upload file baru (jika ada)
    $uploadDir = 'path/to/upload/directory/'; // Ganti dengan path direktori tempat Anda menyimpan file
    $uploadedFile = $_FILES['data'][1];

    if ($uploadedFile['error'] == UPLOAD_ERR_OK) {
        $filename = basename($uploadedFile['name']);
        $targetPath = $uploadDir . $filename;

        if (move_uploaded_file($uploadedFile['tmp_name'], $targetPath)) {
            // File berhasil diupload, lanjutkan proses update
            $dataToUpdate = array(
                'DeskripsiLantai' => $deskripsiLantai,
                'File' => $filename, // Simpan nama file ke database
            );

            // Lakukan update data denah di database
            $updateResult = updateData($koneksi, $tableName, $idTable, $denahID, $dataToUpdate);
        } else {
            echo "Gagal mengupload file.";
            exit();
        }
    } else {
        // File tidak diupload, lanjutkan proses update tanpa mengubah file
        $dataToUpdate = array(
            'DeskripsiLantai' => $deskripsiLantai,
        );

        // Lakukan update data denah di database
        $updateResult = updateData($koneksi, 'denah', $idTable, $denahID, $dataToUpdate);
    }

    $now = new DateTime();
    $currentTimestamp = $now->format('Y-m-d H:i:s');
    $aksi = $_GET['aksi'];
    $dataHistory = [
        $idHistory,
        $_SESSION['idUser'],
        $aksi,
        $tableName,
        $denahID,
        $currentTimestamp
    ];

    $insertHistory = insertData($koneksi, 'riwayatakun', $dataHistory);

    if ($insertHistory == true && $updateResult == true) {
        echo '<script>alert("Berhasil.");</script>';
        echo '<script>window.location.href = "index.php?page=denah_admin.php";</script>';
    } else {
        echo '<script>alert("Gagal.");</script>';
        echo '<script>window.location.href = "index.php?page=denah_admin.php";</script>';
    }
}
