<?php
// include "config.php";
$conn = mysqli_connect("localhost", "root", "", "mahasiswa");
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $data = [];
    while ($hasil = mysqli_fetch_assoc($result)) {
        $data[] = $hasil;
    }

    return $data;
}

function tambah($data)
{
    global $conn;
    $nim = htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $jenis_kelamin = htmlspecialchars($data["jkel"]);
    $alamat = htmlspecialchars($data["alamat"]);

    $gambar = upload();
    if (!$gambar) {
        return false;
    }
    $query = "INSERT INTO `data_mhs` (`id`, `nim`, `nama`, `jurusan`, `jenis_kelamin`, `alamat`, `foto`) VALUES (NULL, '$nim', '$nama', '$jurusan', '$jenis_kelamin', '$alamat', '$gambar')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function upload()
{
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    if ($error === 4) {
        echo "<script>
        alert('Pilih Gambar Terlebih Dahulu');
        </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
        alert('Yang Anda Upload Bukan Gambar');
        </script>";
        return false;
    }

    if ($ukuranFile > 2000000) {
        echo "<script>
        alert('Ukuran Gambar Terlalu Besar');
        </script>";
        return false;
    }
    $no = 1;
    $namaFileBaru = 'crud-' . uniqid() . '.' . $ekstensiGambar;
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
    return $namaFileBaru;
}
function ubah($data)
{
    global $conn;
    $id = $data['id'];
    $nim = htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $jenis_kelamin = htmlspecialchars($data["jkel"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $gambarLama = htmlspecialchars($data["foto"]);
    if ($_FILES['foto']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }
    $query = "UPDATE `data_mhs` SET `nim` = '$nim', `nama` = '$nama', `jurusan` = '$jurusan', `jenis_kelamin` = '$jenis_kelamin', `alamat` = '$alamat', `foto` = '$gambar' WHERE `data_mhs`.`id` = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function hapus($id)
{
    global $conn;
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM `data_mhs` WHERE `data_mhs`.`id` = $id");
    return mysqli_affected_rows($conn);
}
function cari($keyword)
{
    $query = "SELECT *FROM data_mhs WHERE nim LIKE '%$keyword%' OR nama LIKE '%$keyword%' OR jurusan LIKE '%$keyword%' OR jenis_kelamin LIKE '%$keyword%' OR alamat LIKE '%$keyword%'";
    return query($query);
}
