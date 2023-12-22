<?php
if (!empty($_GET['id'])) {
    $id = "'".$_GET['id']."'";
    $updateValues = [ //ubah isinya sesuai database
        'StatusPeminjaman' => 'Dibatalkan',
        'StatusPengembalian' => 'Menunggu Konfirmasi'
    ];
    $query = updateData(
        $koneksi,
        'peminjaman',
        'PeminjamanID',
        $id, $updateValues
    );
    $now = new DateTime();
    $currentTimestamp = $now->format('Y-m-d H:i:s');
    
    $dataHistory = [
        $idHistory,
        $_SESSION['idUser'],
        'ubah',
        'peminjaman',
        $id,
        $currentTimestamp
    ];
    
    $insertHistory = insertData($koneksi, 'riwayatakun', $dataHistory);
    
    if ($insertHistory==true && $query == true){
        echo '<script>alert("Berhasil.");</script>';
        echo '<script>window.location.href = "index.php?page=antrean-pinjam.php";</script>';
    } else {
        echo '<script>alert("Gagal.");</script>';
        echo '<script>window.location.href = "index.php?page=antrean-pinjam.php";</script>';
    }
}
?>