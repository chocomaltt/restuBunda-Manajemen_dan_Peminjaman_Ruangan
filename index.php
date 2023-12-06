<?php

if(session_status() === PHP_SESSION_NONE)
    session_start();

if(!empty($_SESSION['level'])){
    require 'config/koneksi.php';
    require 'function/pesan_kilat.php';
    // require 'function/fungsi.php';
    if($_SESSION['level']==1){
        include 'view/admin/template/sidebar.php';
        if(!empty($_GET['page'])){
            include 'view/admin/' . $_GET['page'];
        } else {
            include 'view/admin/beranda.php';
        }
        include 'view/admin/template/footer.php';
    } else if ($_SESSION['level']==2||$_SESSION['level']==3){
        include 'view/user/template/header.php';
            if(!empty($_GET['page'])){
                include 'view/user/template/' . $_GET['page'];
            } else {
                include 'view/user/template/beranda.php';
            }
            include 'view/user/template/footer.php';
        }
    }else {
    header("Location: login.php");
}
?>
