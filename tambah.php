<?php
session_start();
if (!isset($_SESSION["login"])) {
    echo "<script>
    alert('Login dulu');
    document.location.href = 'login.php';
    </script>";
    exit;
}
require 'functions.php';

if (isset($_POST["submit"])) {
    if (tambah($_POST) > 0) {
        echo "<script>
        alert('Buku Berhasil ditambahkan');
        document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
        alert('Buku Gagal ditambahkan');
        document.location.href = 'index.php';
        </script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Form</title>
</head>

<body>
    <div class="page-wrapper bg-dark p-t-50 p-b-50">
        <div class="wrapper wrapper--w900">
            <div class="card card-6">
                <div class="card-heading">
                    <h2 class="title">Tambah Buku</h2>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="name">Judul</div>
                            <div class="value">
                                <input class="input--style-6" type="text" name="judul" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Pengarang</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6" type="pengarang" name="pengarang" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Tahun</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6" type="tahun" name="tahun" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Sinopsis</div>
                            <div class="value">
                                <div class="input-group">
                                    <textarea class="textarea--style-6" name="sinopsis" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Gambar</div>
                            <div class="value">
                                <div class="input-group js-input-file">
                                    <input class="input-file" type="file" name="gambar" id="file">
                                    <label class="label--file" for="file">Pilih file</label>
                                    <span class="input-file__info">Belum ada file gambar</span>
                                </div>
                                <div class="label--desc">Upload cover buku disini</div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn--radius-2 btn--blue-2" name="submit" type="submit">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>


    <!-- Main JS-->
    <script src="js/global.js"></script>
</body>

</html>