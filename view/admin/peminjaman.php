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
                            Detail</a>
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
<div class="modal fade" id="editModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Persetujuan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../../function/tambah.php?user=tambah" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id" class="col-form-label">Nama :</label>
                        <input type="text" name="idUser" class="form-control" id="id">
                    </div>
                    <div class="mb-3">
                        <label for="id" class="col-form-label">Ruang ID :</label>
                        <input type="text" name="passUser" class="form-control" id="id">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="col-form-label">Nama Ruang :</label>
                        <input type="text" name="namaUser" class="form-control" id="nama">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="col-form-label">Deskripsi Ruang :</label>
                        <input type="text" name="namaUser" class="form-control" id="nama">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="col-form-label">Lantai :</label>
                        <input type="text" name="namaUser" class="form-control" id="nama">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-hidden="true"><i
                            class="bi bi-x-lg"></i>Disetujui</button>
                    <button type="submit" class="btn btn-danger" aria-hidden="true"><i
                            class="bi bi-floppy"></i>Ditolak</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>