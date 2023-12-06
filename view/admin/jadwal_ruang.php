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
                        </tr>
                    </thead>
                </table>
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
                            <a href="index.php?page=anggota/edit&id=<?php echo $row['RuangID']; ?>"
                            class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                            <a href="fungsi/hapus.php?anggota=hapus&id=<?php echo $row['RuangID']; ?>" onclick="javascript:return confirm('Hapus Data Anggota ?');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i> Hapus</a>
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
        </main>

    </div>
    