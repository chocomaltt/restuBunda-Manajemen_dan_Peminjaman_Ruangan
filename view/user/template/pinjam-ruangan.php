<div class="w-75 position-relative" style="z-index: 0; margin-top: 59px; padding: 0 30px;">
    <p class="text-white fw-bold fs-2">PEMINJAMAN</p>
    <div class="d-flex flex-column align-items-center">

</div>
</div>
<div class="w-100 position-relative d-flex flex-column align-items-center " style="z-index: 0; padding: 0 30px;">
        <div class="w-75 bg-white p-2">
            <span class="bg-white biru fw-bold ms-4">Data Peminjaman Ruang</span>
        </div>  
        <?php
        $query = readData($koneksi, "akun", '', '', 'AkunID =' . $_SESSION['idUser']);
        foreach ($query as $row) {
            ?>
            <form action="index.php?page=controller/pinjam-ruang.php" method="post"
                class="bg-biru p-4 w-75 d-flex flex-column gap-3">
                <input type="hidden" class="form-control rounded bg-white" id="PeminjamanID" name="data[]">
                <input type="hidden" class="form-control rounded bg-white" id="AkunID" name="data[]"
                    value="<?= $_SESSION['idUser']; ?>">
                <div>
                    <label class="fw-bold text-white" for="namaPeminjam">Nama Peminjam</label>
                    <input type="text" class="form-control rounded bg-white" id="namaPeminjam" name="nama"
                        value="<?= $row['Nama'] ?>" readonly>
                </div>
                <div>
                    <label class="fw-bold text-white" for="ruangan">Nama Ruang Yang Dipinjam :</label>
                    <select class="form-control rounded bg-white" id="ruangan" name="data[]" required>
                        <?php
                        if (!empty($_GET['idRuang'])) {
                            $query = readData($koneksi, "ruang", '', '', " RuangID = '" . $_GET['idRuang'] . "'");
                            echo $_GET['tglMulai'];
                        } else {
                            $query = readData($koneksi, "ruang");
                        }
                        foreach ($query as $row) {
                            ?>
                            <option value="<?= $row['RuangID']; ?>">
                                <?= $row['DeskripsiRuang'] ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label class="fw-bold text-white" for="tglPinjam">Tanggal dan Waktu Peminjaman :</label>
                    <input type="datetime-local" class="form-control rounded bg-white" id="WaktuPinjam" name="data[]" <?php echo isset($_GET['tglMulai']) ? 'value="' . $_GET['tglMulai'] . '"' : ''; ?> required>
                </div>
                <div>
                    <label class="fw-bold text-white" for="tglReturn">Tanggal dan Waktu Pengembalian :</label>
                    <input type="datetime-local" class="form-control rounded bg-white" id="WaktuKembali" name="data[]" <?php echo isset($_GET['tglSelesai']) ? 'value="' . $_GET['tglSelesai'] . '"' : ''; ?> required>
                </div>

                <div>
                    <label class="fw-bold text-white" for="ketAcara">Keterangan Acara :</label>
                    <textarea class="form-control rounded bg-white" id="ketAcara" name="data[]" required></textarea>
                </div>
                <div class="w-100 d-flex justify-content-center">
                    <input type="hidden" class="form-control rounded bg-white" id="CatatanPengembalian" name="data[]">
                    <input type="hidden" class="form-control rounded bg-white" id="StatusPeminjaman" name="data[]"
                        value="Menunggu Konfirmasi">
                    <input type="hidden" class="form-control rounded bg-white" id="StatusPengembalian" name="data[]">
                    <input class="btn btn-group bg-warning fw-bold" type="submit" value="Submit" name="submit">
                </div>
            </form>
            <?php
        }
        ?>
    </div>
</div>

<script>
    // Function to set the min attribute for datetime-local inputs
    function setMinDatetime() {
        // Get the current date and time in the required format (YYYY-MM-DDTHH:mm)
        const currentDate = new Date().toISOString().slice(0, 16);

        // Set the min attribute for the datetime-local inputs
        document.getElementById('WaktuPinjam').min = currentDate;
        document.getElementById('WaktuKembali').min = currentDate;

        // Add an event listener to "WaktuPinjam" to update the min attribute of "WaktuKembali"
        document.getElementById('WaktuPinjam').addEventListener('input', function () {
            // Update the min attribute of "WaktuKembali" based on the selected value of "WaktuPinjam"
            document.getElementById('WaktuKembali').min = this.value;
        });
    }

    // Call the function to set the min attribute when the page loads
    window.onload = setMinDatetime;
</script>