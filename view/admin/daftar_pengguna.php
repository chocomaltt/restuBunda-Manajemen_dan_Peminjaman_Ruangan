<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<main class="d-flex flex-column">

    <div class="container-fluid">
        <div class="tujupuluh">
            <h1>
                Daftar Pengguna
            </h1>
        </div>
        <div class="cari" style="display: flex; gap: 16px; align-items: center;">
            <form method="post" action="">
                <input class="search-box" type="text" name="keyword" placeholder=" Cari Pengguna">
                <button class="search-button" name="search">Cari</button>
                <!-- <button class="tambah">Tambah</button> -->
                <button type="button" class="tambah" data-bs-toggle="modal" data-bs-target="#exampleModal"
                    data-bs-whatever="@mdo">
                    <i class="bi bi-person-add"></i>Tambah
                </button>
            </form>
        </div>
        <table class="table" style="table-layout: auto;">
            <thead>
                <tr>
                    <th>ID Pengguna</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $joinConditions = array(
                    "level" => "akun.LevelID = level.LevelID",
                    "kelas" => "akun.KelasID = kelas.KelasID"
                );
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
                    $keyword = $_POST['keyword'];
                    $searchConditions = "(
                                    akun.Nama LIKE '%$keyword%' OR
                                    akun.UserName LIKE '%$keyword%'
                                    )";

                    $query = readData($koneksi, "akun", '', $joinConditions, $searchConditions);


                } else {
                    // If the form is not submitted, fetch all data
                    $query = readData($koneksi, "akun", '', $joinConditions);
                }

                if (!empty($query)) {
                    foreach ($query as $row) {
                        ?>
                        <tr>
                            <!-- <th scope="row"><?= $no++; ?></th> -->
                            <td>
                                <?= $row['AkunID']; ?>
                            </td>
                            <!-- <td><?= $row['Username']; ?></td> -->
                            <td>
                                <?= $row['Nama']; ?>
                            </td>
                            <td>
                                <?= $row['NamaKelas'] ?>
                            </td>
                            <td>
                                <?= $row['Keterangan']; ?>
                            </td>
                            <td>
                                <!-- <a href="index.php?page=anggota/edit&id=<?php echo $row['AkunID']; ?>"
                            class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Edit</a> -->
                                <a role="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editModal<?= $row['AkunID']; ?>" data-bs-whatever="@mdo">Edit</a>
                                <a href="fungsi/hapus.php?anggota=hapus&id=<?php echo $row['AkunID']; ?>"
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
</main>
<div class="modal fade" id="exampleModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pengguna</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php?page=controller/daftar_pengguna.php&aksi=tambah" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id" class="col-form-label">Nama Pengguna :</label>
                        <input type="hidden" name="data[]" class="form-control" value="">
                        <input type="text" name="data[]" class="form-control" id="id" required>
                    </div>
                    <div class="mb-3">
                        <label for="id" class="col-form-label">Level :</label>
                        <!-- <input type="text" name="passUser" class="form-control" id="id"> -->
                        <select name="data[]" class="form-select" aria-label="Default select example" required>
                            <option selected>Pilih Level</option>
                            <?php
                            $query2 = readData($koneksi, "Level");
                            foreach ($query2 as $row2) {
                                ?>
                                <option value="<?= $row2['LevelID']; ?>">
                                    <?= $row2['Keterangan']; ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class=" mb-3">
                        <label for="id" class="col-form-label">Kelas :</label>
                        <select name="data[]" class="form-select" aria-label="Default select example" required>
                            <option selected>Pilih Kelas</option>
                            <?php
                            $query3 = readData($koneksi, "Kelas");
                            foreach ($query3 as $row3) {
                                ?>
                                <option value="<?= $row3['KelasID']; ?>">
                                    <?= $row3['NamaKelas']; ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class=" mb-3">
                        <label for="id" class="col-form-label">Username :</label>
                        <input type="text" name="data[]" class="form-control" id="id">
                    </div>
                    <div class=" mb-3">
                        <label for="id" class="col-form-label">Password :</label>
                        <input type="password" name="password" class="form-control" id="id">
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


<?php
$no = 1;
$joinConditions = array(
    "kelas" => "kelas.KelasID = akun.KelasID",
    "level" => "level.LevelID = akun.LevelID"
);
$query = readData($koneksi, "akun", '', $joinConditions);
if (!empty($query)) {
    foreach ($query as $row) {
        ?>
        <div class="modal fade" id="editModal<?= $row['AkunID']; ?>" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel<?= $row['AkunID']; ?>">Edit Ruangan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="index.php?page=controller/daftar_pengguna.php&aksi=ubah" method="post">
                        <div class="modal-body">
                            <div class="mb-3">
                                <input type="hidden" name="data[]" class="form-control" id="id" value="<?= $row['AkunID']; ?>">
                                <label for="id" class="col-form-label">Nama Pengguna :</label>
                                <input type="text" name="data[]" class="form-control" id="id" value="<?= $row['Nama']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="id" class="col-form-label">Level :</label>
                                <!-- <input type="text" name="passUser" class="form-control" id="id"> -->
                                <select name="data[]" class="form-select" aria-label="Default select example" required>
                                    <option value="<?= $row['LevelID']; ?>" selected>
                                        <?= $row['Keterangan']; ?>
                                    </option>
                                    <?php
                                    $query2 = readData($koneksi, "Level");
                                    foreach ($query2 as $row2) {
                                        ?>
                                        <option value="<?= $row2['LevelID']; ?>">
                                            <?= $row2['Keterangan']; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class=" mb-3">
                                <label for="id" class="col-form-label">Kelas :</label>
                                <select name="data[]" class="form-select" aria-label="Default select example" required>
                                    <option selected>Pilih Kelas</option>
                                    <option value="<?= $row['KelasID']; ?>" selected>
                                        <?= $row['NamaKelas']; ?>
                                    </option>
                                    <?php
                                    $query3 = readData($koneksi, "Kelas");
                                    foreach ($query3 as $row3) {
                                        ?>
                                        <option value="<?= $row3['KelasID']; ?>">
                                            <?= $row3['NamaKelas']; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="id" class="col-form-label">Username :</label>
                                <input type="text" name="data[]" class="form-control" id="id" value="<?= $row['Username']; ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-hidden="true"><i
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>