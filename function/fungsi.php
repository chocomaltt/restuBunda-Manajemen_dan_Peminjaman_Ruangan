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

function cekJadwalPeminjamanRuang($koneksi, $ruangID, $pinjam, $kembali)
{
    $waktuPinjam = date("H:i:s", strtotime($pinjam));
    $waktuKembali = !empty($kembali) ? date("H:i:s", strtotime($kembali)) : null;

    $tanggalPinjam = date("Y-m-d H:i:s", strtotime($pinjam));
    $tanggalKembali = !empty($kembali) ? date("Y-m-d H:i:s", strtotime($kembali)) : null;
    
    $hariPinjam = date('N', strtotime($pinjam));
    $hariKembali = !empty($kembali) ? date('N', strtotime($kembali)) : null;

    $selisihWaktu = !empty($waktuKembali) ? strtotime($waktuKembali) - strtotime($waktuPinjam) : null;
    $minggu = 60 * 60 * 24 * 7; // Detik dalam satu minggu

    $joinConditions = array(
        'sesi s' => "jadwalruang.SesiMulaiID = s.SesiID",
        'sesi p' => "jadwalruang.SesiAkhirID = p.SesiID"
    );

    // Check for all rooms based on the provided time and day conditions
    if (empty($ruangID)) {
        $whereConditionsJadwal = "(jadwalruang.HariID >= $hariPinjam AND jadwalruang.HariID <= $hariKembali) AND 
            (s.WaktuMulai <= '$waktuKembali' AND p.WaktuSelesai >= '$waktuPinjam')";
        $whereConditionsPeminjaman = "(peminjaman.WaktuPinjam <= '$waktuKembali' AND peminjaman.WaktuKembali >= '$waktuPinjam') ";
    } else {
        // Jika lebih dari 1 minggu, lakukan pengecekan selama 7 hari
        if (!empty($selisihWaktu) && $selisihWaktu > $minggu) {
            $whereConditionsJadwal = "jadwalruang.RuangID = '$ruangID' AND 
                (jadwalruang.HariID >= $hariPinjam AND jadwalruang.HariID <= 7) AND 
                (s.WaktuMulai <= '$waktuKembali' AND p.WaktuSelesai >= '$waktuPinjam')";
        } else {
            // Jika tidak, lakukan pengecekan pada hari pinjam sampai hari kembali
            $whereConditionsJadwal = "jadwalruang.RuangID = '$ruangID' AND 
                ((jadwalruang.HariID >= $hariPinjam AND jadwalruang.HariID <= $hariKembali) OR 
                (jadwalruang.HariID >= 1 AND jadwalruang.HariID <= $hariKembali)) AND 
                (s.WaktuMulai <= '$waktuKembali' AND p.WaktuSelesai >= '$waktuPinjam')";
        }

        $whereConditionsPeminjaman = "peminjaman.RuangID = '$ruangID' AND 
            (peminjaman.WaktuPinjam <= '$tanggalKembali' AND peminjaman.WaktuKembali >= '$tanggalPinjam') ";
    }

    $jadwalRuang = readData($koneksi, "jadwalruang", '', $joinConditions, $whereConditionsJadwal);
    $peminjamanRuang = readData($koneksi, "peminjaman", '', '', $whereConditionsPeminjaman);

    return array('jadwalRuang' => $jadwalRuang, 'peminjamanRuang' => $peminjamanRuang);
}


// Fungsi untuk mengatur cookie Remember Me
function checkRoomAvailability($koneksi, $ruangID, $Mulai, $Akhir)
{
    $check = cekJadwalPeminjamanRuang($koneksi, $ruangID, $Mulai, $Akhir);

    // Check if there are any rows in the result set
    if (!empty($check)) {
        // Room is not available
        return false;
    } else {
        // Room is available
        return true;
    }
}
function setRememberMeCookie($userID, $token)
{
    $cookieValue = $userID . ':' . $token;
    $cookieExpire = time() + (30 * 24 * 60 * 60); // Cookie berlaku selama 30 hari

    setcookie('remember_me', $cookieValue, $cookieExpire, '/');
}


?>