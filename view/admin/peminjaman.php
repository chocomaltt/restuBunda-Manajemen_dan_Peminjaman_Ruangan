<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<main>
    <!-- <header>
        <a href="">
            <svg xmlns="http://www.w3.org/2000/svg" width="39.403" height="40" viewBox="0 0 24 24" style="fill: #fff;">
                <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"></path>
            </svg>
        </a>
        <a href="">
            <svg xmlns="http://www.w3.org/2000/svg" width="39.403" height="40" viewBox="0 0 24 24" style="fill: #fff;">
                <path
                    d="M12 2a5 5 0 1 0 5 5 5 5 0 0 0-5-5zm0 8a3 3 0 1 1 3-3 3 3 0 0 1-3 3zm9 11v-1a7 7 0 0 0-7-7h-4a7 7 0 0 0-7 7v1h2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1z">
                </path>
            </svg>
        </a>

    </header> -->
    <div class="table-responsive">
        <div class="tujupuluh">
            <h1>
                Antrean Peminjaman
            </h1>
        </div>
        <table class="table" style="table-layout: auto;">
            <thead>
                <tr>
                    <th>Nama Peminjam</th>
                    <th>ID Ruang</th>
                    <th>Nama Ruang</th>
                    <th>Deskripsi</th>
                    <th>Lantai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $joinConditions = array(
                    "ruang" => "peminjaman.RuangID = ruang.RuangID",
                    "akun" => "peminjaman.AkunID = akun.AkunID"
                );
                $query = readData($koneksi, "peminjaman", '', $joinConditions, 'peminjaman.StatusPeminjaman = "Menunggu Konfirmasi"');
                if (!empty($query)) {
                    foreach ($query as $row) {
                        ?>
                        <tr>
                            <td>
                                <?= $row['Nama']; ?>
                            </td>
                            <td>
                                <?= $row['RuangID']; ?>
                            </td>
                            <td>
                                <?= $row['NamaRuang']; ?>
                            </td>
                            <td>
                                <?= $row['DeskripsiRuang']; ?>
                            </td>
                            <td>
                                <?= $row['Lantai']; ?>
                            </td>
                            <td>
                                <a href="index.php?page=anggota/edit&id=<?php echo $row['RuangID']; ?>"
                                class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                Edit</a>
                            </td>
                            <?php
                    }
                } else {
                    ?>
                        <td colspan="4">Tidak Ada Data Tersedia</td>
                        <?php
                }
                ?>
                </tr>
            </tbody>
        </table>
        <!-- </div>  -->
    </div>
</main>

</div>