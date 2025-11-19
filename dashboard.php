<?php
include('connect.php');
session_start();

if (empty($_SESSION['username'])) {
    header('location: login.php?err=loginfirst');
}
$query = mysqli_query($conn, "SELECT * FROM kue");
$results = [];
while ($row = $query->fetch_assoc()) {
    $results[] = $row;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            width: 80%;
            margin: 0 auto;
            margin-top: 2%;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            align-items: center;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(15rem, 1fr));
            gap: 45px;
        }

        .tambah {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="topbar">
        <h4>Katalog Kue</h4>
        <a href="logout.php" class="btn btn-danger">Log Out</a>
    </div>

    <div class="grid">
        <?php foreach ($results as $result): ?>
            <div class="card" style="width: 18rem;">
                <img src="uploads/<?= htmlspecialchars($result['foto']) ?>" class="card-img-top" style="height:200px; object-fit:cover;">

                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($result['nama']) ?></h5>
                    <p class="card-text">Harga : <?= htmlspecialchars($result['harga']) ?></p>
                    <p class="card-text">Stock : <?= htmlspecialchars($result['stok']) ?></p>
                    <a href="editkue.php?id=<?= htmlspecialchars($result['id']) ?>" class="btn btn-warning">Edit</a>
                    <a href="delete.php?id=<?= htmlspecialchars($result['id']) ?>" class="btn btn-danger">Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="tambah">
        <a class="btn btn-primary" href="tambahkue.php" role="button">Tambah</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>