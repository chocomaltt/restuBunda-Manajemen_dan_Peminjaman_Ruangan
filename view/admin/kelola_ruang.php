            <div class="content" style="display: flex; gap: 8px; flex-direction: column;">
                <div class="tujupuluh">
                    <h1>
                        Kelola Ruangan
                    </h1>
                </div>
                <div class="cari" style="display: flex; gap: 16px; align-items: center;">
                    <input class="search-box" type="text" placeholder=" Pilih ID Ruang">
                    <button class="search-button">Cari</button>
                    <button class="tambah">Tambah</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Ruang</th>
                            <th>Deskripsi</th>
                            <th>Lantai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
                <tbody>
                    <?php
                        $no = 1;
                        $query = readData($koneksi, "ruang");
                        if(!empty($query)) {
                            foreach ($query as $row){
                    ?>
                    <tr>
                        <th scope="row"><?= $no++; ?></th>
                        <td><?= $row['NamaRuang']; ?></td>
                        <td><?= $row['JenisRuang']; ?></td>
                        <td><?= $row['DeskripsiRuang']; ?></td>
                        <td><?= $row['Lantai']; ?></td>
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
            </div>
        </main>

    </div>
    