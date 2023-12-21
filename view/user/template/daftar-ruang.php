<div class="w-75 position-relative" style="z-index: 0; margin-top: 59px; padding: 0 30px;">
    <p class="text-white fw-bold fs-2">DAFTAR RUANG</p>
    <div class="d-flex gap-2" style="align-items: center;">
        <div class="pt-3" style="width: 30%;">
            <form method="post" action="">
                    <input type="search" name="keyword" placeholder="Pilih Keyword"
                        style="border-radius: 3.125rem;outline: none;border: none;padding: 0.5rem 1rem;font-size: 0.8rem;width: 100%;">
                </div>
                <div style="width: 18%;">
                    <input type="datetime-local" name="tanggalMulai" id="tanggalMulai" placeholder="Tentukan Tanggal"
                        style="border-radius: 3.125rem;outline: none;border: none;padding: 0.5rem 1rem;font-size: 0.8rem;width: 100%;">
                </div>
                <div style="width: 18%;">
                    <input type="datetime-local" name="tanggalAkhir" id="tanggalAkhir" placeholder="Tentukan Tanggal"
                        style="border-radius: 3.125rem;outline: none;border: none;padding: 0.5rem 1rem;font-size: 0.8rem;width: 100%;">
                </div>
                <button type="submit" name="search" class="bg-biru text-white"
                    style="border-radius: 1.25rem;padding: 0.4rem 1.5rem;border: none;">Cari</button>
                </form>
            </div>
</div>
    <style>
        .table-striped-green{
            background-color: var(--warna-putih);
            border-radius: 5px;
        }

        .table-striped-green tbody tr td{
            padding: 0.9rem; 
        }  

            .table-striped-green tbody tr:nth-of-type(odd){
                background-color: rgb(18, 119, 130,0.5) !important;
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button {
                background-color: var(--warna-putih) !important;
                border: none !important;
                border-radius: 20px !important:
                color: var(--warna-biru) !important;
                padding: 0.5rem 0.75rem !important;
                margin: 0.30rem 0.30rem !important;
                cursor: pointer !important;
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button.current {
                background: rgb(18, 118, 129) !important;
                /* background-color: var(--warna-biru) !important; */
                border-color: var(--warna-biru) !important;
                color: var(--warna-putih) !important;
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
                background: rgb(18, 118, 129) !important;
                background-color: rgb(18, 118, 129) !important;
                color: var(--warna-putih) !important;
            }

            .dataTables_info {
            color: var(--warna-putih) !important;
            }

            .dataTables_wrapper .dataTables_paginate .ellipsis {
            color: var(--warna-putih) !important;
            }
    </style>
    <div class="w-100 position-relative" style="z-index: 0;padding: 0 30px;">
        <table id="example" class="table-responsive table-striped-green biru w-100" style="margin-top: 0.5rem;table-layout: auto;">
            <thead>
                <tr>
                    <th class="tableHead">No</th>
                    <th class="tableHead">Nama Ruang</th>
                    <th class="tableHead">Jenis Ruang</th>
                    <th class="tableHead">Deskripsi</th>
                    <th class="tableHead">Lantai</th>
                    <th class="tableHead">Kapasitas</th>
                    <th class="tableHead">Status</th>
                    <th class="tableHead">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
                // Include or define your functions (cekJadwalRuang, cekPeminjamanRuang, checkRoomAvailability)
                


                $status = false;
                $roomAvailable = '';
                // Check if the form is submitted
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
                    $keyword = $_POST['keyword'];
                    $tanggalMulai = $_POST['tanggalMulai'];
                    $tanggalAkhir = $_POST['tanggalAkhir'];
                    // Create search conditions based on the input
                    if (!empty($keyword)) {
                        $searchConditions = "(
                            ruang.RuangID LIKE '%$keyword%' OR
                            ruang.NamaRuang LIKE '%$keyword%' OR
                            ruang.DeskripsiRuang LIKE '%$keyword%'
                            )";
                        
                        $query = readData($koneksi, "ruang", '', '', $searchConditions);
                    } else if($keyword == '' || !empty($tanggalMulai) || !empty($tanggalAkhir)){
                        $query = readData($koneksi, "ruang", '', '');
                    }

                } else {
                    // If the form is not submitted, fetch all data
                    $query = readData($koneksi, "ruang", '', '');
                }
                // echo $roomAvailable ? 'ya' : 'tidak';
                // Initialize a counter for table rows
                $no = 1;
                if (!empty($query)) {
                    foreach ($query as $row) {
                        ?>
                        <tr>
                            <td scope="row">
                                <?= $no++; ?>
                            </td>
                            <td>
                                <?= $row['NamaRuang']; ?>
                            </td>
                            <td>
                                <?= $row['JenisRuang']; ?>
                            </td>
                            <td>
                                <?= $row['DeskripsiRuang']; ?>
                            </td>
                            <td>
                                <?= $row['Lantai']; ?>
                            </td>
                            <td>
                                <?= $row['Kapasitas']; ?>
                            </td>
                            <td>
                                <?php
                                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
                                    if(!empty($_POST['tanggalMulai']) && !empty($_POST['tanggalAkhir'])){
                                        $roomAvailable = checkRoomAvailability($koneksi, $row['RuangID'], $_POST['tanggalMulai'], $_POST['tanggalAkhir']);
                                    }
                                }
                                ?>
                                <span
                                    class="py-2 px-4 <?php echo $roomAvailable ? 'bg-success' : 'bg-warning'; ?> me-2 rounded fw-bold"
                                    style="font-size:small">
                                    <?php echo $roomAvailable ? 'Tersedia' : 'Terpakai'; ?>
                                </span>
                            </td>
                            <td>
                                <?php echo $roomAvailable ? '<a href="index.php?page=pinjam-ruangan.php&idRuang=' . $row['RuangID'] . '&tglMulai='.$_POST['tanggalMulai'].'&tglSelesai='.$_POST['tanggalAkhir'].'" class="btn bg-primary px-3 py-1 text-white"
                                    role="button" style="font-size: small">Pinjam</a>' : '' ?>
                            </td>
                            <?php
                    }
                } else {
                    ?>
                        <td colspan="8">Tidak Ada Data Tersedia</td>
                        <?php
                }
                ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "pageLength": 5, // Jumlah baris per halaman
                "language": {
                    "paginate": {
                        "previous": "&lt;",
                        "next": "&gt;"
                    }
                }
            });
        });
    </script>
<script>
    // Function to set the min attribute for datetime-local inputs
    function setMinDatetime() {
        // Get the current date and time in the required format (YYYY-MM-DDTHH:mm)
        const currentDate = new Date().toISOString().slice(0, 16);

        // Set the min attribute for the datetime-local inputs
        document.getElementById('tanggalMulai').min = currentDate;
        document.getElementById('tanggalAkhir').min = currentDate;

        // Add an event listener to "tanggalMulai" to update the min attribute of "tanggalAkhir"
        document.getElementById('tanggalMulai').addEventListener('input', function () {
            // Update the min attribute of "tanggalAkhir" based on the selected value of "tanggalMulai"
            document.getElementById('tanggalAkhir').min = this.value;
        });
    }

    // Call the function to set the min attribute when the page loads
    window.onload = setMinDatetime;
</script>
