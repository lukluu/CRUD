<?php
include "function.php";
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}


$id = $_SESSION['id'];
// query join data_mhs dan user
$query = "SELECT * FROM data_mhs INNER JOIN user ON data_mhs.id_user = user.id WHERE data_mhs.id_user = $id";
$data = mysqli_query($conn, $query);
$cek =  mysqli_num_rows($data);
if ($cek == 0) {
    $query = "SELECT * FROM user WHERE id = $id";
    $data = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($data);
    $username = $row['username'];
    $password = $row['password'];
    $email = $row['email'];
    $nama = '';
    $nim = '';
    $jurusan = '';
    $alamat = '';
    $jenis_kelamin = '';
    $foto = '';

    if (isset($_POST['submit'])) {
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $jurusan = $_POST['jurusan'];
        $jenis_kelamin = $_POST['jkel'];
        $alamat = $_POST['alamat'];
        $query = "INSERT INTO `data_mhs` (`id`, `nim`, `nama`, `jurusan`, `jenis_kelamin`, `alamat`, `id_user`) VALUES ('$id', '$nim', '$nama', '$jurusan', '$jenis_kelamin', '$alamat', '$id')";
        mysqli_query($conn, $query);
    }
} else {
    $row = mysqli_fetch_assoc($data);
    $username = $row['username'];
    $password = $row['password'];
    $email = $row['email'];
    $nama = $row['nama'];
    $nim = $row['nim'];
    $jurusan = $row['jurusan'];
    $alamat = $row['alamat'];
    $foto = $row['foto'];
    $jenis_kelamin = $row['jenis_kelamin'];
    if (isset($_POST['submit'])) {
        $berhasil = ubah($_POST);
        if ($berhasil == 1) {
            Flasher::setFlash('berhasil', 'diubah', 'success', $_POST['nama']);
            header("Location: user.php");
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger', $_POST['nama']);
            header("Location: user.php");
        }
        $username = $_POST['username'];
        $email = $_POST['email'];
        $query_user = "UPDATE `user` SET `username` = '$username', `email` = '$email' WHERE `user`.`id` = $id";
        mysqli_query($conn, $query_user);
    }
}
if (isset($_POST['ubahPass'])) {
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
    $verify = password_verify($oldPassword, $row['password']);
    if ($verify === true) {
        if ($newPassword === $confirmPassword) {
            $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $query = "UPDATE `user` SET `password` = '$newPassword' WHERE `user`.`id` = $id";
            mysqli_query($conn, $query);
            echo "<script>
            alert('password berhasil diubah');
            document.location.href='user.php';
            </script>";
        } else {
            echo "<script>
            alert('konfirmasi password tidak sesuai');
            document.location.href='user.php';
            </script>";
        }
    } else {
        echo "<script>
        alert('password lama salah');
        document.location.href='user.php';
        </script>";
    }
}




if (isset($_POST['ubahFoto'])) {
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $size = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $format = ['jpg', 'jpeg', 'png'];
    $formatFoto = explode('.', $foto);
    $formatFoto = strtolower(end($formatFoto));
    if (!in_array($formatFoto, $format)) {
        echo "<script>
        alert('format foto tidak sesuai');
        document.location.href='user.php';
        </script>";
    } else {
        if ($size > 2000000) {
            echo "<script>
            alert('ukuran foto terlalu besar');
            document.location.href='user.php';
            </script>";
        } else {
            $foto = 'crud-' . uniqid() . '.' . $formatFoto;
            move_uploaded_file($tmp, 'img/' . $foto);
            $query = "UPDATE `data_mhs` SET `foto` = '$foto' WHERE id = $id";
            mysqli_query($conn, $query);
            echo "<script>
            alert('foto berhasil diubah');
            document.location.href='user.php';
            </script>";
        }
    }
}
