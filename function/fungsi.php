<?php
function insertData($conn, $table, $data) {
    $values = "'" . implode("', '", $data) . "'";

    $sql = "INSERT INTO $table VALUES ($values)";
    $result = $conn->query($sql);

    if ($result === false) {
        // Handle error here if needed
        return false;
    }

    return $result;
}


function readData($conn, $mainTable, $columns = '', $conditions = array(), $whereCondition = "") {
    // Construct SQL query based on provided parameters
    if (empty($columns)) {
        $columnList = "*"; // Ambil semua kolom
    } else {
        $columnList = implode(", ", $columns);
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
    $result = $conn->query($sql);
    $data = array();

    // Fetch data if there are results
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    return $data;
}



function updateData($conn, $table, $id, $data) {

    $updateValues = "";
    foreach ($data as $key => $value) {
        $updateValues .= "$key = '$value', ";
    }
    $updateValues = rtrim($updateValues, ", ");

    $sql = "UPDATE $table SET $updateValues WHERE id=$id";
    $result = $conn->query($sql);

    $conn->close();

    return $result;
}

function deleteData($conn, $table, $columnIDName, $id) {

    $sql = "DELETE FROM $table WHERE $columnIDName=$id";
    $result = $conn->query($sql);

    $conn->close();

    return $result;
}

function cekJadwalRuang($koneksi, $ruangID, $waktuPinjam, $waktuKembali) {
    $hariPinjam = date('N', strtotime($waktuPinjam));
    $hariKembali = date('N', strtotime($waktuKembali));

    $selisihWaktu = strtotime($waktuKembali) - strtotime($waktuPinjam);
    $minggu = 60 * 60 * 24 * 7; // Detik dalam satu minggu

    $joinConditions = array(
        'sesi s' => "jadwalruang.SesiMulaiID = s.SesiID",
        'sesi p' => "jadwalruang.SesiAkhirID = p.SesiID"
    );

    if ($selisihWaktu > $minggu) {
        // Jika lebih dari 1 minggu, lakukan pengecekan selama 7 hari
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

    return readData($koneksi, "jadwalruang", '', $joinConditions, $whereConditionsJadwal);
}

function cekPeminjamanRuang($koneksi, $ruangID, $waktuPinjam, $waktuKembali) {
    $whereConditionsPeminjaman = "peminjaman.RuangID = '$ruangID' AND 
        (peminjaman.WaktuPinjam <= '$waktuKembali' AND peminjaman.WaktuKembali >= '$waktuPinjam')";

    return readData($koneksi, "peminjaman", '', '', $whereConditionsPeminjaman);
}


// Fungsi untuk mengatur cookie Remember Me
function setRememberMeCookie($userID, $token) {
    $cookieValue = $userID . ':' . $token;
    $cookieExpire = time() + (30 * 24 * 60 * 60); // Cookie berlaku selama 30 hari

    setcookie('remember_me', $cookieValue, $cookieExpire, '/');
}
?>

