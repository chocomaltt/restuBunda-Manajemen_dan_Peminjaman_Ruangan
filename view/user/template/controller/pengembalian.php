<?php
if (!empty($_GET['id'])) {
    $id = "'".$_GET['id']."'";
    $updateValues = [ 
        'StatusPengembalian' => 'Menunggu Konfirmasi'
    ];
    $query = updateData(
        $koneksi,
        'peminjaman',
        'PeminjamanID',
        $id, $updateValues
    );
    if($query == true){
        echo '<script>alert("Berhasil.");</script>';
        echo '<script>window.location.href = "index.php?page=pengembalian.php";</script>';
    } else {
        echo '<script>alert("Gagal.");</script>';
        echo '<script>window.location.href = "index.php?page=pengembalian.php";</script>';
    }
}
?>