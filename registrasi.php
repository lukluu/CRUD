<?php
include 'config.php';

// initializing variables
$username = "";
$email    = "";
$errors = array(); 



// REGISTER USER
if (isset($_POST['register'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($conn, $_POST['nama']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $password_2 = mysqli_real_escape_string($conn, $_POST['confirm_password']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }
  if ($password != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM user WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	// //encrypt the password before saving in the database
    $password_ecr =md5($password);
  	$query = "INSERT INTO user (username, email, password) 
  			  VALUES('$username', '$email', '$password_ecr')";
  	mysqli_query($conn, $query);
    echo "<script>alert('Registrasi berhasil');window.location='login.php';</script>";
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
    <title>Registration</title>
</head>
<body>
    <!-- //form daftar boostrap -->
    <div class="container col-6 border-around-2 bg-light" style=" position: absolute;top:20%;left:25%; padding:1em;">
        <form class="row g-3" method= "post">
            <div class="">
                <label for="nama" class="form-label">nama</label>
                <input name="nama" type="text" class="form-control" id="nama">
            </div>
            <div class="">
                <label for="email" class="form-label">Email address</label>
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp">
            </div>
            <!-- //password boostrap -->
            <div class="">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="password">
            </div>
            <!-- //confirm password boostrap -->
            <div class="">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input name="confirm_password" type="password" class="form-control" id="confirm_password">
            </div>
            <!-- //tombol daftar boostrap -->
            <div class="col-12 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary col-12" name="register">Register</button>
            </div>
            <p class="text-center">Sudah punya akun ?<a href="login.php"> Login</a></p>

</body>
</html>