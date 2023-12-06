<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Admin</title>
    <link rel="stylesheet" href="view/admin/css/admin.css">
    <link rel="stylesheet" href="view/admin/css/denah.css">
    <link rel="stylesheet" href="view/admin/css/jadwal.css">
    <link rel="stylesheet" href="view/admin/css/peminjaman.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;800&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <nav>
            <div class="sidebar">
                <div>
                    <img src="view/admin/img/LogoJTI.jpeg" alt="logo"
                        style="width: 54px; height: 57px; margin-left: 96px; margin-top: 38px;">
                </div>
                <ul class="nav-links">
                    <li class="beranda">
                        <a href="index.php?page=beranda.php">
                            <i class='bx bx-grid-alt'></i>
                            <span class="link_name">Beranda</span>
                        </a>
                    </li>
                    <li>
                        <div class="icon-link">
                            <a href="#" class="link_name_1 arrow">Manajemen Ruangan</a>
                            <i class='bx bxs-chevron-down arrow'></i>
                        </div>
                        <ul class="sub-menu">
                            <li>
                                <i class='bx bx-list-ul'></i>
                                <a href="index.php?page=kelola_ruang.php">Kelola Ruangan</a>
                            </li>
                            <li>
                                <i class='bx bx-calendar'></i>
                                <a href="index.php?page=jadwal_ruang.php">Jadwal Ruang</a>
                            </li>
                            <li>
                                <i class='bx bx-map-alt'></i>
                                <a href="index.php?page=denah_admin.php">Denah Ruang</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <div class="icon-link">
                            <a href="#" class="link_name_1 arrow">Manajemen Peminjaman</a>
                            <i class='bx bxs-chevron-down arrow'></i>
                        </div>
                        <ul class="sub-menu">
                            <!-- <li>
                                <i class='bx bxs-user'></i>
                                <a href="#">Pinjam Ruangan</a>
                            </li> -->
                            <li>
                                <i class='bx bx-book-bookmark'></i>
                                <a href="index.php?page=peminjaman.php">Antrean Peminjaman</a>
                            </li>
                            <li>
                                <i class='bx bx-book-bookmark'></i>
                                <a href="index.php?page=pengembalian.php">Antrean Pengembalian</a>
                            </li>
                            <li>
                                <i class='bx bx-history'></i>
                                <a href="index.php?page=riwayat.php">Riwayat</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <div class="icon-link">
                            <a href="#" class="link_name_1 arrow">Kelola Pengguna</a>
                            <i class='bx bxs-chevron-down arrow'></i>
                        </div>
                        <ul class="sub-menu">
                            <li>
                                <i class='bx bx-group'></i>
                                <a href="index.php?page=daftar_pengguna.php">Daftar Pengguna</a>
                            </li>
                            <li>
                                <i class='bx bx-exit'></i>
                                <a href="logout.php">Keluar</a>
                            </li>
                        </ul>
                    </li>
                </ul>
        </nav>
    <!-- </div> -->