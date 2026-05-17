<?php
session_start();
include 'config/database.php';

// Cek Login
if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil data Wishlist + Info Produk + Gambar
$query = "SELECT w.id as wishlist_id, p.*, pi.nama_file 
          FROM wishlist w 
          JOIN products p ON w.product_id = p.id 
          JOIN product_images pi ON p.id = pi.product_id 
          WHERE w.user_id = '$user_id' AND pi.is_primary = 1
          ORDER BY w.id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorit Saya - Rana Florist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <?php include 'includes/navbar.php'; ?>

    <div class="container mt-5 mb-5" style="min-height: 60vh;">
        <h2 class="brand-font mb-4 text-center">Buket Favoritmu ❤</h2>

        <div class="row justify-content-center">
            <?php if(mysqli_num_rows($result) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-6 col-md-3 mb-4">
                    <div class="card-product">
                        <div class="card-img-wrapper">
                            <a href="detail.php?id=<?= $row['id']; ?>">
                                <img src="uploads/<?= $row['nama_file']; ?>" alt="<?= $row['nama_produk']; ?>">
                            </a>
                        </div>
                        
                        <div class="card-body">
                            <a href="detail.php?id=<?= $row['id']; ?>" class="product-title"><?= $row['nama_produk']; ?></a>
                            <div class="product-price">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></div>
                            
                            <div class="d-flex justify-content-center mt-2">
                                <a href="aksi_wishlist.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3 me-2">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
                                <a href="proses_keranjang.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-rana rounded-pill px-3">
                                    <i class="bi bi-cart-plus"></i> Beli
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="bi bi-heart-break display-1 text-muted mb-3 d-block"></i>
                    <h4>Belum ada yang kamu suka.</h4>
                    <p>Jangan ragu untuk memberikan cinta pada buket kami!</p>
                    <a href="index.php" class="btn btn-rana mt-2">Cari Buket</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

</body>
</html>