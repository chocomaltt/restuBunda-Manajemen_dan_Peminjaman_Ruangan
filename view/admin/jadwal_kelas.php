<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<div class="content" style="display: flex; gap: 8px; flex-direction: column;">
    <div class="tujupuluh">
        <h1>
            Jadwal Kelas
        </h1>
    </div>
    <div class="cari" style="display: flex; gap: 16px; align-items: center;">
        <input class="search-box" type="text" placeholder=" Pilih Kelas atau Ruang" style="width: 296px;">
        <input class="search-box" type="number" placeholder=" Tentukan Tanggal" style="width: 168px;">
        <button class="search-button">Cari</button>
        <button class="tambah">Tambah</button>
    </div>
    <table class="table" style="table-layout: auto;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Ruang</th>
                <th>Hari</th>
                <th>Sesi ke-</th>
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
                <td><?= $row['JudulSesi']; ?></td>
                <td><?= $row['WaktuMulai']; ?></td>
                <td><?= $row['WaktuSelesai']; ?></td>
                <td><?= $row['NamaMataKuliah']; ?></td>
                <td><?= $row['Nama']; ?></td>
                <td>
                    <button class="btn btn-warning btn-xs" onclick="editData(<?= $row['RuangID']; ?>)">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                    </button>
                    <button class="btn btn-danger btn-xs" onclick="hapusData(<?= $row['RuangID']; ?>)"
                        data-confirm="Hapus Data Anggota ?">
                        <i class="fa fa-trash-o" aria-hidden="true"></i> Hapus
                    </button>
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

</div>