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
    <div class="content" style="display: flex; gap: 8px; flex-direction: column;">
        <div class="tujupuluh">
            <h1>
                Jadwal Ruang
            </h1>
        </div>
        <div class="cari" style="display: flex; gap: 16px; align-items: center;">
            <input class="search-box" type="text" placeholder=" Pilih Kelas atau Ruang" style="width: 296px;">
            <input class="search-box" type="number" placeholder=" Tentukan Tanggal" style="width: 168px;">
            <button class="search-button">Cari</button>
            <button class="tambah">Tambah</button>
        </div>
        <table>
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
                            "sesi" => "jadwalruang.SesiID = sesi.SesiID",
                            "matakuliah" => "jadwalruang.MataKuliahID = matakuliah.MataKuliahID",
                            "akun" => "jadwalruang.AkunID = akun.AkunID",
                        );
                        $query = readData($koneksi, "jadwalruang",'',$joinConditions);
                        if(!empty($query)) {
                            foreach ($query as $row){
                    ?>
                <tr>
                    <th scope="row"><?= $no++; ?></th>
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
            <!-- </div>  -->
    </div>
    </table>
</main>

</div>