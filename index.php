<?php
include "src/prosesIndex.php";
$data = tampil();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="js/bootstrap.bundle.min.js"></script>

  <title>Data Mahasiswa</title>
</head>

<body>
  <!-- As a link -->
  <nav class="navbar bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand text-white" href="#">CRUD</a>
      <div>
        <span class="text-white">
          <?= $_SESSION['username'];  ?>
        </span>
        <a name="" href="src/logout.php"><button type="button" class="btn btn-light btn-sm" onclick="return confirm('Anda Akan Log Out')">Log Out</button></a>
      </div>

    </div>
  </nav>

  <div class="container">
    <h1 class="judul text-center mb-5">Data Mahasiswa</h1>
    <!-- CARI -->
    <form class="d-flex" role="search" class="mt-5" action="" method="post">
      <input class="form-control me-2" type="search" placeholder="Masukan NIM atau nama" aria-label="Search" name="keyword" size="50" autofocus placeholder="cari NIM" autocomplete="off">
      <button class="btn btn-outline-success" type="submit" name="cari">Search</button>
    </form>
    <!-- tombol TAMBAH -->
    <a href="kelola.php" type="button" class="btn btn-primary mt-3">Tambah</a>

    <div class="row">
      <div class="col">
        <?php Flasher::flash() ?>
      </div>
    </div>
    <div class="table-responsive mt-3">
      <table class="table align-middle table-bordered table-hover">
        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col">NIM</th>
            <th scope="col">Nama Mahasiswa</th>
            <th scope="col" class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <tr>
            <?php $i = 1 ?>
            <?php foreach ($data as $data) : ?>
              <th scope="data"><?= $i ?></th>
              <td><?= $data['nim']  ?></td>
              <td><?= $data['nama']  ?></td>
              <td class="text-center">
                <a href="detail.php?detail=<?= $data['id']; ?>" type="button" class="btn btn-warning btn-sm">Detail</a>
                <a href="src/prosesIndex.php?hapus=<?= $data['id']; ?>" onclick="return confirm('Yakin Di Hapus?')" type="button" class="btn btn-danger btn-sm">hapus</a>
              </td>
          </tr>
          <?php $i++; ?>
        <?php endforeach; ?>
        </tbody>
      </table>

    </div>

  </div>
</body>

</html>