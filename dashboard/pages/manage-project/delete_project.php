<?php
// pages/itemabcd2/delete_itemabcd2.php

session_start();
include '../../includes/config.php';

// Pastikan user telah login sebelum mengakses halaman dashboard
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}


if(isset($_GET['id'])) {
    $itemabcd2_id = $_GET['id'];

    // Lakukan proses penghapusan proyek dari database
    $sql = "DELETE FROM gtkprofileProjectTable WHERE id = $itemabcd2_id";

    if(mysqli_query($conn, $sql)) {
        header('Location: ../dashboard.php');
        exit();
    } else {
        echo "Gagal menghapus proyek: " . mysqli_error($conn);
    }
} else {
    echo "ID proyek tidak diberikan.";
}

mysqli_close($conn);
?>
