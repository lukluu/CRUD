<?php
//login

session_start();
if (isset($_SESSION['email'])) {
    header("Location: index.php");
    session_destroy();
}
include "config.php";
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $query = "SELECT * FROM user WHERE email='$email'";
    $sql = mysqli_query($conn, $query);
    if (mysqli_num_rows($sql) > 0) {
        $result = mysqli_fetch_assoc($sql);
        if ($password == $result['password']) {
            $_SESSION['email'] = $email;
            $_SESSION['nama'] = $result['nama'];
            $_SESSION['id'] = $result['id'];
            header("Location: index.php");
        } else {
            $_SESSION['salah'] = 'Password Salah';
        }
    } else {
        if ($email == '') {
            $_SESSION['salah'] = 'Email Tidak Boleh Kosong';
        } else {
            $_SESSION['salah'] = 'Email Salah';
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>

<body>


    <div class="container col-6 border-around-2 bg-light" style=" position: absolute;top:25%;left:25%; padding:1em;">
        <?php if (isset($_SESSION['salah'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <?php echo $_SESSION['salah']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
            </div>
        <?php session_destroy();
        endif; ?>
        <form class="row g-3" method="post">
            <div class="">
                <label for="email" class="form-label">Email address</label>
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp">
            </div>
            <div class="">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="password">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary col-12" name="login">Login</button>
            </div>
            <p class="text-center">Belum punya akun ?<a href="registrasi.php"> Daftar</a></p>
        </form>
    </div>
</body>

</html>