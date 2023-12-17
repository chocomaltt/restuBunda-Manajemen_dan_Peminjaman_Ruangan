<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<div class="content" style="display: flex; gap: 8px; flex-direction: column;">
    <div class="tujupuluh">
        <h1>
            Jadwal Ruang
        </h1>
    </div>
    <div class="cari" style="display: flex; gap: 16px; align-items: center;">
        <input class="search-box" type="text" placeholder=" Pilih Kelas atau Ruang" style="width: 296px;">
        <input class="search-box pe-2" type="date" placeholder=" Tentukan Tanggal" style="width: 168px;">
        <button class="search-button">Cari</button>
        <!-- <button class="tambah">Tambah</button> -->
        <button type="button" class="tambah" data-bs-toggle="modal" data-bs-target="#exampleModal"
            data-bs-whatever="@mdo">
            <i class="bi bi-person-add"></i>Tambah</button>
    </div>
    <table class="table" style="table-layout: auto;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Ruang</th>
                <th>Hari</th>
                <th>Kelas</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Mata Kuliah</th>
                <th>Dosen Pengajar</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php
                $no = 1;
                $joinConditions = array(
                    "ruang" => "jadwalruang.RuangID = ruang.RuangID",
                    "hari" => "jadwalruang.HariID = hari.HariID",
                    "kelas" => "jadwalruang.KelasID = kelas.KelasID",
                    "sesi" => "jadwalruang.SesiMulaiID OR jadwalruang.SesiAkhirID = sesi.SesiID",
                    "matakuliah" => "jadwalruang.MataKuliahID = matakuliah.MataKuliahID",
                    "akun" => "jadwalruang.AkunID = akun.AkunID",
                );
                $query = readData($koneksi, "jadwalruang",'',$joinConditions);
                if(!empty($query)) {
                    foreach ($query as $row){
            ?>
            <tr>
                <th scope=" row"><?= $no++; ?></th>
                <td><?= $row['NamaRuang']; ?></td>
                <td><?= $row['NamaHari']; ?></td>
                <td><?= $row['NamaKelas']; ?></td>
                <td><?= $row['WaktuMulai']; ?></td>
                <td><?= $row['WaktuSelesai']; ?></td>
                <td><?= $row['NamaMataKuliah']; ?></td>
                <td><?= $row['Nama']; ?></td>
                <td>
                    <a role="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal"
                        data-bs-whatever="@mdo">Edit</a>
                    <a role="button" href=" fungsi/hapus.php?anggota=hapus&id=<?php echo $row['JadwalRuangID']; ?>"
                        onclick="javascript:return confirm('Hapus Data Anggota ?');" class="btn btn-danger btn-xs">
                        <i class="fa fa-trash-o" aria-hidden="true">
                        </i> Hapus
                    </a>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Form Tambah Jadwal</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../../function/tambah.php?user=tambah" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id" class="col-form-label">Nama Ruang :</label>
                        <input type="text" name="idUser" class="form-control" id="id">
                    </div>
                    <div class="mb-3">
                        <label for="id" class="col-form-label">Hari :</label>
                        <input type="text" name="passUser" class="form-control" id="id">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="col-form-label">Kelas :</label>
                        <input type="text" name="namaUser" class="form-control" id="nama">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="col-form-label">Waktu Mulai :</label>
                        <input type="text" name="namaUser" class="form-control" id="nama">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="col-form-label">Waktu Selesai :</label>
                        <input type="text" name="namaUser" class="form-control" id="nama">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="col-form-label">Mata Kuliah :</label>
                        <input type="text" name="namaUser" class="form-control" id="nama">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="col-form-label">Dosen Pengajar :</label>
                        <input type="text" name="namaUser" class="form-control" id="nama">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-hidden="true"><i
                            class="bi bi-x-lg"></i>Simpan</button>
                    <button type="submit" class="btn btn-secondary" aria-hidden="true"><i
                            class="bi bi-floppy"></i>Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Jadwal</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../../function/tambah.php?user=tambah" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id" class="col-form-label">Nama Ruang :</label>
                        <input type="text" name="idUser" class="form-control" id="id">
                    </div>
                    <div class="mb-3">
                        <label for="id" class="col-form-label">Hari :</label>
                        <input type="text" name="passUser" class="form-control" id="id">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="col-form-label">Kelas :</label>
                        <input type="text" name="namaUser" class="form-control" id="nama">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="col-form-label">Waktu Mulai :</label>
                        <input type="text" name="namaUser" class="form-control" id="nama">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="col-form-label">Waktu Selesai :</label>
                        <input type="text" name="namaUser" class="form-control" id="nama">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="col-form-label">Mata Kuliah :</label>
                        <input type="text" name="namaUser" class="form-control" id="nama">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="col-form-label">Dosen Pengajar :</label>
                        <input type="text" name="namaUser" class="form-control" id="nama">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-hidden="true"><i
                            class="bi bi-x-lg"></i>Ubah</button>
                    <!-- <button type="submit" class="btn btn-danger" aria-hidden="true"><i
                            class="bi bi-floppy"></i>Hapus</button> -->
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>