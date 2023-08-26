<?php
include "src/prosesUser.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- boxicon online-->
    <link href="https://boxicons.com/css/boxicons.min.css" rel="stylesheet">
    <!-- font awosme -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">


    <title>User</title>
</head>

<body>

    <div class="container pt-4 pb-4">
        <nav class="p-3 bg-dark d-flex align-items-center">
            <div class="container-fluid">
                <h4 class="text-white text-center">EDIT PROFILE</h4>
            </div>
        </nav>
        <div class="card text-center border-rounded-0">
            <strong>Edit Profile Kamu Agar Muncul di Dashbaord</strong>
        </div>
        <!-- card ubah profile foto nama dan lain lian -->
        <div class="card mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <!--form -->
                        <form action="">
                            <input type="file" name="foto" id="foto" class="form-control" style="display: none;
                            " onchange="form.submit()">
                            <label for="foto">
                                <img src="img/profil.jpg" alt="" class="img-thumbnail rounded-circle" width="200px" height="200px">
                            </label>
                        </form>
                    </div>
                    <div class="col-sm-9">
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <input type="hidden" name="foto" value="<?php echo $foto ?>">
                            <div class="mb-3 row">
                                <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="nim" id="nim" required value="<?= $nim; ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="username" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="username" id="username" required value="<?= $username; ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="nama" id="nama" required value="<?= $nama; ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="jurusan" id="jurusan" required value="<?= $jurusan; ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jkel" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <select name="jkel" id="jkel" class="form-select" required>
                                        <option <?php if ($jenis_kelamin == "Laki-laki") {
                                                    echo 'selected';
                                                } ?> value="Laki-laki">Laki-laki</option>
                                        <option <?php if ($jenis_kelamin == "Perempuan") {
                                                    echo 'selected';
                                                } ?> value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="email" name="email" id="email" required value="<?= $email; ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="5" required><?= $alamat; ?></textarea>
                                </div>
                            </div>
                            <!-- save -->
                            <div class="mb-3 row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button type="submit" name="ubah" class="btn btn-success">Save</button>
                                    <a class="" href="index.php"><button type="button" class="btn btn-warning">Kembali</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div>
            <button id="changePasswordBtn" class="btn btn-primary col-3 mt-3">Ubah Password</button>
            <a name="" href="src/logout.php"><button type="button" class="btn mt-3 btn-danger" onclick="return confirm('Anda Akan Log Out')">Log Out</button></a>
        </div>

        <div id="passwordForm" class=" pt-3 pb-3" style="display: none;">
            <form>
                <div class="form-group">
                    <label for="oldPassword">Password Lama</label>
                    <input type="password" class="form-control" id="oldPassword" placeholder="Enter old password">
                </div>
                <div class="form-group">
                    <label for="newPassword">Password Baru</label>
                    <input type="password" class="form-control" id="newPassword" placeholder="Enter new password">
                </div>
                <button type="submit" class="btn btn-success">Change</button>
            </form>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        const changePasswordBtn = document.getElementById("changePasswordBtn");
        const passwordForm = document.getElementById("passwordForm");

        changePasswordBtn.addEventListener("click", function() {
            passwordForm.style.display = "block";
        });
    </script>
</body>

</html>