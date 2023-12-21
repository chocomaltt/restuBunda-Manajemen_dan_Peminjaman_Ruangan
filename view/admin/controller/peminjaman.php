<?php
if (!empty($_GET['aksi'])) {
    $tableName = "peminjaman";
    $aksi = $_GET['aksi'];
    $idTable = 'PeminjamanID'; //ubah ID tabel sesuai database
    $setujuResult = "";
    $tolakResult = "";
    if ($aksi == "setujui") {
        $id = $_GET['id'];
        $updateValues = [ //ubah isinya sesuai database
            'StatusPeminjaman' => "Disetujui"
        ];
        $setujuResult = updateData($koneksi, $tableName, $idTable, $id, $updateValues);
    } else if ($aksi == "tolak") {
        $id = $_GET['id'];
        $updateValues = [ //ubah isinya sesuai database
            'StatusPeminjaman' => "Ditolak"
        ];
        $tolakResult = updateData($koneksi, $tableName, $idTable, $id, $updateValues);
    }
    $now = new DateTime();
    $currentTimestamp = $now->format('Y-m-d H:i:s');
    $aksi = $_GET['aksi'];
    $dataHistory = [
        $idHistory,
        $_SESSION['idUser'],
        $aksi,
        $tableName,
        $id,
        $currentTimestamp
    ];
    
    $insertHistory = insertData($koneksi, 'riwayatakun', $dataHistory);
    
    if ($insertHistory==true && $setujuResult == true || $tolakResult == true) {
        echo '<script>alert("Berhasil.");</script>';
        echo '<script>window.location.href = "index.php?page=peminjaman.php";</script>';
    } else {
        echo '<script>alert("Gagal.");</script>';
        echo '<script>window.location.href = "index.php?page=peminjaman.php";</script>';
    }
    
} 


?>