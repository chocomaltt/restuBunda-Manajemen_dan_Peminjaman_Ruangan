<div class="w-75 position-relative" style="z-index: 0; margin-top: 59px; padding: 0 30px;">
        <p class="text-white fw-bold fs-2">JADWAL RUANG</p>
        <!-- Form Pencarian -->
        <form method="post" action="">
            <div class="d-flex gap-2" style="align-items: center;">
                <div style="width: 30%;">
                    <input type="search" name="keyword" placeholder="Pilih Keyword"
                        style="border-radius: 3.125rem;outline: none;border: none;padding: 0.5rem 1rem;font-size: 0.8rem;width: 100%;">
                </div>
                <div style="width: 18%;">
                    <input type="date" name="tanggal" placeholder="Tentukan Tanggal"
                        style="border-radius: 3.125rem;outline: none;border: none;padding: 0.5rem 1rem;font-size: 0.8rem;width: 100%;">
                </div>
                <button type="submit" name="search" class="bg-biru text-white"
                    style="border-radius: 1.25rem;padding: 0.4rem 1.5rem;border: none;">Cari</button>
            </div>
        </form>
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
    <div class="w-100 position-relative" style="z-index: 0; padding: 0 30px;">
        <table id="example" class="table-striped-green biru w-100" style="margin-top: 0.5rem;table-layout: auto;">
            <thead>
                <tr>
                    <th class="tableHead">Kelas</th>
                    <th class="tableHead">Nama Ruang</th>
                    <th class="tableHead">Hari</th>
                    <th class="tableHead">Lantai</th>
                    <th class="tableHead">Mata Kuliah</th>
                    <th class="tableHead">Dosen</th>
                    <th class="tableHead">Waktu Mulai</th>
                    <th class="tableHead">Waktu Akhir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $joinConditions = array(
                    "ruang" => "jadwalruang.RuangID = ruang.RuangID",
                    "hari" => "jadwalruang.HariID = hari.HariID",
                    "sesi" => "jadwalruang.SesiMulaiID = sesi.SesiID",
                    "matakuliah" => "jadwalruang.MataKuliahID = matakuliah.MataKuliahID",
                    "akun" => "jadwalruang.AkunID = akun.AkunID",
                    "kelas" => "jadwalruang.KelasID = kelas.KelasID"
                );
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    // Cek apakah form pencarian dikirimkan
                    if (isset($_POST['search'])) {
                        $keyword = $_POST['keyword'];
                        $tanggal = $_POST['tanggal'];
                        // Inisialisasi kondisi pencarian
                        // $searchConditions = array();
                
                        // Buat kondisi pencarian berdasarkan keyword jika diisi
                        if (!empty($keyword) && empty($tanggal)) {
                            $searchConditions = "(
                                        ruang.NamaRuang LIKE '%$keyword%' OR
                                        hari.NamaHari LIKE '%$keyword%' OR
                                        sesi.JudulSesi LIKE '%$keyword%' OR
                                        matakuliah.NamaMataKuliah LIKE '%$keyword%' OR
                                        akun.Nama LIKE '%$keyword%' OR
                                        kelas.NamaKelas LIKE '%$keyword%'
                                        ) ORDER BY hari.HariID ASC";
                        }
                        // Buat kondisi pencarian berdasarkan tanggal jika diisi
                        if (!empty($tanggal) && empty($keyword)) {
                            $hari = date('N', strtotime($tanggal));
                            $searchConditions = "jadwalruang.HariID = '$hari' ORDER BY hari.HariID ASC";
                        }

                        if (!empty($keyword) && !empty($tanggal)) {
                            $hari = date('N', strtotime($tanggal));
                            $searchConditions = "(
                                        ruang.NamaRuang LIKE '%$keyword%' OR
                                        hari.NamaHari LIKE '%$keyword%' OR
                                        sesi.JudulSesi LIKE '%$keyword%' OR
                                        matakuliah.NamaMataKuliah LIKE '%$keyword%' OR
                                        akun.Nama LIKE '%$keyword%' OR
                                        kelas.NamaKelas LIKE '%$keyword%' AND
                                        jadwalruang.HariID = '$hari'
                                        ) ORDER BY hari.HariID ASC";
                        }
                        // Gabungkan kondisi pencarian dengan kondisi join sebelumnya
                        // $conditions = array_merge($joinConditions, $searchConditions);
                
                        // Lakukan query dengan kondisi pencarian
                        $query = readData($koneksi, "jadwalruang", '', $joinConditions, $searchConditions);
                    }
                } else {
                    // Jika form pencarian tidak dikirimkan, tampilkan semua data
                    $query = readData($koneksi, "jadwalruang", '', $joinConditions);
                }


                // $query = readData($koneksi, "jadwalruang",'',$joinConditions);
                if (!empty($query)) {
                    foreach ($query as $row) {
                        ?>
                        <tr>
                            <td>
                                <?= $row['NamaKelas']; ?>
                            </td>
                            <td>
                                <?= $row['NamaRuang']; ?>
                            </td>
                            <td>
                                <?= $row['NamaHari']; ?>
                            </td>
                            <td>
                                <?= $row['Lantai']; ?>
                            </td>
                            <td>
                                <?= $row['NamaMataKuliah']; ?>
                            </td>
                            <td>
                                <?= $row['Nama']; ?>
                            </td>
                            <td>
                                <?php
                                $querySesi = readData($koneksi, "sesi", '', '', 'sesiID =' . $row['SesiMulaiID']);
                                foreach ($querySesi as $rows) {
                                    echo $row['WaktuMulai'];
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                $querySesi = readData($koneksi, "sesi", '', '', 'sesiID =' . $row['SesiAkhirID']);
                                foreach ($querySesi as $rows) {
                                    echo $row['WaktuSelesai'];
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="8">Tidak Ada Data Tersedia</td>
                    </tr>
                    <?php
                }
                ?>
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