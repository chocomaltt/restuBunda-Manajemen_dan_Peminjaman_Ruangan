<?php
$query = readData($koneksi, "peminjaman" , '' ,'' , 'PeminjamanID =' . $_SESSION['idPinjam']);  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Surat Peminjaman Gedung</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <style>
      body {
        font-family: "Times New Roman", Times, serif;
        padding-top: 0;
        margin-top: 0;
        /* line-height: 1; */
        /* margin-left: ; */
      }
      .header {
        display: flex;
        align-items: center;
        text-align: center;
        justify-content: space-between;
        margin-top: 0;
        margin-bottom: 5px;
        border-bottom: 1px solid #000;
        padding: 0px 20px 10px 20px;
        line-height: 0.2;
      }
      p{
        margin-bottom: 2px;
      }
      .header img {
            max-height: 102px;
            max-width: 105px;
        }
        .body{
            text-align: justify;
            line-height: 1.2;
            margin-left: 83px;
            margin-right: 45px;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
        }

      .kementerian {
        font-size: 16pt;
      }
      .kampus {
        font-size: 14pt;
      }
      .organisasi {
        font-size: 14pt;
        font-weight: bold;
      }
      .info {
        font-size: 12pt;
      }
      .ttd{
        display: flex;
        text-align: justify;
        justify-content: space-between;
      }
      .ttd-pusat{
        display: flex;
        text-align: justify;
        justify-content: space-between;
      }
    </style>
  </head>
  <body>
    <?php
    if(!emtpy($_GET['if'])){
      $query = readData($koneksi, "peminjaman", '', '', "PeminjamanID = '" . $_GET['idPinjam'] . "'");
    }
    // $joinConditions = array (
    //   "ruang" => "peminjaman.RuangID = ruang.RuangID",
    //   "akun" => "peminjaman.AkunID = akun.AkunID"
    // );
    $searchConditions = ""
    ?>
    <div class="header">
        <div>
            <img src="assets/img/logo-polinema.png" alt="logo kiri">
        </div>
        <div>
            <p class="kementerian">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN</p>
            <p class="kementerian">RISET, DAN TEKNOLOGI</p>
            <p class="kampus">POLITEKNIK NEGERI MALANG</p>
            <p class="organisasi">INFORMATION TECHNOLOGY DEPARTMENT</p>
            <p class="organisasi">ENGLISH COMMUNITY</p>
            <p class="info">Jalan Soekarno Hatta No. 9 Malang 65141</p>
            <p class="info">Telepon (0341) 404424 – 404425 Fax (0341) 404420</p>
            <p class="info">
              <a href="http://www.polinema.ac.id">http://www.polinema.ac.id</a>
            </p>
        </div>
        <div>
            <img src="assets/img/logo_jti_baru.png" alt="logo kanan" style="width: 95px;">
        </div>
    </div>

    <div class="body">
      <p>
        Nomor: 005/OPREC/ITDEC/X/2023 <br />
        Lampiran: - <br />
        Hal: Peminjaman Gedung
      </p>
      <div style="display: flex; flex-direction: column; ">
          <p>
            Yth. Ketua Jurusan Teknologi Informasi <br />
            Politeknik Negeri Malang <br />
        </p>
        <p style="margin-bottom: 10px !important;">
            Dengan hormat,
        </p>
      </div>
      <p style="margin-top: 0;">
        Sehubungan dengan adanya kegiatan <!--DIISI KETERANGAN UTK NAMA KEGIATAN--> <?=$row['Keterangan'];?>, kami mohon bantuan
        peminjaman Gedung Teknik Sipil Politeknik Negeri Malang beserta
        fasilitas yang ada didalamnya dan daya listrik di gedung tersebut.
        <br />
    </p>
    <!-- &nbsp; = tab -->
    <p>
        Kegiatan ini akan diselenggarakan pada: <br />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;hari, tanggal&nbsp;&nbsp;:<!--DIISI TANGGAL MULAI DAN KEMBALI--> <?=$row['WaktuPinjam'];?> dan <?=$row['WaktuKembali'];?> <br />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pukul&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <!--DIISI JAM MULAI--> <?=$row[''];?> - selesai <br />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;tempat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?=$row[''];?> Lantai 7
        Gedung Teknik Sipil, Politeknik Negeri Malang <br>
        Demikian surat peminjaman ini kami buat, atas izin dan bantuan yang
        diberikan kami sampaikan terima kasih. <br />
    </p>
    <div class="ttd">
        <div>
            <span style="color: white;">____</span><br>
            Ketua Umum ITDEC,<br><br><br><br>
            Natasha Dwi Pramudita <br>
            NIM. 2141720147
        </div>
        <div>
            Hormat kami,<br>
            Ketua Pelaksana <br><br><br><br>
            Reza Arya Wijaya <!--DIISI NAMA PEMINJAM--> <br>
            NIM. 2241720252 <!--DIISI ID PEMINJAM-->
        </div>
    </div>
    <p style="text-align: center;">
        Mengetahui dan menyetujui
    </p>
    <div class="ttd-pusat">
        <div>
            Presiden BEM,<br><br><br>
            Ahmad Asas Hakiki <br>
            NIM. 2142620079
        </div>
        <div>
            Ketua Umum HMTI,<br><br><br>
            Iemaduddin <br>
            NIM. 2141720055
        </div>
    </div>
    <br>
    <div class="ttd-pusat">
        <div>
            Ketua Jurusan Teknologi Informasi,<br><br><br>
            DR. Eng. Rosa Andrie Asmara, ST, MT<br>
            NIP. 19760625200501200
        </div>
        <div>
            Dosen Pembina Kemahasiswaan,<br><br><br>
            Atiqah Nurul Asri, S.Pd., M.Pd <br>
            NIP: 198010102005011001
        </div>
    </div>

      <p>
        Tembusan: <br />
        1. OB Gedung (yang dipinjam), Cp. 081111111111 (Lorem Ipsum) <br />
        2. SATPAM
      </p>
    </div>

    <!-- untuk mengubah dari html ke pdf -->
    <script>
      window.onload = function () {
        const content = document.documentElement.outerHTML;
        const options = {
            margin: [5, 9, 0.75, 8],
          filename: "surat_peminjaman_gedung.pdf",
          image: { type: "jpeg", quality: 0.98 },
          html2canvas: { scale: 2 },
          jsPDF: { unit: "mm", format: "a4", orientation: "portrait" },
        };

        html2pdf().from(content).set(options).save();
      };
    </script>
  </body>
</html>
