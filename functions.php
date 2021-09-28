<?php
// menghubungkan ke database
$db = mysqli_connect("localhost", "root", "", "php_dasar");

function query($query)
{
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($buku)
{
    global $db;

    $judul = htmlspecialchars($buku["judul"]);
    $pengarang = htmlspecialchars($buku["pengarang"]);
    $tahun = htmlspecialchars($buku["tahun"]);
    $sinopsis = htmlspecialchars($buku["sinopsis"]);

    // upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO buku
                VALUES
                ('', '$judul', '$pengarang', '$tahun', '$sinopsis', '$gambar')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


function hapus($id)
{
    global $db;
    $query = "DELETE FROM buku WHERE id = $id";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function edit($buku)
{
    global $db;

    $id = $buku["id"];
    $judul = htmlspecialchars($buku["judul"]);
    $pengarang = htmlspecialchars($buku["pengarang"]);
    $tahun = htmlspecialchars($buku["tahun"]);
    $sinopsis = htmlspecialchars($buku["sinopsis"]);
    $gambarLama = htmlspecialchars($buku["gambarLama"]);

    // upload gambar
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }
    $query = "UPDATE buku SET
            judul = '$judul',
            pengarang = '$pengarang',
            tahun = '$tahun',
            sinopsis = '$sinopsis',
            gambar = '$gambar'
            WHERE id = $id";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function cari($keyword)
{
    $query = "SELECT * FROM buku
                WHERE
            judul LIKE '%$keyword%'
            ";
    return query($query);
}

function upload()
{
    $namaFIle = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak aa gambar yg diupload
    if ($error === 4) {
        echo "<script>alert('pilih gambar dulu')</script>";
        return false;
    }

    // cek file
    $extensigambarvalid = ['jpg', 'jpeg', 'png'];
    $extensigambar = explode('.', $namaFIle);
    $extensigambar = strtolower(end($extensigambar));
    if (!in_array($extensigambar, $extensigambarvalid)) {
        echo "<script>alert('yang anda upload bukan gambar')</script>";
        return false;
    }

    // cek ukuran file

    $namaFIleBaru = uniqid();
    $namaFIleBaru .= '.';
    $namaFIleBaru .= $extensigambar;

    if ($ukuranFile > 1000000) {
        echo "<script>alert('Ukuran gambar terlalu besar')</script>";
        return false;
    }

    // gambar siap upload
    move_uploaded_file($tmpName, '../gambar buku/' . $namaFIleBaru);

    return $namaFIleBaru;
}

function registrasi($data)
{
    global $db;

    $username = strtolower(stripcslashes($data["username"]));
    $email = $data["email"];
    $password = mysqli_real_escape_string($db, $data["password"]);

    $password = password_hash($password, PASSWORD_DEFAULT);

    // cek username/email udah ada atau belum

    $result = mysqli_query($db, "SELECT username FROM user 
        WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script> 
                alert('username/email sudah ada')
            </script>";
        return false;
    }

    mysqli_query($db, "INSERT INTO user
                    VALUES('', '$username', '$email', '$password')");
    return mysqli_affected_rows($db);
}
