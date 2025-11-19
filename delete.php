<?php
include("connect.php");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $id = $_GET['id'];
    $stmt = mysqli_prepare($conn, "SELECT * FROM kue WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $row = $stmt->get_result();
    $result = $row->fetch_assoc();

    if ($result) {
        $filepath = "uploads/" . $result['foto'];
    }
    if (file_exists($filepath)) {
        unlink($filepath);
    }
    $stmt = mysqli_prepare($conn, "DELETE FROM kue WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("location:dashboard.php");
}

?>