<div class="w-75 position-relative" style="z-index: 0; margin-top: 59px; padding: 0 30px;">
    <div class="w-75" style=" justify-content: start; margin: 4rem 25 0 23  rem;">
        <p class="text-white fw-bold fs-2">DAFTAR RUANG</p>
    </div>
    <div class="container" style="padding: 40px 100px;">
        <div class="row row-cols-2 d-flex justify-content-start">
        <?php
            $no = 1;
            $query = readData($koneksi, "denah");
            if(!empty($query)) {
                foreach ($query as $row){
        ?>
            <div class="col">
                <img src="view/admin/img/<?= $row['File'];?>" alt="" style="width: 90%; margin: 30px;">
            </div>
        <?php
            }
        }
        ?>
        </div>
    </div>
</div>
