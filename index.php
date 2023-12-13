<?php
if(session_status() === PHP_SESSION_NONE)
    session_start();
if(!empty($_SESSION['level'])){
    require 'config/koneksi.php';
    require 'function/pesan_kilat.php';
    // require 'function/fungsi.php';
    if($_SESSION['level']==1){
        include 'view/admin/template/sidebar.php';
        include 'view/admin/template/header.php';
        if(!empty($_GET['page'])){
            include 'view/admin/' . $_GET['page'];
        } else {
            include 'view/admin/beranda.php';
        }
        include 'view/admin/template/footer.php';
    } else if ($_SESSION['level']==2||$_SESSION['level']==3){
        ?>

<body class="container-fluid bg-user-default m-0 p-0">
    <div class="d-flex vw-100 vh-100">
        <div class="w-25 h-100 m-0 p-0">
            <?php
                            include 'view/user/template/sidebar.php';
                            ?>
        </div>
        <div class="d-flex flex-column w-100 h-100">
            <?php
                            include "view/user/template/header.php";
                            if(!empty($_GET['page'])){
                                include 'view/user/template/' . $_GET['page'];
                            } else {
                                include 'view/user/template/beranda.php';
                            }
                            include 'view/user/template/footer.php';
                        ?>
        </div>
    </div>
</body>
<?php
    }
    }else {
    header("Location: login.php");
}
?>