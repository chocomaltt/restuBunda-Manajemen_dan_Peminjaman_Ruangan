<?php
require "function/fungsi.php";
date_default_timezone_set("Asia/Jakarta");
$koneksi = mysqli_connect("localhost", "root","" ,"pinjamruang");
// addNewAccount($koneksi, '1', '1', 'Admin', 'Admin', 'Admin 1');
if(mysqli_connect_errno()){
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>