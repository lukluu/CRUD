<?php
include "src/prosesDetail.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <title>Detail Mahasiswa</title>
</head>
<style>

</style>

<body>
    <nav class="p-3 bg-dark d-flex align-items-center">
        <div class="container-fluid">
            <h4 class="text-white text-center">DETAIL MAHASISWA</h4>
        </div>
    </nav>
    <div class="container p-5" style="height: 100vh;">
        <div class="row d-flex justify-content-center">
            <div class="col">
                <?php Flasher::flash() ?>
            </div>
            <div class=" col-sm-5">
                <div>
                    <h4 class="text-center"><strong><?= $nama ?></strong></h4>
                </div>
                <div class="mt-5 row">
                    <strong for="nim" class="col-sm-5">NIM</strong>
                    <div class="col-sm-4">
                        <span class="">: <?= $nim ?></span>
                    </div>
                </div>
                <div class="mt-2 row">
                    <strong for="nim" class="col-sm-5">JURUSAN</strong>
                    <div class="col-sm-4">
                        <span class="">: <?= $jurusan ?></span>
                    </div>
                </div>
                <div class="mt-2 row">
                    <strong for="nim" class="col-sm-5">JENIS KELAMIN</strong>
                    <div class="col-sm-4">
                        <span class="">: <?= $jenis_kelamin ?></span>
                    </div>
                </div>

                <div class="mt-2 row">
                    <strong for="nim" class="col-sm-5">ALAMAT</strong>
                    <div class="col-sm-4">
                        <span class="">: <?= $alamat ?></span>
                    </div>
                </div>
                <div class="mt-5 row d-flex">
                    <div class="col-sm-2">
                        <a href="index.php" type="button" class="btn btn-warning btn-sm ">kembali</a>
                    </div>
                    <div class="col-sm-5">
                        <a href="kelola.php?ubah=<?= $data['id']; ?>" type="button" class="btn btn-success btn-sm col-sm-5">ubah</a>
                    </div>

                </div>

            </div>
            <div class="col-sm-5">
                <img src="img/<?= $foto ?>" width="400px" alt="">
            </div>
        </div>

    </div>

</body>

</html>