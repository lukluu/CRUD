<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}
if ($_SESSION['role'] != 1) {
    header('Location: index.php');
    exit;
}

include "function.php";
$id = '';
$nim = '';
$nama = '';
$jurusan = '';
$jenis_kelamin = '';
$alamat = '';
$foto = '';
if (isset($_GET['ubah'])) {
    $id = $_GET['ubah'];
    $data = query("SELECT * FROM data_mhs WHERE id = $id")[0];
    // var_dump($data);
    // die;
    $nim = $data['nim'];
    $nama = $data['nama'];
    $jurusan = $data['jurusan'];
    $jenis_kelamin = $data['jenis_kelamin'];
    $alamat = $data['alamat'];
    $foto = $data['foto'];
}
