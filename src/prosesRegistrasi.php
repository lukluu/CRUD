<?php
session_start();
if (isset($_SESSION['login'])) {
    header('Location: index.php');
    exit;
}
include "function.php";

if (isset($_POST['register'])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
    alert('user baru berhasil ditambahkan');
    document.location.href='login.php';
    </script>";
    } else {
        echo mysqli_error($conn);
    }
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE email ='$email'");
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        $verify = password_verify($password, $row['password']);

        if ($verify === true) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['login'] = true;
            header("Location: index.php");
            exit;
        } else {
            echo "<script>
            alert('password salah');
            </script>";
        }
    } else {
        echo "<script>
        alert('usernmae tidak ditemukan, silahkan daftar');
        </script>";
    }
}
