<?php
if (!empty($_GET['aksi'])) {
    $tableName = "ruang";
    $aksi = $_GET['aksi'];
    $idTable = 'RuangID'; //ubah ID tabel sesuai database
    $deleteResult = "";
    $insertResult = "";
    $updateResult = "";

    if ($aksi == "hapus") {
        $id = $_GET['id'];
        $deleteResult = deleteData($koneksi, $tableName, $idTable, $id);

    } else if ($aksi == "tambah") {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = $_POST['data'];
            $id = $data[0];
            $insertResult = insertData($koneksi, $tableName, $data);
        }
    } else if ($aksi == "ubah") {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = $_POST['data'];
            $id = $data[0];

            $updateValues = [ //ubah isinya sesuai database
                'NamaRuang' => $data[1],
                'JenisRuang' => $data[2],
                'DeskripsiRuang' => $data[3],
                'Lantai' => $data[4],
                'Kapasitas' => $data[5]
            ];

            $updateResult = updateData($koneksi, $tableName, $idTable, $id, $updateValues);

        }
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
    
    if ($insertHistory==true && $deleteResult == true || $insertResult == true || $updateResult == true) {
        echo '<script>alert("Berhasil.");</script>';
        echo '<script>window.location.href = "index.php?page=kelola_ruang.php";</script>';
    } else {
        echo '<script>alert("Gagal.");</script>';
        echo '<script>window.location.href = "index.php?page=kelola_ruang.php";</script>';
    }
}


?>