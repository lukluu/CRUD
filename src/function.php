<?php
include "config.php";
include "Flasher.php";

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

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if ($error === 4) {
        echo "<script>
        alert('Pilih Gambar Terlebih Dahulu');
        document.location.href='../kelola.php';
        </script>";
        return false;
    }
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
        alert('Yang Anda Upload Bukan Gambar');
        document.location.href='../kelola.php';
        </script>";
        return false;
    }
    if ($ukuranFile > 2000000) {
        echo "<script>
        alert('Ukuran Gambar Terlalu Besar');
        document.location.href='../kelola.php';
        </script>";
        return false;
    }
    $namaFileBaru = 'crud-' . uniqid() . '.' . $ekstensiGambar;
    move_uploaded_file($tmpName, '../img/' . $namaFileBaru);

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
        if (!$gambar) {
            $gambar = $gambarLama;
        } else {
            unlink("../img/$gambarLama");
        }
    }
    $query = "UPDATE `data_mhs` SET `nim` = '$nim', `nama` = '$nama', `jurusan` = '$jurusan', `jenis_kelamin` = '$jenis_kelamin', `alamat` = '$alamat', `foto` = '$gambar' WHERE `data_mhs`.`id` = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function hapus($id)
{
    global $conn;
    $id = $_GET['hapus'];
    $data = query("SELECT * FROM data_mhs WHERE id = $id")[0];
    $foto = $data['foto'];
    unlink("../img/$foto");


    mysqli_query($conn, "DELETE FROM `data_mhs` WHERE `data_mhs`.`id` = $id");
    return mysqli_affected_rows($conn);
}
function cari($keyword)
{
    $query = "SELECT *FROM data_mhs WHERE nim LIKE '%$keyword%' OR nama LIKE '%$keyword%'";
    return query($query);
}


function registrasi($data)
{
    global $conn;
    $username = strtolower(stripslashes($data['username']));
    $email = strtolower(stripslashes($data['email']));
    $password = mysqli_real_escape_string($conn, $data['password']);
    $password2 = mysqli_real_escape_string($conn, $data['confirm_password']);;


    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('username sudah terdaftar');
        document.location.href='../registrasi.php';
        </script>";

        return false;
    }
    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
        alert('konfirmasi password tidak sesuai');
        document.location.href='../registrasi.php';
        </script>";
        return false;
    } else {
        // enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);
        // tambahkan user baru ke database
        mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$email', '$password')");
    }

    return mysqli_affected_rows($conn);
}


function session()
{
    return session_start();
}
