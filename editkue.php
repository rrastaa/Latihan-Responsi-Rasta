<?php
session_start();
include("connect.php");
if (empty($_SESSION['username'])) {
    header("location:login.php?pesan=loginfirst");
}
$id_kue = $_GET['id'];

$stmt = mysqli_query($conn, "SELECT * FROM kue WHERE id='$id_kue'");
$produk = $stmt->fetch_assoc();
?>

<!doctype html>
<html lang="en">

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Kue</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f5f5;
            padding-top: 40px;
        }
        .card {
            max-width: 600px;
            margin: auto;
            border-radius: 12px;
        }
        .preview-img {
            width: 100%;
            border-radius: 8px;
            object-fit: cover;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="card shadow p-4">
        <h3 class="text-center mb-3">Edit Kue</h3>

        <form action="editprocess.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= $produk['id'] ?>">
            <input type="hidden" name="foto_lama" value="<?= htmlspecialchars($produk['foto']) ?>">

            <!-- FOTO LAMA -->
            <label class="form-label fw-bold">Foto Lama</label>
            <img src="uploads/<?= htmlspecialchars($produk['foto']) ?>" class="preview-img mb-3" height="200">

            <!-- FOTO BARU -->
            <div class="mb-3">
                <label class="form-label fw-bold">Foto Baru</label>
                <input class="form-control" type="file" name="foto">
            </div>

            <!-- NAMA -->
            <div class="mb-3">
                <label class="form-label fw-bold">Nama Kue</label>
                <input type="text" class="form-control" name="nama" 
                       value="<?= htmlspecialchars($produk['nama']) ?>" required>
            </div>

            <!-- HARGA -->
            <div class="mb-3">
                <label class="form-label fw-bold">Harga</label>
                <input type="number" class="form-control" name="harga" 
                       value="<?= htmlspecialchars($produk['harga']) ?>" required>
            </div>

            <!-- STOK -->
            <div class="mb-4">
                <label class="form-label fw-bold">Stok</label>
                <input type="number" class="form-control" name="stok" 
                       value="<?= htmlspecialchars($produk['stok']) ?>" required>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-warning px-4">Simpan</button>
                <a href="dashboard.php" class="btn btn-secondary px-4">Kembali</a>
            </div>

        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>