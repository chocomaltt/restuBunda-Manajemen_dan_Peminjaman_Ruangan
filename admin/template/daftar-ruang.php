<div class="position-absolute end-0 w-100 vh-100" style="z-index: 0; max-width: 80%;">
    <div class="w-100 vh-100 position-relative" style="z-index: 0; margin-top: 59px; padding: 0 30px;">
       <p class="text-white fw-bold fs-2">DAFTAR RUANG</p>
        <div class="d-flex gap-2" style="align-items: center;">
            <div style="width: 30%;">
                <input type="search" name="" id="" placeholder="Pilih Ruang" style="border-radius: 3.125rem;outline: none;border: none;padding: 0.5rem 1rem;font-size: 0.8rem;width: 100%;">
            </div>
            <div style="width: 18%;">
                <input type="search" name="" id="" placeholder="Tentukan Tanggal" style="border-radius: 3.125rem;outline: none;border: none;padding: 0.5rem 1rem;font-size: 0.8rem;width: 100%;">
            </div>
            <button class="bg-biru text-white" style="border-radius: 1.25rem;padding: 0.4rem 1.5rem;border: none;">Cari</button>
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
    </style>
        <table class="table-striped-green biru w-100" style="margin-top: 0.5rem;table-layout: auto;">
            <thead>
                <tr>
                    <th class="tableHead">ID Ruang</th>
                    <th class="tableHead">Nama Ruang</th>
                    <th class="tableHead">Deskripsi</th>
                    <th class="tableHead">Lantai</th>
                    <th class="tableHead">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Ruang A</td>
                    <td>Ruang pertemuan</td>
                    <td>Lantai 2</td>
                    <td><span class="py-2 px-4 bg-warning me-2 rounded fw-bold" style="font-size:small">Terpakai</span><span class="p-2 bg-secondary-subtle rounded fw-bold" style="font-size:small">Tidak Terpakai</span></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Ruang B</td>
                    <td>Ruang kelas</td>
                    <td>Lantai 1</td>
                    <td><span class="py-2 px-4 bg-secondary-subtle me-2 rounded fw-bold" style="font-size:small">Terpakai</span><span class="p-2 bg-warning rounded fw-bold" style="font-size:small">Tidak Terpakai</span></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Ruang C</td>
                    <td>Ruang laboratorium</td>
                    <td>Lantai 3</td>
                    <td><span class="py-2 px-4 bg-secondary-subtle me-2 rounded fw-bold" style="font-size:small">Terpakai</span><span class="p-2 bg-warning rounded fw-bold" style="font-size:small">Tidak Terpakai</span></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Ruang D</td>
                    <td>Ruang teori</td>
                    <td>Lantai 4</td>
                    <td><span class="py-2 px-4 bg-warning me-2 rounded fw-bold" style="font-size:small">Terpakai</span><span class="p-2 bg-secondary-subtle rounded fw-bold" style="font-size:small">Tidak Terpakai</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>