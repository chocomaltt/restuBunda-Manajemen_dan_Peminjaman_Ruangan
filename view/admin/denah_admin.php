<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<main>

    <div class="content" style="display: flex; gap: 8px; flex-direction: column;">
        <div class="denahrow">
            <h1>
                Denah Ruang
            </h1>
            <!-- <button class="tambah" style="float: right;">Tambah</button> -->
        </div>
        <div class="denahruang" style="display: flex; flex-wrap: wrap; gap: 40px; width: 100%;">
            <?php
            $no = 1;
            $query = readData($koneksi, "denah");
            if (!empty($query)) {
                foreach ($query as $row) {
            ?>
                    <div class="denah">
                        <img src="view/admin/img/<?= $row['File']; ?>" alt="" style="width: 540px; height: 363px; border-radius: 20px;">
                        <div class="lt">
                            Denah Ruang Lantai
                            <?= $row['DeskripsiLantai']; ?>
                            <a role="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModalDenah<?= $row['DenahID']; ?>" data-bs-whatever="@mdo">Detail</a>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
</main>

<?php
$no = 1;
$query = readData($koneksi, "denah");
if (!empty($query)) {
    foreach ($query as $row) {
?>
        <div class="modal fade" id="editModalDenah<?= $row['DenahID']; ?>" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel<?= $row['DenahID']; ?>">Edit Denah</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="index.php?page=controller/denah_admin.php&aksi=ubah" method="post" enctype="multipart/form-data">>
                        <div class="modal-body">
                            <input type="hidden" name="data[]" class="form-control" id="id" value="<?= $row['DenahID']; ?>">
                            <div class="mb-3">
                                <label for="id" class="col-form-label">Upload Denah :</label>
                                <input type="file" name="file" class="form-control" id="id" accept=".png, .jpg, .jpeg, .svg, .heic">
                            </div>
                            <div class="mb-3">
                                <label for="id" class="col-form-label">Deskripsi Lantai :</label>
                                <input type="text" name="data[]" class="form-control" id="id" value="<?= $row['DeskripsiLantai']; ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning" data-bs-dismiss="modal" aria-hidden="true"><i class="bi bi-x-lg"></i>Ubah</button>
                            <button type="reset" class="btn btn-secondary" aria-hidden="true"><i class="bi bi-floppy"></i>Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php }
} ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>