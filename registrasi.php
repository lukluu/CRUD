<?php
include "src/prosesRegistrasi.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="js/bootstrap.bundle.min.js"></script>
  <title>Registration</title>
</head>

<body>
  <!-- //form daftar boostrap -->
  <div class="container col-6 bg-dark text-light" style=" position: absolute;top:15%;left:25%; padding:1em;">
    <div class="">
      <form class="row g-3" method="post" action="">
        <div class="">
          <label for="nama" class="form-label">nama</label>
          <input name="username" type="text" class="form-control" id="nama" required>
        </div>
        <div class="">
          <label for="email" class="form-label">Email address</label>
          <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" required>
        </div>
        <!-- //password boostrap -->
        <div class="">
          <label for="password" class="form-label">Password</label>
          <input name="password" type="password" class="form-control" id="password" required>
        </div>
        <!-- //confirm password boostrap -->
        <div class="">
          <label for="confirm_password" class="form-label">Confirm Password</label>
          <input name="confirm_password" type="password" class="form-control" id="confirm_password" required>
        </div>
        <!-- //tombol daftar boostrap -->
        <div class="col-12 d-flex justify-content-center">
          <button type="submit" class="btn btn-primary col-12" name="register">Register</button>
        </div>
        <p class="text-center">Sudah punya akun ?<a href="login.php"> Login</a></p>
      </form>
    </div>
  </div>


</body>

</html>