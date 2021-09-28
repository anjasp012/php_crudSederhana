<?php
usleep(500000);
require '../functions.php';
$keyword = $_GET["keyword"];
$query = "SELECT * FROM buku
                WHERE
            judul LIKE '%$keyword%'
            ";
$buku = query($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
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
</body>

</html>