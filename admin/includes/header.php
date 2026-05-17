<?php
if(session_status() === PHP_SESSION_NONE) session_start();
// Mundur satu folder (..) untuk cari config karena kita ada di dalam folder admin
include '../config/database.php';

// CEK KEAMANAN: Cek apakah user sudah login DAN role-nya admin
if (!isset($_SESSION['login_status']) || $_SESSION['role'] != 'admin') {
    header("location: ../login.php?pesan=belum_login");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Rana Florist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    
    <style>
        /* Style Khusus Admin Sidebar */
        .sidebar {
            min-height: 100vh;
            background-color: #fff;
            border-right: 1px solid #eee;
        }
        .admin-link {
            color: #333;
            padding: 10px 15px;
            display: block;
            border-radius: 10px;
            margin-bottom: 5px;
            font-weight: 500;
            text-decoration: none; /* Tambahan biar gak ada garis bawah */
        }
        .admin-link:hover, .admin-link.active {
            background-color: var(--primary-pink);
            color: white;
            text-decoration: none;
        }
        .main-content {
            background-color: #f8f9fa;
            min-height: 100vh;
            padding: 30px;
        }
        /* Icon styling fix */
        .admin-link i {
            width: 25px; /* Biar icon rapi sejajar */
            text-align: center;
        }
    </style>
</head>
<body>

<div class="d-flex">
    <div class="sidebar p-3 d-none d-md-block" style="width: 280px;">
        <h4 class="brand-font text-center mb-4" style="color: var(--primary-pink);">Rana Admin</h4>
        <hr>
        <a href="index.php" class="admin-link"><i class="fas fa-home me-2"></i> Dashboard</a>
        <a href="banner.php" class="admin-link"><i class="fas fa-images me-2"></i> Kelola Banner</a>
        <a href="produk.php" class="admin-link"><i class="fas fa-box me-2"></i> Produk Buket</a>
        <a href="kategori.php" class="admin-link"><i class="fas fa-tags me-2"></i> Kategori</a>
        <a href="testimoni.php" class="admin-link"><i class="fas fa-comment me-2"></i> Testimoni</a>
        
        <a href="faq.php" class="admin-link"><i class="fas fa-question-circle me-2"></i> FAQ</a>
        
        <a href="users.php" class="admin-link"><i class="fas fa-users me-2"></i> Pelanggan</a>
        <hr>
        <a href="../logout.php" class="admin-link text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
    </div>

    <div class="w-100 main-content">
        <nav class="navbar navbar-light bg-white mb-4 shadow-sm d-md-none rounded">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1 brand-font">Rana Admin</span>
                <button class="btn btn-sm btn-outline-danger" onclick="window.location.href='../logout.php'">Logout</button>
            </div>
        </nav>