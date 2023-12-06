            <div class="content" style="display: flex; gap: 8px; flex-direction: column;">
                <div class="tujupuluh">
                    <h1>
                        Daftar Pengguna
                    </h1>
                </div>
                <div class="cari" style="display: flex; gap: 16px; align-items: center;">
                    <input class="search-box" type="text" placeholder=" Cari Pengguna">
                    <button class="search-button">Cari</button>
                    <button class="tambah">Tambah</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>ID Pengguna</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
                <tbody>
                <?php
                        $no = 1;
                        $joinConditions = array(
                            "level" => "akun.LevelID = level.LevelID",
                            "kelas" => "akun.KelasID = kelas.KelasID"
                        );
                        
                        $query = readData($koneksi, "akun", '', $joinConditions);
                        
                        if(!empty($query)) {
                            foreach ($query as $row){
                    ?>
                    <tr>
                        <th scope="row"><?= $no++; ?></th>
                        <td><?= $row['AkunID']; ?></td>
                        <td><?= $row['Username']; ?></td>
                        <td><?= $row['Nama']; ?></td>
                        <td><?= $row['NamaKelas'] ?></td>
                        <td><?= $row['Keterangan']; ?></td>
                        <td>
                            <a href="index.php?page=anggota/edit&id=<?php echo $row['AkunID']; ?>"
                            class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                            <a href="fungsi/hapus.php?anggota=hapus&id=<?php echo $row['AkunID']; ?>" onclick="javascript:return confirm('Hapus Data Anggota ?');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i> Hapus</a>
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
    