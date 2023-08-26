<?php
include "function.php";
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}



if ($_SESSION['role'] == 1) {
    $id = $_SESSION['id'];
    $query = "SELECT *
  FROM user_main
  INNER JOIN user ON user_main.id_user = user.id_user
  INNER JOIN data_mhs ON user_main.id_mhs = data_mhs.id WHERE user_main.id_user = $id";
    $data = query($query)[0];
    $nama = $data['nama'];
    $nim = $data['nim'];
    $jurusan = $data['jurusan'];
    $jenis_kelamin = $data['jenis_kelamin'];
    $alamat = $data['alamat'];
    $foto = $data['foto'];
    $role = $data['role'];
    $username = $data['username'];
    $email = $data['email'];
} else {
    $id = $_SESSION['id'];
    $query = "SELECT *
    FROM user_main
    INNER JOIN user ON user_main.id_user = user.id_user
    INNER JOIN data_mhs ON user_main.id_mhs = data_mhs.id WHERE user_main.id_user = $id";
    $data = query($query);
    if ($data == null) {
        $id = $_SESSION['id'];
        $query = "SELECT *
    FROM user WHERE id_user = $id";
        $data = query($query)[0];
        $id = '';
        $nama = '';
        $nim = '';
        $jurusan = '';
        $jenis_kelamin = '';
        $alamat = '';
        $foto = '';
        $role = $data['role'];
        $username = $data['username'];
        $email = $data['email'];
        var_dump($data);
    } else {
        $data = query($query)[0];
        $nama = $data['nama'];
        $nim = $data['nim'];
        $jurusan = $data['jurusan'];
        $jenis_kelamin = $data['jenis_kelamin'];
        $alamat = $data['alamat'];
        $foto = $data['foto'];
        $role = $data['role'];
        $username = $data['username'];
        $email = $data['email'];
    }

    if (isset($_POST['ubah'])) {
        $id = $_POST['id'];
        $nim = $_POST['nim'];
        $username = $_POST['username'];
        $nama = $_POST['nama'];
        $jurusan = $_POST['jurusan'];
        $jenis_kelamin = $_POST['jkel'];
        $email = $_POST['email'];
        $alamat = $_POST['alamat'];
        $foto = $_POST['foto'];
        $cek = "SELECT * FROM `data_mhs` WHERE `data_mhs`.`id` = $id";
        $result = mysqli_query($conn, $cek);
        if ($result) {
            $query = "UPDATE `data_mhs` SET `nim` = '$nim', `nama` = '$nama', `jurusan` = '$jurusan', `jenis_kelamin` = '$jenis_kelamin', `alamat` = '$alamat', `foto` = '$foto' WHERE `data_mhs`.`id` = $id";
        } else {
            $query = "INSERT INTO `data_mhs` (`id`, `nim`, `nama`, `jurusan`, `jenis_kelamin`, `alamat`, `foto`) VALUES ('$id', '$nim', '$nama', '$jurusan', '$jenis_kelamin', '$alamat', '$foto')";
        }
        mysqli_query($conn, $query);
        $query = "UPDATE `user` SET `username` = '$username', `email` = '$email' WHERE `user`.`id_user` = $id";
        mysqli_query($conn, $query);
        header('Location: index.php');
        exit;
    }
}
