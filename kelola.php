<?php
include "./src/prosesKelola.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <title>Kelola Mahasiswa</title>
</head>

<body>
    <!-- As a link -->
    <nav class="p-3 bg-dark d-flex align-items-center">
        <div class="container-fluid">
            <?php if (isset($_GET["ubah"])) : ?>
                <h4 class="text-white text-center">UBAH DATA</h4>
            <?php else : ?>
                <h4 class="text-white text-center">TAMBAH DATA</h4>
            <?php endif; ?>
        </div>
    </nav>
    <div class="container mt-5">
        <form action="src/prosesIndex.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="hidden" name="foto" value="<?php echo $foto ?>">
            <div class="mb-3 row">
                <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="nim" id="nim" required value="<?= $nim; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="nama" id="nama" required value="<?= $nama; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="jurusan" id="jurusan" required value="<?= $jurusan; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jkel" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <select name="jkel" id="jkel" class="form-select" required>
                        <option <?php if ($jenis_kelamin == "Laki-laki") {
                                    echo 'selected';
                                } ?> value="Laki-laki">Laki-laki</option>
                        <option <?php if ($jenis_kelamin == "Perempuan") {
                                    echo 'selected';
                                } ?> value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                <?php if (isset($_GET['ubah'])) : ?>
                    <div class="col-sm-10 mb-3">
                        <img src="img/<?= $foto; ?>" alt="" width="100px">
                    </div>
                <?php endif ?>
                <div class="col-sm-10">
                    <input class="col-sm-10 form-control" type="file" name="foto" id="foto" accept="image/*">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat Lengkap</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="alamat" id="alamat" rows="3" required><?= $alamat; ?></textarea>
                </div>
            </div>
            <div class="mb-3 text-center mt-5">
                <?php if (isset($_GET["ubah"])) { ?>
                    <button type="submit" name='aksi' value="edit" class="btn btn-primary">Simpan Perubahan</button>
                <?php } else { ?>
                    <button type="submit" name="aksi" value="tambah" class="btn btn-primary">Tambahkan</button>
                <?php } ?>
                <a href="index.php" type="button" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</body>

</html>