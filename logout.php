<?php
session_start();

// Hapus semua data sesi
session_unset();
session_destroy();

// Kembalikan ke halaman login dengan pesan
header("location: login.php?pesan=logout");
exit;
?>