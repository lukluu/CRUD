<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}
include "function.php";

// tampil data
function tampil()
{
    $data = query("SELECT * FROM data_mhs");
    return $data;
}
function tampilId($id)
{
    $data = query("SELECT * FROM data_mhs WHERE id =$id");
    return $data;
}




// tambah dan edit
if (isset($_POST['aksi'])) {
    if ($_POST['aksi'] == 'tambah') {
        $berhasil = tambah($_POST);
        if ($berhasil == 1) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success', $_POST['nama']);
            header("Location: ../index.php");
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            echo $berhasil;
        }
    } else if ($_POST['aksi'] == 'edit') {
        $berhasil = ubah($_POST);
        if ($berhasil == 1) {
            Flasher::setFlash('berhasil', 'diubah', 'success', $_POST['nama']);
            header("Location: ../index.php");
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger', $_POST['nama']);
            header("Location: ../index.php");
        }
    }
}


// hapus
if (isset($_GET["hapus"])) {
    $berhasil = hapus($_GET);

    if ($berhasil == 1) {
        Flasher::setFlash('berhasil', 'dihapus', 'success', $nama);
        header("Location: ../index.php");
    } else {
        echo $berhasil;
    }
}


// cari
if (isset($_POST['cari'])) {
    $data = cari($_POST['keyword']);
    // kirim data ke index
    return $data;
} else {
    $data = query("SELECT * FROM data_mhs");
    return $data;
}
