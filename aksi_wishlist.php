<?php
session_start();
include 'config/database.php';

// 1. Cek Login
if (!isset($_SESSION['user_id'])) {
    // Kalau belum login, kasih alert suruh login
    echo "<script>alert('Login dulu untuk menyimpan favorit!'); window.location='login.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];

// 2. Cek ID Produk
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Cek apakah user ini sudah pernah love produk ini?
    $cek = mysqli_query($conn, "SELECT * FROM wishlist WHERE user_id='$user_id' AND product_id='$product_id'");

    if (mysqli_num_rows($cek) > 0) {
        // JIKA SUDAH ADA -> HAPUS (Un-love)
        mysqli_query($conn, "DELETE FROM wishlist WHERE user_id='$user_id' AND product_id='$product_id'");
        // Kembali ke halaman sebelumnya
        echo "<script>alert('Dihapus dari Favorit!'); window.history.back();</script>";
    } else {
        // JIKA BELUM ADA -> TAMBAH (Love)
        mysqli_query($conn, "INSERT INTO wishlist (user_id, product_id) VALUES ('$user_id', '$product_id')");
        // Kembali ke halaman sebelumnya
        echo "<script>alert('Berhasil masuk Favorit!'); window.history.back();</script>";
    }
} else {
    header("location: index.php");
}
?>