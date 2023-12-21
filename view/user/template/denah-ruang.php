<style>
    .centered-popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
    }

        /* Gaya untuk memperbesar gambar */
    .zoom-img {
        width: 100%;
        max-width: 1300px;
    }
</style>
<div class="w-75 position-relative" style="z-index: 0; margin-top:59px; padding: 0 30px;">
    <div class="w-75" style="justify-content: start; margin: 4rem 25 0 23  rem;">
        <p class="text-white fw-bold fs-2">DENAH RUANG</p>
    </div>
    <div class="w-100" style="">
        <div class="row row-cols-2 d-flex justify-content-start">
        <?php
            $no = 1;
            $query = readData($koneksi, "denah");
            if(!empty($query)) {
                foreach ($query as $row){
        ?>
            <div class="col d-flex justify-content-center align-items-center">
                <img src="view/admin/img/<?= $row['File'];?>" alt="" class="img-fluid" data-toggle="modal" data-target="#exampleModal" style="max-width: 100%; margin: 10 10px; cursor: pointer;">
            </div>
        <?php
            }
        }
        ?>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="view/admin/img/<?= $row['File'];?>" class="zoom-img" alt="Popup Gambar">
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>