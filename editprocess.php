<?php
include("connect.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];


    if ($_FILES['foto']['size'] > 0) {
        $file = $_FILES['foto']['name'];
        $ekstensi_available = array('png', 'jpg');
        $x = explode('.', $file);
        $ekstensi = strtolower(end($x));
        $ukuran = $_FILES['foto']['size'];
        $file_tmp = $_FILES['foto']['tmp_name'];
        if (in_array($ekstensi, $ekstensi_available)) {
            if ($ukuran < 1044070) {
                move_uploaded_file($file_tmp, 'uploads/' . $file);
            } else {
                echo ("Ukurane terlalu besar");
            }
        } else {
            echo ("Ekstensi file yang diupload tidak diperbolehkan");
        }
    } else {
        $file = $_POST['foto_lama'];
    }



    $query = mysqli_prepare($conn, "UPDATE kue SET nama=?,harga=?,stok=?,foto=? WHERE id=?");
    $query->bind_param("siisi", $nama, $harga, $stok, $file, $id);
    if ($query->execute()) {
        echo ("Kue berhasil di Update");
        header("location:dashboard.php");
    } else {
        echo ("Gagal menambahkan kue");
    }
}