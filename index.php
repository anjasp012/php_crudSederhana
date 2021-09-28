<?php
session_start();
if (!isset($_SESSION["login"])) {
    echo "<script>
    alert('Login dulu');
    document.location.href = 'login.php';
    </script>";
    exit;
}
// menghubungkan ke database
require 'functions.php';
$buku = query("SELECT * FROM buku");

if (isset($_POST["cari"])) {
    $buku = cari($_POST["keyword"]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        .loader {
            width: 30px;
            position: absolute;
            top: 73px;
            left: 960px;
            display: none;
        }
    </style>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/script.js"></script>
    <title>Halaman Admin</title>
</head>

<body>
    <nav class="navbar navbar-light fixed-top mb-4" style="background-color: #99b19c;" `>
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Daftar Buku</a>
            <a class="navbar-brand" href="logout.php">logout</a>
        </div>
    </nav>
    <div class="container">
        <form action="" method="POST" class="d-flex justify-content-end mb-2" style="margin-top: 70px;">
            <img src="img/hug.gif" class="loader" alt="">
            <input id="keyword" class="form-control mr-sm-2" style="width: 20%;margin-right: 0rem !important;" type="text" name="keyword" placeholder="Cari Buku..." aria-label="Search" autocomplete="off">
            <button id="tombol" class="btn btn-outline-success my-2 my-sm-0" type="submit" name="cari">Cari</button>
        </form>
        <div id="container" class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead class="thead-primary">
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Pengarang</th>
                            <th>Tahun</th>
                            <th>Sinopsis</th>
                            <th><a href="tambah.php" class="btn btn-primary btn-sm">Tambah</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($buku as $b) : ?>
                            <tr class="alert" role="alert">
                                <td>
                                    <?php echo $i; ?>
                                </td>
                                <td>
                                    <img src="../gambar buku/<?php echo $b["gambar"]; ?>" height="100" width="70" alt="">
                                </td>
                                <td>
                                    <div class="email"><?php echo $b["judul"]; ?>
                                    </div>
                                </td>
                                <td>
                                    <?php echo $b["pengarang"]; ?>
                                </td>
                                <td>
                                    <?php echo $b["tahun"]; ?>
                                </td>
                                <td>
                                    <?php echo $b["sinopsis"]; ?>
                                </td>
                                <td>
                                    <div style="display: flex;">
                                        <a href="edit.php?id=<?php echo $b["id"]; ?>" class="btn btn-primary btn-sm border-0" style="margin-right:2px"><i class="bi bi-eye"></i></a>
                                        <a href="edit.php?id=<?php echo $b["id"]; ?>" class="btn btn-success btn-sm border-0" style="margin-right:2px"><i class="bi bi-pencil-square"></i></a>
                                        <a href="hapus.php?id=<?php echo $b["id"]; ?>" class="btn btn-danger btn-sm border-0" onclick="return confirm('Yakin?')"><i class="bi bi-x-lg"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++ ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>


    </script>

</body>

</html>