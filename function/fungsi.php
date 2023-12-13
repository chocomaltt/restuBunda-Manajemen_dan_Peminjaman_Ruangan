<?php
function insertData($conn, $table, $data) {

    $columns = implode(", ", array_keys($data));
    $values = "'" . implode("', '", $data) . "'";

    $sql = "INSERT INTO $table ($columns) VALUES ($values)";
    $result = $conn->query($sql);

    $conn->close();

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


// Fungsi untuk mengatur cookie Remember Me
function setRememberMeCookie($userID, $token) {
    $cookieValue = $userID . ':' . $token;
    $cookieExpire = time() + (30 * 24 * 60 * 60); // Cookie berlaku selama 30 hari

    setcookie('remember_me', $cookieValue, $cookieExpire, '/');
}
?>