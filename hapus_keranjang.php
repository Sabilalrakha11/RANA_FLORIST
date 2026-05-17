<?php
session_start();
include 'config/database.php';

if(isset($_GET['id']) && isset($_SESSION['user_id'])){
    $cart_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Hapus data (Pastikan yang dihapus milik user yang sedang login biar aman)
    $query = "DELETE FROM cart WHERE id = '$cart_id' AND user_id = '$user_id'";
    
    if(mysqli_query($conn, $query)){
        header("location: keranjang.php");
    } else {
        echo "Gagal menghapus data.";
    }
} else {
    header("location: keranjang.php");
}
?>