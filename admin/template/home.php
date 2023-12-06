<html>
    <head>
        <!-- <link rel="stylesheet" href="../../assets/css/custom_color.css"> -->
        <?php
           
        ?>
    </head>
    <body class="container-fluid bg-user-default m-0 p-0" >
        <div class="d-flex vw-100 vh-100">
            <div class="w-25 h-100 m-0 p-0">
                <?php
                    include "sidebar.php";
                ?>
            </div>
            <?php
            if(!empty($_GET['page'])){
                include $_GET['page'] . '.php';
            } else {
                include 'beranda.php';
            }
            include 'footer.php';
            ?>
            <div class="d-flex flex-column w-100 h-100">
                <?php
                    include "header.php";

                    // $content = $_GET['content'] ?? '';

                    // include "beranda.php";
                    // include "daftar-ruang.php";
                    // include "jadwal-ruang.php";
                    // include "denah-ruang.php";
                    // include "antrean-pinjam.php";
                    // include "pengembalian.php";
                    // include "riwayat.php"
                    // include "pinjam-ruangan.php";
                ?>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                activateMenu();
            });
        </script>
    </body>
</html>