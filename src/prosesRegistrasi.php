<?php
include "function.php";
session_start();
if (isset($_SESSION['login'])) {
    header('Location: index.php');
    exit;
}


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
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $result = mysqli_query($conn, "SELECT * FROM user WHERE email ='$email'");
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $verify = password_verify($password, $row['password']);

        if ($verify === true) {
            // role
            if ($row['role'] == 1) {
                $_SESSION['login'] = true;
                $_SESSION['role'] = $row['role'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['username'] = $row['username'];
                header('Location: index.php');
                exit;
            } else {
                $_SESSION['login'] = true;
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = $row['role'];
                header('Location: index.php');
                exit;
            }
        } else {
            echo "<script>
            alert('password salah');
            </script>";
            var_dump(password_hash($password, PASSWORD_DEFAULT));
            die;
        }
    } else {
        echo "<script>
        alert('usernmae tidak ditemukan, silahkan daftar');
        </script>";
    }
}
