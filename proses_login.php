<?php
session_start();
include 'config/database.php';

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = $_POST['password'];

// Cek User di Database
$query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$cek = mysqli_num_rows($query);

if($cek > 0){
    $data = mysqli_fetch_assoc($query);
    
    // Verifikasi Password Hash
    // (Asumsi saat register nanti pakai password_hash)
    if(password_verify($password, $data['password'])){
        
        // Buat Session
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['role'] = $data['role']; // 'admin' atau 'user'
        $_SESSION['login_status'] = true;

        // Cek Role untuk redirect
        if($data['role'] == 'admin'){
            header("location: admin/index.php");
        } else {
            header("location: index.php");
        }
    } else {
        // Password Salah
        header("location: login.php?pesan=gagal");
    }
} else {
    // Email tidak ditemukan
    header("location: login.php?pesan=gagal");
}
?>