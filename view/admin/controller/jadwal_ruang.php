<?php
if (!empty($_GET['aksi'])) {
    $tableName = "jadwalruangruang";
    $aksi = $_GET['aksi'];
    $idTable = 'JadwalRuangID'; //ubah ID tabel sesuai database
    $deleteResult = "";
    $insertResult = "";
    $updateResult = "";

    if ($aksi == "hapus") {
        $id = $_GET['id'];
        $deleteResult = deleteData($koneksi, $tableName, $idTable, $id);
    } else if ($aksi == "tambah") {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = $_POST['data'];
            $insertResult = insertData($koneksi, $tableName, $data);
        }
    } else if ($aksi == "ubah") {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = $_POST['data'];
            $id = $data[0];

            $updateValues = [ //ubah isinya sesuai database
                'KelasID' => $data[1],
                'RuangID' => $data[2],
                'HariID' => $data[3],
                'MataKuliahID' => $data[4],
                'AkunID' => $data[5],
                'SesiMulaiID' => $data[6],
                'SesiAkhirID' => $data[7],
            ];

            $updateResult = updateData($koneksi, $tableName, $idTable, $id, $updateValues);
        }
    }

    if ($deleteResult == true || $insertResult == true || $updateResult == true) {
        echo '<script>alert("Berhasil.");</script>';
        echo '<script>window.location.href = "index.php?page=jadwal_ruang.php";</script>';
    } else {
        echo '<script>alert("Gagal.");</script>';
        echo '<script>window.location.href = "index.php?page=jadwal_ruang.php";</script>';
    }
}