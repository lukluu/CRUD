<?php
include "function.php";
$data = query("SELECT * FROM data_mhs");
if (isset($_POST['cari'])) {
  $data = cari($_POST['keyword']);
}

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
      <p class="text-white">
      </p>
      <a href="login.php"><button type="button" class="btn btn-light btn-sm" onclick="return confirm('Anda Akan Log Out')">Log Out</button></a>
    </div>
  </nav>

  <div class="container">
    <h1 class="judul text-center mb-5">Data Mahasiswa</h1>
    <!-- CARI -->
    <form class="d-flex" role="search" class="mt-5" action="" method="post">
      <input class="form-control me-2" type="search" placeholder="Masukan NIM" aria-label="Search" name="keyword" size="50" autofocus placeholder="cari NIM" autocomplete="off">
      <button class="btn btn-outline-success" type="submit" name="cari">Search</button>
    </form>
    <a href="kelola.php" type="button" class="btn btn-primary mb-3 mt-3">Tambah</a>
    <?php if (isset($_SESSION['eksekusi'])) : ?>
      <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <?php echo $_SESSION['eksekusi']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
      </div>
    <?php session_destroy();
    endif; ?>
    <div class="table-responsive mt-3">
      <table class="table align-middle table-bordered table-hover">
        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col">NIM</th>
            <th scope="col">Nama Mahasiswa</th>
            <th scope="col">Jurusan</th>
            <th scope="col">Jenis Kelamin</th>
            <th scope="col">Foto</th>
            <th scope="col">Alamat</th>
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
              <td><?= $data['jurusan']  ?></td>
              <td><?= $data['jenis_kelamin']  ?></td>
              <td class="text-center"><img src="img/<?= $data['foto']  ?>" alt="" width="100px"></td>
              <td><?= $data['alamat']  ?></td>
              <td class="text-center">
                <a href="kelola.php?ubah=<?= $data['id']; ?>" type="button" class="btn btn-success btn-sm">ubah</a>
                <a href="proses.php?hapus=<?= $data['id']; ?>" onclick="return confirm('Yakin Di Hapus?')" type="button" class="btn btn-danger btn-sm">hapus</a>
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