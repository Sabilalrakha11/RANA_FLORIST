<?php
include 'config/database.php';

// Ambil data dari form
$nama = mysqli_real_escape_string($conn, $_POST['nama']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password_input = $_POST['password'];

// Cek apakah email sudah terdaftar sebelumnya?
$cek_email = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
if(mysqli_num_rows($cek_email) > 0){
    // Jika email sudah ada, kembalikan ke register dengan pesan error
    echo "<script>alert('Email sudah terdaftar! Silakan gunakan email lain.'); window.location='register.php';</script>";
    exit;
}

// Enkripsi Password (Biar aman, jadi admin pun gabisa baca password user)
$password_hashed = password_hash($password_input, PASSWORD_DEFAULT);

// Masukkan ke Database (Role otomatis 'user')
$query = "INSERT INTO users (nama, email, password, role) VALUES ('$nama', '$email', '$password_hashed', 'user')";

if(mysqli_query($conn, $query)){
    // Jika berhasil, arahkan ke login
    echo "<script>alert('Pendaftaran Berhasil! Silakan Login.'); window.location='login.php';</script>";
} else {
    // Jika gagal
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
?>