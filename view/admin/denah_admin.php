<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
            <div class="denah">
                <img src="view/admin/img/denah gedung TI 5-6-7-8_page-0001.jpg" alt=""
                    style="width: 540px; height: 363px; border-radius: 20px;">
                <div class="lt">
                    Denah Ruang Lantai 5
                    <a role="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModalDenah"
                        data-bs-whatever="@mdo">Detail</a>
                </div>
            </div>
            <div class="denah">
                <img src="view/admin/img/denah gedung TI 5-6-7-8_page-0002.jpg" alt=""
                    style="width: 540px; height: 363px; border-radius: 20px;">
                <div class="lt">
                    Denah Ruang Lantai 6
                    <a role="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModalDenah"
                        data-bs-whatever="@mdo">Detail</a>
                </div>
            </div>
            <div class="denah">
                <img src="view/admin/img/denah gedung TI 5-6-7-8_page-0003.jpg" alt=""
                    style="width: 540px; height: 363px; border-radius: 20px;">
                <div class="lt">
                    Denah Ruang Lantai 7
                    <a role="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModalDenah"
                        data-bs-whatever="@mdo">Detail</a>
                </div>
            </div>
            <div class="denah">
                <img src="view/admin/img/denah gedung TI 5-6-7-8_page-0004.jpg" alt=""
                    style="width: 540px; height: 363px; border-radius: 20px;">
                <div class="lt">
                    Denah Ruang Lantai 8
                    <a role="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModalDenah"
                        data-bs-whatever="@mdo">Detail</a>
                </div>
            </div>
        </div>
</main>
<div class="modal fade" id="editModalDenah" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Denah</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../../function/tambah.php?user=tambah" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id" class="col-form-label">Upload Denah :</label>
                        <input type="file" name="idUser" class="form-control" id="id"
                            accept=".png, .jpg, .jpeg, .svg, .heic">
                    </div>
                    <div class="mb-3">
                        <label for="id" class="col-form-label">Deskripsi :</label>
                        <input type="text" name="passUser" class="form-control" id="id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-hidden="true"><i
                            class="bi bi-x-lg"></i>Ubah</button>
                    <button type="submit" class="btn btn-secondary" aria-hidden="true"><i
                            class="bi bi-floppy"></i>Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>