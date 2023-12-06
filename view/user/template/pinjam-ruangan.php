<div class="position-absolute end-0 w-100 vh-100" style="z-index: 0; max-width: 80%;">
    <div class="w-100 vh-100 position-relative" style="z-index: 0; margin-top: 59px; padding: 0 30px;">
    <p class="text-white fw-bold fs-2">PENGEMBALIAN</p>
    <div class="d-flex flex-column align-items-center">
        <div class="w-75 bg-white p-2 m-0">
            <span class="bg-white biru fw-bold ms-4">Data Peminjaman Ruang</span>
        </div>
        <form action="#" method="post" class="bg-biru p-4 w-75 d-flex flex-column gap-3">
         <div>
             <label class="fw-bold text-white" for="namaPeminjam">Nama Peminjam :</label>
             <input type="text" class="form-control rounded bg-white" id="namaPeminjam" name="nama" required>
         </div>
         <div>
             <label class="fw-bold text-white" for="statusPeminjam">Status Peminjam :</label>
             <input type="text" class="form-control rounded bg-white" id="statusPeminjam" name="status" required>
         </div>
         <div>
             <label class="fw-bold text-white" for="jurusanPeminjam">Jurusan Peminjam :</label>
             <input type="text" class="form-control rounded bg-white" id="jurusanPeminjam" name="jurusan" required>
         </div>
         <div>
             <label class="fw-bold text-white" for="ruangan">Nama Ruang Yang Dipinjam :</label>
             <input type="text" class="form-control rounded bg-white" id="ruangan" name="ruang" required>
         </div>
         <div>
             <label class="fw-bold text-white" for="ketAcara">Keterangan Acara :</label>
             <input type="text" class="form-control rounded bg-white" id="ketAcara" name="keterangan" required>
         </div>
         <div>
             <label class="fw-bold text-white" for="tglPinjam">Tanggal dan Waktu Peminjaman :</label>
             <input type="date" class="form-control rounded bg-white" id="tglPinjam" name="tglPinjam" required>
         </div>
         <div>
             <label class="fw-bold text-white" for="tglReturn">Tanggal dan Waktu Pengembalian :</label>
             <input type="date" class="form-control rounded bg-white" id="tglReturn" name="tglReturn" required>
         </div>
         <div class="w-100 d-flex justify-content-center">
            <input class="btn btn-group bg-warning fw-bold" type="submit" value="Submit" name="submit">
         </div>
        </form>
    </div>
    </div>
</div>