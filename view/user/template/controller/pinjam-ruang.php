<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tableName = "Peminjaman";
    $data = $_POST['data'];

    $ruangDipinjam = $data[2];
    $waktuPinjam = $data[3];
    $waktuKembali = $data[4];

    $jadwalRuang = cekJadwalPeminjamanRuang($koneksi, $ruangDipinjam, $waktuPinjam, $waktuKembali);

    if (empty($jadwalRuang)) {
        $queryiInsert = insertData($koneksi, 'peminjaman', $data);
        if ($queryiInsert) {
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