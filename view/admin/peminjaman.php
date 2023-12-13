<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<main>

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