<?php
function insertData($koneksi, $table, $data)
{
    $values = "'" . implode("', '", $data) . "'";

    $sql = "INSERT INTO $table VALUES ($values)";
    $result = $koneksi->query($sql);

    if ($result === false) {
        // Handle error here if needed
        return false;
    }

    return $result;
}


function readData($koneksi, $mainTable, $columns = '', $conditions = array(), $whereCondition = "")
{
    // Construct SQL query based on provided parameters
    if (empty($columns)) {
        $columnList = "*"; // Ambil semua kolom
    } else {
        $columnList = $columns;
    }

    $sql = "SELECT $columnList FROM $mainTable";

    // Add JOIN conditions if provided
    if (!empty($conditions)) {
        foreach ($conditions as $joinTable => $joinCondition) {
            if (!empty($joinTable) && !empty($joinCondition)) {
                $sql .= " JOIN $joinTable ON $joinCondition";
            }
        }
    }

    // Add WHERE condition if provided
    if (!empty($whereCondition)) {
        $sql .= " WHERE $whereCondition";
    }

    // Perform query
    $result = $koneksi->query($sql);
    $data = array();

    // Fetch data if there are results
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    return $data;
}





function updateData($koneksi, $table, $namaId, $id, $data)
{

    $updateValues = "";
    foreach ($data as $key => $value) {
        $updateValues .= "$key = '$value', ";
    }
    $updateValues = rtrim($updateValues, ", ");

    $sql = "UPDATE $table SET $updateValues WHERE $namaId=$id";
    $result = $koneksi->query($sql);

    $koneksi->close();

    return $result;
}

function deleteData($koneksi, $table, $columnIDName, $id)
{

    $sql = "DELETE FROM $table WHERE $columnIDName=$id";
    $result = $koneksi->query($sql);

    $koneksi->close();

    return $result;
}

function cekJadwalRuang($koneksi, $ruangID, $Pinjam, $Kembali) {
    $hariPinjam = date('N', strtotime($Pinjam));
    $hariKembali = date('N', strtotime($Kembali));

    $waktuPinjam = date('H:i:s', strtotime($Pinjam));
    $waktuKembali = date('H:i:s', strtotime($Kembali));

    $selisihWaktu = strtotime($waktuKembali) - strtotime($waktuPinjam);
    $minggu = 60 * 60 * 24 * 7; // Detik dalam satu minggu

    $joinConditions = array(
        'sesi s' => "jadwalruang.SesiMulaiID = s.SesiID",
        'sesi p' => "jadwalruang.SesiAkhirID = p.SesiID"
    );

    if ($selisihWaktu > $minggu) {
        // Jika lebih dari 1 minggu, lakukan pengecekan selama 7 hari
        $whereConditionsJadwal = "jadwalruang.RuangID = '$ruangID' AND 
            (jadwalruang.HariID >= $hariPinjam AND jadwalruang.HariID <= $hariKembali) AND 
            (s.WaktuMulai <= '$waktuKembali' AND p.WaktuSelesai >= '$waktuPinjam')";
    } else {
        // Jika tidak, lakukan pengecekan pada hari pinjam sampai hari kembali
        $whereConditionsJadwal = "jadwalruang.RuangID = '$ruangID' AND 
            ((jadwalruang.HariID >= $hariPinjam AND jadwalruang.HariID <= $hariKembali) OR 
            (jadwalruang.HariID >= $hariPinjam AND jadwalruang.HariID <= $hariKembali)) AND 
            (s.WaktuMulai <= '$waktuKembali' AND p.WaktuSelesai >= '$waktuPinjam')";
    }

    return readData($koneksi, "jadwalruang", '', $joinConditions, $whereConditionsJadwal);
}

function cekPeminjamanRuang($koneksi, $ruangID, $Pinjam, $Kembali) {
    $waktuPinjam = date('Y-m-d H:i:s', strtotime($Pinjam));
    $waktuKembali = date('Y-m-d H:i:s', strtotime($Kembali));

    // SELECT *
    // FROM `peminjaman`
    // WHERE
    //     RuangID = '0' AND
    //     (
    //         (WaktuPinjam >= '2023-12-17 06:00:00' AND WaktuKembali <= '2023-12-19 06:00:00') OR
    //         (WaktuPinjam <= '2023-12-19 06:00:00' AND WaktuKembali >= '2023-12-17 06:00:00')
    //     );

    $whereConditionsPeminjaman = "RuangID = '$ruangID' AND
        (
            (WaktuPinjam >= '$waktuPinjam' AND WaktuKembali <= '$waktuKembali') OR
            (WaktuPinjam <= '$waktuKembali' AND WaktuKembali >= '$waktuPinjam')
        ) AND
        (StatusPeminjaman <> 'Dibatalkan' AND StatusPeminjaman <> 'Menunggu Konfirmasi')";

    return readData($koneksi, "peminjaman", '', '', $whereConditionsPeminjaman);
}
// Fungsi untuk mengatur cookie Remember Me
function checkRoomAvailability($koneksi, $ruangID, $Mulai, $Akhir)
{
    $checkJadwal = cekJadwalRuang($koneksi, $ruangID, $Mulai, $Akhir);
    $checkPeminjaman = cekPeminjamanRuang($koneksi, $ruangID, $Mulai, $Akhir);

    // Check if there are any rows in the result set
    if (!empty($checkJadwal) || !empty($checkPeminjaman)) {
        // Room is not available
        return false;
    } else {
        // Room is available
        return true;
    }
}

function generateSecureToken($length = 32) {
    // Generate a random string using secure means
    $token = bin2hex(random_bytes($length));

    return $token;
}


?>