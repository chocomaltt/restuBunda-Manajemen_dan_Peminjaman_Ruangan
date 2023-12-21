<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tableName = "Peminjaman";
    $data = $_POST['data'];

    $ruangDipinjam = $data[2];
    $waktuPinjam = $data[3];
    $waktuKembali = $data[4];

    $jadwalRuang = cekJadwalRuang($koneksi, $ruangDipinjam, $waktuPinjam, $waktuKembali);
    $jadwalPeminjaman = cekPeminjamanRuang($koneksi, $ruangDipinjam, $waktuPinjam, $waktuKembali);

    if (empty($jadwalRuang) && empty($jadwalPeminjaman)) {
        $queryiInsert = insertData($koneksi, 'peminjaman', $data);
        $now = new DateTime();
        $currentTimestamp = $now->format('Y-m-d H:i:s');

        $dataHistory = [
            $idHistory,
            $_SESSION['idUser'],
            'tambah',
            'peminjaman',
            $data[0],
            $currentTimestamp
        ];

        $insertHistory = insertData($koneksi, 'riwayatakun', $dataHistory);

        if ($insertHistory == true && $queryiInsert) {
            // Jika penyisipan berhasil
            echo '<script>alert("Data berhasil disimpan.");</script>';
            echo '<script>window.location.href = "index.php?page=pinjam-ruangan.php";</script>';
        }
        // $waktuinjam = date("Y-m-d H:i:s", strtotime($waktuPinjam));
        // $waktuembali = date("Y-m-d H:i:s", strtotime($waktuKembali));

        // // $hariPinjam = date('N', strtotime($waktuPinjam));
        // echo $whereConditionsPeminjaman;
    } else {
        // Menampilkan pesan jika waktu dan ruang tidak tersedia
        echo '<script>alert("Jadwal ruang tidak tersedia. Pilih waktu dan ruang lain.");</script>';
        echo '<script>window.location.href = "index.php?page=pinjam-ruangan.php";</script>';
    }
}
?>