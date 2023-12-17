    <div class="w-75 position-relative" style="z-index: 0; margin-top: 59px; padding: 0 30px;">
        <p class="text-white fw-bold fs-2">ANTREAN PEMINJAMAN</p>
</div>
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
<div class="w-100 position-relative mt-2" style="z-index: 0;padding: 0 30px;">
        <div class="table-responsive">
            <table class="table-striped-green biru w-100" style="margin-top: 0.5rem;table-layout: auto;">
                <thead>
                    <tr>
                        <th class="tableHead">No</th>
                        <th class="tableHead">Nama Ruang</th>
                        <th class="tableHead">Waktu Peminjaman</th>
                        <th class="tableHead">Kepentingan</th>
                        <th class="tableHead">Status Peminjaman</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                   $no = 1;
                   $joinConditions = array(
                       "ruang" => "peminjaman.RuangID = ruang.RuangID"
                   );
                   $searchConditions = "AkunID = '".$_SESSION['idUser']."' AND peminjaman.StatusPeminjaman = 'Menunggu Konfirmasi' OR peminjaman.StatusPeminjaman = 'Disetujui'";
                   $query = readData($koneksi, "peminjaman", '', $joinConditions, $searchConditions);
                    if (!empty($query)) {
                        foreach ($query as $row) {
                        ?>
                        <tr>
                            <td scope="row">
                                <?= $no++; ?>
                            </td>
                            <td>
                                <?= $row['DeskripsiRuang']; ?>
                            </td>
                            <td>
                                <?= $row['WaktuPinjam'] . " - " . $row['WaktuKembali']; ?>
                            </td>
                            <td>
                                <?= $row['Keperluan']; ?>
                            </td>
                            <td>
                                <?php
                                if ($row['StatusPeminjaman'] == "Menunggu Konfirmasi") {
                                    ?>
                                    <span class="py-2 px-3 bg-biru me-2 rounded-pill fw-bold text-white"
                                        style="font-size:small">Menunggu</span>
                                    <span role="button" class="py-2 px-4 bg-danger rounded-pill fw-bold text-white"
                                        style="font-size:small" onclick="confirmCancellation()">Batalkan</span>
                                <?php }
                                ?>
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
</div>
<script>
    function confirmCancellation() {
        // Use the built-in confirm dialog
        const isConfirmed = confirm('Apakah Anda yakin ingin membatalkan peminjaman?');

        // Check if the user clicked "OK"
        if (isConfirmed) {
            // Redirect to the specified page
            window.location.href = 'index.php?page=controller/antrean-pinjam.php&id=<?= $row['PeminjamanID']; ?>';
        }
    }
</script>
