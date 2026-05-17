<?php
include '../config/database.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    // 1. Ambil data gambar dulu sebelum dihapus datanya
    $query_gambar = mysqli_query($conn, "SELECT nama_file FROM product_images WHERE product_id='$id'");
    
    // 2. Hapus file fisik di folder uploads
    while($row = mysqli_fetch_assoc($query_gambar)){
        $path_file = "../uploads/" . $row['nama_file'];
        if(file_exists($path_file)){
            unlink($path_file); // unlink = perintah PHP untuk hapus file
        }
    }

    // 3. Hapus data di database (Karena kita pakai FOREIGN KEY CASCADE di tabel product_images, 
    // biasanya hapus products aja otomatis images ilang, tapi kita manual aja biar aman)
    mysqli_query($conn, "DELETE FROM product_images WHERE product_id='$id'");
    $hapus_produk = mysqli_query($conn, "DELETE FROM products WHERE id='$id'");

    if($hapus_produk){
        echo "<script>alert('Produk dan fotonya berhasil dihapus bersih!'); window.location='produk.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus!'); window.location='produk.php';</script>";
    }
}
?>