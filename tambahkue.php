<?php
session_start();

include("connect.php");
if (empty($_SESSION['username'])) {
    header("location:login.php?pesan=loginfirst");
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $file = $_FILES['foto']['name'];

    $ekstensi_available = array('png', 'jpg');
    $x = explode('.', $file);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['foto']['size'];
    $file_tmp = $_FILES['foto']['tmp_name'];
    if (in_array($ekstensi, $ekstensi_available)) {
        if ($ukuran < 1044070) {
            move_uploaded_file($file_tmp, 'uploads/' . $file);
            $query = mysqli_prepare($conn, "INSERT INTO kue (nama,harga,stok,foto) VALUES(?,?,?,?)");
            $query->bind_param("siis", $nama, $harga, $stok, $file);
            if ($query->execute()) {
                echo ("Kue berhasil ditambahkan");
                header("location:dashboard.php");
            } else {
                echo ("Gagal menambahkan kue");
            }
        } else {
            echo ("Ukurane terlalu besar");
        }
    } else {
        echo ("Ekstensi file yang diupload tidak diperbolehkan");
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Kue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            width: 80%;
            margin: 0 auto;
            margin-top: 5%;
        }

        .form {
            width: 50%;
            margin: 0 auto;
            box-shadow: 0px 0px 10px rgba(26, 26, 26, 0.22);
            padding: 40px;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="form">
        <h4>Tambah Kue</h4>

        
        <form action="" method="POST" enctype="multipart/form-data">

            <div class="mb-3">
                <label class="form-label">Foto</label>
                <input class="form-control" type="file" id="formFile" name="foto" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Kue</label>
                <input type="text" class="form-control" name="nama" placeholder="Nama Kue" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" class="form-control" name="harga" placeholder="Harga" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" class="form-control" name="stok" placeholder="Stok" required>
            </div>

            <div class="other mt-3">
                <button type="submit" class="btn btn-primary">Tambah</button>
                <a class="btn btn-secondary" href="dashboard.php">Kembali</a>
            </div>

        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
