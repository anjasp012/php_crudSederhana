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

$id = $_GET["id"];

$buku = query("SELECT * FROM buku WHERE id = $id")[0];

if (isset($_POST["submit"])) {
    if (edit($_POST) > 0) {
        echo "<script>
        alert('Buku Berhasil Diedit');
        document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
        alert('Buku Gagal Diedit');
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
                    <h2 class="title">Edit Buku</h2>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $buku["id"]; ?>">
                        <input type="hidden" name="gambarLama" value="<?php echo $buku["gambar"]; ?>">
                        <div class="form-row">
                            <div class="name">Judul</div>
                            <div class="value">
                                <input class="input--style-6" type="text" name="judul" required value="<?php echo $buku["judul"]; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Pengarang</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6" type="text" name="pengarang" required value="<?php echo $buku["pengarang"]; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Tahun</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6" type="number" name="tahun" required value="<?php echo $buku["tahun"]; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Sinopsis</div>
                            <div class="value">
                                <div class="input-group">
                                    <textarea class="textarea--style-6" name="sinopsis" required><?php echo $buku["sinopsis"]; ?>"</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Gambar</div>
                            <div class="value">
                                <div class="input-group js-input-file">
                                    <input class="input-file" type="file" name="gambar" id="file">
                                    <label class="label--file" for="file">Pilih file</label>
                                    <span class="input-file__info"><?php echo $buku["gambar"]; ?></span>
                                </div>
                                <div class="label--desc">Upload cover buku disini</div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn--radius-2 btn--blue-2" name="submit" type="submit">Edit Buku</button>
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