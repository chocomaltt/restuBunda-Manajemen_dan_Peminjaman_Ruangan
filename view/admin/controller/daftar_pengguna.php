<?php
if (!empty($_GET['aksi'])) {
    $tableName = "akun";
    $aksi = $_GET['aksi'];
    $idTable = 'AkunID'; //ubah ID tabel sesuai database
    $deleteResult = "";
    $insertResult = "";
    $updateResult = "";

    if ($aksi == "hapus") {
        $id = $_GET['id'];
        $deleteResult = deleteData($koneksi, $tableName, $idTable, $id);

    } else if ($aksi == "tambah") {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = $_POST['data'];
            $password = $_POST['password'];
            $salt = bin2hex(random_bytes(16));
            $combined_password = $salt . $password;
            $data[5] = password_hash($combined_password, PASSWORD_BCRYPT);
            $data[6] = $salt;
            $insertResult = insertData($koneksi, $tableName, $data);
        }
    } else if ($aksi == "ubah") {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = $_POST['data'];
            $id = $data[0];

            $updateValues = [ //ubah isinya sesuai database
                'Nama' => $data[1],
                'LevelID' => $data[2],
                'KelasID' => $data[3],
                'Username' => $data[4]
            ];

            $updateResult = updateData($koneksi, $tableName, $idTable, $id, $updateValues);

        }
    }

    if ($deleteResult == true || $insertResult == true || $updateResult == true) {
        echo '<script>alert("Berhasil.");</script>';
        echo '<script>window.location.href = "index.php?page=daftar_pengguna.php";</script>';
    } else {
        echo '<script>alert("Gagal.");</script>';
        echo '<script>window.location.href = "index.php?page=daftar_pengguna.php";</script>';
    }
}


?>