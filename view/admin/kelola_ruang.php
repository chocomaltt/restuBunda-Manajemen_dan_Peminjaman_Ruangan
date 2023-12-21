<head>
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<main class="container-fluid">

    <div class="table-responsive">
        <div class="tujupuluh">
            <h1>
                Kelola Ruangan
            </h1>
        </div>
        <div class="cari" style="display: flex; gap: 16px; align-items: center;">
        <form method="post" action="">
            <input class="search-box" name="keyword" type="text" placeholder="Cari Ruang">
            <button class="search-button" name="search">Cari</button>

        </form>
            <button type="button" class="tambah" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                <i class="bi bi-person-add"></i>Tambah</button>
        </div>
        <table class="table " style="table-layout: auto;">
            <thead>
                <tr>
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
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
                    $keyword = $_POST['keyword'];
                    $searchConditions = "(
                                    NamaRuang LIKE '%$keyword%' OR
                                    JenisRuang LIKE '%$keyword%'OR
                                    DeskripsiRuang LIKE '%$keyword%'OR
                                    Lantai LIKE '%$keyword%'
                                    )";

                                    $query = readData($koneksi, "ruang", '','', $searchConditions);


                } else {
                    // If the form is not submitted, fetch all data
                    $query = readData($koneksi, "ruang");
                }


                
                if (!empty($query)) {
                    foreach ($query as $row) {
                        ?>
                        <tr>
                            <td scope="row">
                            <?= $row['RuangID']; ?>
                            </td>
                            <td>
                                <?= $row['NamaRuang']; ?>
                            </td>
                            <!-- <td><?= $row['JenisRuang']; ?></td> -->
                            <td>
                                <?= $row['DeskripsiRuang']; ?>
                            </td>
                            <td>
                                <?= $row['Lantai']; ?>
                            </td>   
                            <td>
                                <a href="#" role="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editModal<?= $row['RuangID']; ?>" data-bs-whatever="@mdo">Edit</a>
                                <a href="index.php?page=controller/kelola_ruang.php&aksi=hapus&id=<?= $row['RuangID']; ?>"
                                    onclick="javascript:return confirm('Hapus Data Anggota ?');"
                                    class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i> Hapus</a>
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
    </div>

    </div>

</main>

<!-- TAMBAH RUANG -->
<div class="modal fade" id="exampleModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Form Ruangan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php?page=controller/kelola_ruang.php&aksi=tambah" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id" class="col-form-label">ID Ruang :</label>
                        <input type="text" name="data[]" class="form-control" id="id">
                    </div>
                    <div class="mb-3">
                        <label for="id" class="col-form-label">Nama Ruang :</label>
                        <input type="text" name="data[]" class="form-control" id="id" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="col-form-label">Jenis Ruang :</label>
                        <input type="text" name="data[]" class="form-control" id="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="col-form-label">Deskripsi :</label>
                        <input type="text" name="data[]" class="form-control" id="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="label" class="col-form-label">Lantai :</label>
                        <!-- <input type="text" name="jenisKelamin" class="form-control" id="label"> -->
                        <!-- <input type="file" class="form-control" id="kelamin" accept=".png, .jpg, .jpeg, .heif"> -->
                        <select name="data[]" id="label" class="form-select" required>
                            <option selected>Pilih Lantai</option>
                            <option value="5B">5B</option>
                            <option value="6T">6T</option>
                            <option value="7T">7T</option>
                            <option value="7B">7B</option>
                            <option value="8T">8T</option>
                            <option value="8B">8B</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="col-form-label">Kapasitas :</label>
                        <input type="text" name="data[]" class="form-control" id="nama" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning" data-bs-dismiss="modal" aria-hidden="true"><i
                            class="bi bi-x-lg"></i>Simpan</button>
                    <button type="submit" class="btn btn-danger" aria-hidden="true"><i
                            class="bi bi-floppy"></i>Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END TAMBAH RUANG -->

<!-- Edit Ruang -->
<?php
$no = 1;
$query = readData($koneksi, "ruang");
if (!empty($query)) {
    foreach ($query as $row) {
        ?>
        <div class="modal fade" id="editModal<?= $row['RuangID']; ?>" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel<?= $row['RuangID']; ?>">Edit Ruangan
                            <?= $row['NamaRuang']; ?>
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="index.php?page=controller/kelola_ruang.php&aksi=ubah" method="post">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="id" class="col-form-label">ID Ruang :</label>
                                <input type="text" name="data[]" class="form-control" id="id" value="<?= $row['RuangID']; ?>"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label for="id" class="col-form-label">Nama Ruang :</label>
                                <input type="text" name="data[]" class="form-control" id="id" value="<?= $row['NamaRuang']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="col-form-label">Jenis Ruang :</label>
                                <input type="text" name="data[]" class="form-control" id="nama"
                                    value="<?= $row['JenisRuang']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="col-form-label">Deskripsi :</label>
                                <input type="text" name="data[]" class="form-control" id="nama"
                                    value="<?= $row['DeskripsiRuang']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="label" class="col-form-label">Lantai :</label>
                                <!-- <input type="text" name="jenisKelamin" class="form-control" id="label"> -->
                                <!-- <input type="file" class="form-control" id="kelamin" accept=".png, .jpg, .jpeg, .heif"> -->
                                <select name="data[]" id="label" class="form-select">
                                    <option value="<?= $row['Lantai']; ?>" selected>
                                        <?= $row['Lantai']; ?>
                                    </option>
                                    <option value="5B">5B</option>
                                    <option value="6T">6T</option>
                                    <option value="7T">7T</option>
                                    <option value="7B">7B</option>
                                    <option value="8T">8T</option>
                                    <option value="8B">8B</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="col-form-label">Kapasitas :</label>
                                <input type="text" name="data[]" class="form-control" id="nama"
                                    value="<?= $row['Kapasitas']; ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning" data-bs-dismiss="modal" aria-hidden="true"><i
                                    class="bi bi-x-lg"></i>Ubah</button>
                            <button type="submit" class="btn btn-danger" aria-hidden="true"><i
                                    class="bi bi-floppy"></i>Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
}
?>
<!-- End Edit Ruang -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>