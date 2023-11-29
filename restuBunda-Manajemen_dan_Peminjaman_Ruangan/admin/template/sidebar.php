<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
        .hover-effect:hover, .active{
            border-radius: 3px !important;
            background-color: #F3C623;
        }
    </style>
</head>
<body>
    <div class="sidebar bg-white z-3 position-absolute start-0" style="width:20%; height: 100vh;">
        <div class="d-flex flex-row justify-content-center align-items-center mt-4" style="height: 15%;">
            <img src="../../assets/img/logo_jti_baru.png" alt="logo JTI Polinema" style="width: 54px; height: 57px;">
        </div>
        <div class="d-flex flex-column justify-content-start mx-1 gap-3">
            <ul class="list-group">
                <li class="list-group-item hover-effect" style="border: none;">
                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg" class="mb-1">
                <path d="M9.56242 6.37492V2.83325H14.1666V6.37492H9.56242ZM2.83325 8.49992V2.83325H7.43742V8.49992H2.83325ZM9.56242 14.1666V8.49992H14.1666V14.1666H9.56242ZM2.83325 14.1666V10.6249H7.43742V14.1666H2.83325ZM3.54159 7.79158H6.72909V3.54159H3.54159V7.79158ZM10.2708 13.4583H13.4583V9.20825H10.2708V13.4583ZM10.2708 5.66659H13.4583V3.54159H10.2708V5.66659ZM3.54159 13.4583H6.72909V11.3333H3.54159V13.4583Z" fill="#10375C"/>
                </svg>
                <a href="#" class="link-dark link-underline link-underline-opacity-0" onclick="activateMenu(event)">Beranda</a>
                </li>
            </ul>
            <div class="collapseButton mx-4">
                <a href="#collapseInformasi" class="list-group-item d-flex flex-row justify-content-between align-items-center" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseInformasi">Informasi Ruangan<img src="../../assets/img/vector-down.png" alt=""></a>
            </div>
            <div class="collapse mx-4" id="collapseInformasi">
                <ul class="list-group gap-2">
                        <li class="list-group-item hover-effect" style="border-style: none;" >
                        <a href="#" class="link-dark link-underline link-underline-opacity-0" onclick="activateMenu(event)">
                        <img src="../../assets/img/daftar-ruangan.png" alt="" class="pb-1">
                        <span class="ms-2">Daftar Ruang</span></a></li>

                        <li class="list-group-item hover-effect" style="border-style: none;" >
                        <a href="#" class="link-dark link-underline link-underline-opacity-0" onclick="activateMenu(event)">
                        <img src="../../assets/img/jadwal.png" alt="" class="pb-1">
                        <span class="ms-2">Jadwal Ruang</span></a></li>

                        <li class="list-group-item hover-effect" style="border-style: none;" >
                        <a href="#" class="link-dark link-underline link-underline-opacity-0" onclick="activateMenu(event)">
                        <img src="../../assets/img/house-plan 1.png" alt="" class="pb-1">
                        <span class="ms-2">Denah Ruang</span></a></li>
                </ul>
            </div>
            <div class="collapseButton mx-4">
                <a href="#collapsePeminjaman" class="list-group-item d-flex flex-row justify-content-between align-items-center" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapsePeminjaman">Peminjaman<img src="../../assets/img/vector-down.png" alt=""></a>
            </div>
            <div class="collapse mx-4" id="collapsePeminjaman">
                <ul class="list-group gap-2">
                    <li class="list-group-item hover-effect" style="border-style: none;">
                    <a href="#" class="link-dark link-underline link-underline-opacity-0">
                    <img src="../../assets/img/pinjam.png" alt="" class="pb-1">
                    <span class="ms-2">Pinjam Ruangan</span></a></li>

                    <li class="list-group-item hover-effect" style="border-style: none;">
                        <a href="#" class="link-dark link-underline link-underline-opacity-0">
                        <svg width="17" height="17" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="mb-1">
                        <path d="M1.68558 13.5249C1.35975 13.5249 1.08775 13.4158 0.869584 13.1977C0.650945 12.979 0.541626 12.7068 0.541626 12.3809V1.91886C0.541626 1.59303 0.650945 1.32103 0.869584 1.10286C1.08775 0.884222 1.35975 0.774902 1.68558 0.774902H9.31433C9.64017 0.774902 9.91217 0.884222 10.1303 1.10286C10.349 1.32103 10.4583 1.59303 10.4583 1.91886V12.3809C10.4583 12.7068 10.3492 12.9788 10.131 13.1969C9.9124 13.4156 9.64017 13.5249 9.31433 13.5249H1.68558ZM1.68558 12.8166H9.31433C9.42295 12.8166 9.52282 12.7712 9.61396 12.6806C9.70463 12.5894 9.74996 12.4896 9.74996 12.3809V1.91886C9.74996 1.81025 9.70463 1.71037 9.61396 1.61924C9.52282 1.52857 9.42295 1.48324 9.31433 1.48324H8.33329V5.81469L6.91663 4.97036L5.49996 5.81469V1.48324H1.68558C1.57697 1.48324 1.4771 1.52857 1.38596 1.61924C1.29529 1.71037 1.24996 1.81025 1.24996 1.91886V12.3809C1.24996 12.4896 1.29529 12.5894 1.38596 12.6806C1.4771 12.7712 1.57697 12.8166 1.68558 12.8166Z" fill="#10375C"/>
                        </svg><span class="ms-2">Antrean Peminjaman</span></a></li>
                        
                    <li class="list-group-item hover-effect" style="border-style: none;">
                    <a href="#" class="link-dark link-underline link-underline-opacity-0" style="border-style: none;">
                    <img src="../../assets/img/borrow 1.png" alt="" class="pb-1">
                    <span class="ms-2">Pengembalian</span></a></li>

                    <li class="list-group-item hover-effect" style="border-style: none;">
                    <a href="#" class="link-dark link-underline link-underline-opacity-0">
                    <img src="../../assets/img/return 1.png" alt="" class="pb-1">
                    <span class="ms-2">Riwayat</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <script>
        function activateMenu(event){
            event.preventDefault();
            const menu = document.querySelectorAll('.list-group-item');
            menu.forEach((menu =>{
                menu.classList.remove('active');
            }));
            event.parentNode.parentNode.classList.add('active');
        }
    </script>
</body>
</html>