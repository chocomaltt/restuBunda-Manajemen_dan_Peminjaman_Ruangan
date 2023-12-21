<?php
if (!empty($_GET['aksi'])) {
    $tableName = "peminjaman";
    $aksi = $_GET['aksi'];
    $idTable = 'PeminjamanID'; //ubah ID tabel sesuai database
    $setujuResult = "";
    if ($aksi == "setujui") {
        $id = $_GET['id'];
        $updateValues = [ //ubah isinya sesuai database
            'CatatanPengembalian' => $_POST['CatatanPengembalian'],
            'StatusPengembalian' => "Selesai"
        ];
        $setujuResult = updateData($koneksi, $tableName, $idTable, $id, $updateValues);
    }
} 
    if ($setujuResult == true) {
        echo '<script>alert("Berhasil.");</script>';
        echo '<script>window.location.href = "index.php?page=peminjaman.php";</script>';
    } else {
        echo '<script>alert("Gagal.");</script>';
        echo '<script>window.location.href = "index.php?page=peminjaman.php";</script>';
    }



?>