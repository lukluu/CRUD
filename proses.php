<?php
include "function.php";

if (isset($_POST['aksi'])) {
    if ($_POST['aksi'] == 'tambah') {
        $berhasil = tambah($_POST);
        if ($berhasil == 1) {
            header("Location: index.php");
        } else {
            echo $berhasil;
        }
    } else if ($_POST['aksi'] == 'edit') {
        $berhasil = ubah($_POST);

        if ($berhasil == 1) {
            header("Location: index.php");
        } else {
            echo "
            <script>
                alert('Data Gagal Diubah');
                document.location.href='index.php';
            </script>
            ";
        }
    }
}



if (isset($_GET["hapus"])) {
    $berhasil = hapus($_GET);
    if ($berhasil == 1) {
        $_SESSION['eksekusi'] = 'Berhasil di Hapus';
        echo "
        <script>
            document.location.href='index.php';
        </script>
    ";
    } else {
        echo $berhasil;
    }
}
