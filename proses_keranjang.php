<?php
session_start();

// 1. Cek apakah ada data yang dikirim dari Detail Produk?
if(isset($_POST['product_id']) && isset($_POST['qty'])) {
    
    $id_produk = $_POST['product_id'];
    $jumlah    = (int) $_POST['qty']; // Pastikan formatnya angka

    // 2. Masukkan ke dalam Sesi Keranjang
    // Cek dulu: Apakah produk ini sudah ada di keranjang?
    if (isset($_SESSION['keranjang'][$id_produk])) {
        // Kalau sudah ada, jumlahnya ditambah
        $_SESSION['keranjang'][$id_produk] += $jumlah;
    } else {
        // Kalau belum ada, buat baru
        $_SESSION['keranjang'][$id_produk] = $jumlah;
    }

    // 3. Redirect (Lempar) ke Halaman Keranjang
    echo "<script>alert('Produk berhasil masuk keranjang!'); location='keranjang.php';</script>";

} elseif(isset($_GET['id'])) {
    // FITUR TAMBAHAN: Kalau user klik ikon keranjang dari Katalog (Index)
    // Biasanya ini cuma kirim ID tanpa jumlah (default 1)
    
    $id_produk = $_GET['id'];
    
    if (isset($_SESSION['keranjang'][$id_produk])) {
        $_SESSION['keranjang'][$id_produk] += 1;
    } else {
        $_SESSION['keranjang'][$id_produk] = 1;
    }
    
    echo "<script>alert('Produk berhasil masuk keranjang!'); location='keranjang.php';</script>";

} else {
    // Kalau orang iseng buka file ini langsung tanpa lewat form
    header("Location: index.php");
}
?>