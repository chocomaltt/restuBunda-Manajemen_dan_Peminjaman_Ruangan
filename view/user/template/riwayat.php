<div class="w-100 vh-100 position-relative" style="z-index: 0; margin-top: 59px; padding: 0 30px;">
    <p class="text-white fw-bold fs-2">RIWAYAT PEMINJAMAN</p>
    <!-- <div class="d-flex gap-2" style="align-items: center;">
            <div style="width: 30%;">
                <input type="search" name="" id="" placeholder="Pilih Ruang" style="border-radius: 3.125rem;outline: none;border: none;padding: 0.5rem 1rem;font-size: 0.8rem;width: 100%;">
            </div>
            <div style="width: 18%;">
                <input type="search" name="" id="" placeholder="Tentukan Tanggal" style="border-radius: 3.125rem;outline: none;border: none;padding: 0.5rem 1rem;font-size: 0.8rem;width: 100%;">
            </div>
            <button class="bg-biru text-white" style="border-radius: 1.25rem;padding: 0.4rem 1.5rem;border: none;">Cari</button>
        </div> -->
    <style>
        .table-striped-green {
            background-color: var(--warna-putih);
            border-radius: 5px;
        }

        .table-striped-green tbody tr td {
            padding: 0.9rem;
        }

        .table-striped-green tbody tr:nth-of-type(odd) {
            background-color: rgb(18, 119, 130, 0.5) !important;
        }
    </style>
    <table class="table-striped-green biru w-100" style="margin-top: 0.5rem;table-layout: auto;">
        <thead>
            <tr>
                <th class="tableHead">ID Ruang</th>
                <th class="tableHead">Nama Ruang</th>
                <th class="tableHead">Waktu Peminjaman</th>
                <th class="tableHead">Kepentingan</th>
                <th class="tableHead">Catatan Pengembalian</th>
                <th class="tableHead">Status Peminjaman</th>
                <th class="tableHead">Status Pengembalian</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $joinConditions = array(
                "ruang" => "peminjaman.RuangID = ruang.RuangID"
            );
            $searchConditions = "AkunID = '" . $_SESSION['idUser'] . "' AND peminjaman.StatusPengembalian = 'Disetujui' OR peminjaman.StatusPengembalian = 'Menunggu Konfirmasi'";
            $query = readData($koneksi, "peminjaman", '', $joinConditions, $searchConditions);
            if (!empty($query)) {
                foreach ($query as $row) {
                    ?>
                    <tr>
                        <td>
                            <?= $row['RuangID'] ?>
                        </td>
                        <td>
                            <?= $row['NamaRuang'] ?>
                        </td>
                        <td>
                            <?= $row['WaktuPinjam'] . " - " . $row['WaktuKembali']; ?>
                        </td>
                        <td>
                            <?= $row['Keperluan'] ?>
                        </td>
                        <td>
                            <?= $row['CatatanPengembalian'] ?>
                        </td>
                        <td>
                            <?= $row['StatusPeminjaman'] ?>
                        </td>
                        <td>
                            <?= $row['StatusPengembalian'] ?>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <td colspan="6">Tidak Ada Data Tersedia</td>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>