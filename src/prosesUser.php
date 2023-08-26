<?php
include "function.php";
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

var_dump($_POST);
die;
$id = $_SESSION['id'];
// query join user_main dan user
$data = query("SELECT * FROM user_main
INNER JOIN data_mhs ON user_main.id_mhs = data_mhs.id
INNER JOIN user ON user_main.id_user = user.id
WHERE user_main.id_user = $id");

if ($data == null) {
    $data = query("SELECT * FROM user
    WHERE id = $id")[0];
    $id_mhs = '';
    $nim = '';
    $nama = '';
    $jurusan = '';
    $jenis_kelamin = '';
    $alamat = '';
    $foto = '';
    $username = $data['username'];
    $email = $data['email'];
    $role = $data['role'];
    if (isset($_POST['submit'])) {
        // tambah data_mhs
        var_dump($_POST);
        die;
        if (tambah($_POST) > 0) {
            echo "<script>
            alert('data berhasil ditambahkan');
            document.location.href='user.php';
            </script>";
        } else {
            echo mysqli_error($conn);
        }
    }
} else {
    $data = query("SELECT * FROM user_main
INNER JOIN data_mhs ON user_main.id_mhs = data_mhs.id
INNER JOIN user ON user_main.id_user = user.id
WHERE user_main.id_user = $id")[0];
    $nim = $data['nim'];
    $nama = $data['nama'];
    $jurusan = $data['jurusan'];
    $jenis_kelamin = $data['jenis_kelamin'];
    $alamat = $data['alamat'];
    $foto = $data['foto'];
    $username = $data['username'];
    $email = $data['email'];
    $role = $data['role'];
    // var_dump($data);
    // die;
}
