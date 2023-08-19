<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}
include "function.php";


if (isset($_GET['detail'])) {
    $id = $_GET['detail'];
    $data = query("SELECT * FROM data_mhs WHERE id = $id")[0];
    $nim = $data['nim'];
    $nama = $data['nama'];
    $jurusan = $data['jurusan'];
    $jenis_kelamin = $data['jenis_kelamin'];
    $alamat = $data['alamat'];
    $foto = $data['foto'];
}
