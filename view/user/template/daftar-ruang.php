<div class="position-absolute end-0 w-100 vh-100 p-0" style="z-index: 0; max-width: 80%;">
    <div class="w-100 vh-100 position-relative" style="z-index: 0; margin-top: 59px; padding: 0 30px;">
        <p class="text-white fw-bold fs-2">DAFTAR RUANG</p>
        <div class="d-flex gap-2" style="align-items: center;">
            <div style="width: 30%;">
                <input type="search" name="keyword" id="" placeholder="Pilih Ruang"
                    style="border-radius: 3.125rem;outline: none;border: none;padding: 0.5rem 1rem;font-size: 0.8rem;width: 100%;">
            </div>
            <div style="width: 18%;">
                <input type="datetime-local" name="tanggalMulai" id="" placeholder="Tentukan Tanggal"
                    style="border-radius: 3.125rem;outline: none;border: none;padding: 0.5rem 1rem;font-size: 0.8rem;width: 100%;">
            </div>
            <div style="width: 18%;">
                <input type="datetime-local" name="tanggalAkhir" id="" placeholder="Tentukan Tanggal"
                    style="border-radius: 3.125rem;outline: none;border: none;padding: 0.5rem 1rem;font-size: 0.8rem;width: 100%;">
            </div>
            <button class="bg-biru text-white"
                style="border-radius: 1.25rem;padding: 0.4rem 1.5rem;border: none;">Cari</button>
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

            .dataTables_wrapper .dataTables_paginate .paginate_button {
                background-color: var(--warna-putih) !important;
                border: none !important;
                border-radius: 20px !important: color: var(--warna-biru) !important;
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
        <table id="example" class="table-responsive table-striped-green biru w-100"
            style="margin-top: 0.5rem;table-layout: auto;">
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
                $joinConditions = array(
                    "jadwalruang" => "jadwalruang.RuangID = ruang.RuangID"
                );

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    // Cek apakah form pencarian dikirimkan
                    if (isset($_POST['search'])) {
                        $keyword = $_POST['keyword'];
                        $tanggalMulai = $_POST['tanggalMulai'];
                        $tanggalAkhir = $_POST['tanggalAkhir'];
                        // Inisialisasi kondisi pencarian
                        // $searchConditions = array();
                
                        // Buat kondisi pencarian berdasarkan keyword jika diisi
                        if (!empty($keyword) && empty($tanggalMulai) && empty($tanggalAkhir)) {
                            $searchConditions = "(
                                    RuangID LIKE '%$keyword%' OR
                                    NamaRuang LIKE '%$keyword%' OR
                                    DeskripsiRuang LIKE '%$keyword%'
                                    )";
                        }
                        // Buat kondisi pencarian berdasarkan tanggal jika diisi
                        if (!empty($tanggalMulai) && empty($tanggalAkhir) && empty($keyword)) {
                            $hari = date('N', strtotime($tanggalMulai));
                            $searchConditions = "jadwalruang.HariID = '$hari' ORDER BY hari.HariID ASC";
                        }

                        if (!empty($tanggalMulai) && !empty($tanggalAkhir)) {
                            $Mulai = date('N', strtotime($tanggalMulai));
                            $Akhir = date('N', strtotime($tanggalAkhir));
                            $ruangDipinjam = NULL;
                            $jadwalRuang = cekJadwalRuang($koneksi, $ruangDipinjam, $Mulai, $Akhir);
                            $peminjamanRuang = cekPeminjamanRuang($koneksi, $ruangDipinjam, $Mulai, $Akhir);

                            if (empty($jadwalRuang) && empty($peminjamanRuang)) {
                                $searchConditions = "jadwalruang.HariID = '$hari' ORDER BY hari.HariID ASC";
                            }
                        }
                        // Gabungkan kondisi pencarian dengan kondisi join sebelumnya
                        // $conditions = array_merge($joinConditions, $searchConditions);
                
                        // Lakukan query dengan kondisi pencarian
                        $query = readData($koneksi, "ruang", '', $joinConditions, $searchConditions);
                    }
                } else {
                    // Jika form pencarian tidak dikirimkan, tampilkan semua data
                    $query = readData($koneksi, "ruang", '', $joinConditions);
                }
                $no=1;
                $query = readData($koneksi, "ruang", '', $joinConditions);
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
                            <td><span class="py-2 px-4 bg-warning me-2 rounded fw-bold" style="font-size:small">Terpakai</span>
                                <!-- <span class="p-2 bg-secondary-subtle rounded fw-bold" style="font-size:small">Tidak Terpakai</span> -->
                            </td>
                            <td><a href="index.php?page=pinjam-ruangan.php" class="btn bg-primary px-3 py-1 text-white"
                                    role="button" style="font-size: small">Pinjam</a></td>
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
    $(document).ready(function () {
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
</script>