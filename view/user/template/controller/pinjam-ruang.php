<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tableName = "Peminjaman";
    $data = $_POST['data'];

    $ruangDipinjam = $data[2];
    $waktuPinjam = date("H:i:s", strtotime($data[3]));
    $waktuKembali = date("H:i:s", strtotime($data[4]));

    $jadwalRuang = cekJadwalRuang($koneksi, $ruangDipinjam, $waktuPinjam, $waktuKembali);
    $peminjamanRuang = cekPeminjamanRuang($koneksi, $ruangDipinjam, $waktuPinjam, $waktuKembali);

    if (empty($jadwalRuang) && empty($peminjamanRuang)) {
        $queryiInsert = insertData($koneksi, 'peminjaman', $data);
        if ($queryiInsert) {
            // Jika penyisipan berhasil
            echo '<script>alert("Data berhasil disimpan.");</script>';
            echo '<script>window.location.href = "index.php?page=pinjam-ruangan.php";</script>';
        }
    } else {
        // Menampilkan pesan jika waktu dan ruang tidak tersedia
        echo '<script>alert("Jadwal ruang tidak tersedia. Pilih waktu dan ruang lain.");</script>';
        echo '<script>window.location.href = "index.php?page=pinjam-ruangan.php";</script>';
    }
}
?>