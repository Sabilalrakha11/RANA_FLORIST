<?php
session_start();
include 'config/database.php';

// 1. LOGIKA FILTER KATEGORI
// Cek apakah user mengklik kategori tertentu?
$kategori_id = isset($_GET['kategori']) ? $_GET['kategori'] : '';

if($kategori_id){
    // Jika ada filter, ambil produk sesuai kategori
    $query_produk = "SELECT p.*, pi.nama_file 
                     FROM products p 
                     JOIN product_images pi ON p.id = pi.product_id 
                     WHERE pi.is_primary = 1 AND p.category_id = '$kategori_id'
                     ORDER BY p.id DESC";
} else {
    // Jika tidak ada filter, ambil semua
    $query_produk = "SELECT p.*, pi.nama_file 
                     FROM products p 
                     JOIN product_images pi ON p.id = pi.product_id 
                     WHERE pi.is_primary = 1 
                     ORDER BY p.id DESC";
}
$result = mysqli_query($conn, $query_produk);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rana Florist - Buket Cantik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <?php include 'includes/navbar.php'; ?>

    <div class="container mt-4 mb-5">
        <div class="swiper mySwiper rounded-4 shadow-sm overflow-hidden">
            <div class="swiper-wrapper">
                <?php 
                // Cek apakah ada banner di database?
                $q_banner = mysqli_query($conn, "SELECT * FROM banners ORDER BY id DESC");
                
                if(mysqli_num_rows($q_banner) > 0):
                    // JIKA ADA: Tampilkan banner dari database
                    while($b = mysqli_fetch_assoc($q_banner)):
                ?>
                    <div class="swiper-slide">
                        <img src="uploads/<?= $b['gambar']; ?>" alt="Banner Promo" style="width: 100%; height: 350px; object-fit: cover;">
                    </div>
                <?php 
                    endwhile;
                else:
                    // JIKA KOSONG: Tampilkan banner default bawaan
                ?>
                    <div class="swiper-slide"><img src="assets/images/banner1.jpg" alt="Default 1" style="width: 100%; height: 350px; object-fit: cover;"></div>
                    <div class="swiper-slide"><img src="assets/images/banner2.jpg" alt="Default 2" style="width: 100%; height: 350px; object-fit: cover;"></div>
                <?php endif; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <div class="container mb-5" id="katalog">
        <div class="text-center mb-4">
            <h2 class="brand-font display-6">Koleksi Buket</h2>
            <p class="text-muted">Pilih kategori favoritmu</p>
        </div>

        <div class="category-scroll mb-5">
            <a href="index.php" class="cat-pill <?= ($kategori_id == '') ? 'active' : ''; ?>">
                Semua
            </a>
            
            <?php 
            // Ambil Kategori dari Database agar dinamis
            $q_kat = mysqli_query($conn, "SELECT * FROM categories");
            while($k = mysqli_fetch_assoc($q_kat)):
            ?>
                <a href="index.php?kategori=<?= $k['id']; ?>#katalog" 
                   class="cat-pill <?= ($kategori_id == $k['id']) ? 'active' : ''; ?>">
                   <?= $k['nama_kategori']; ?>
                </a>
            <?php endwhile; ?>
        </div>

        <div class="row">
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
                            
                            <div class="d-flex justify-content-center">
                                <?php if(isset($_SESSION['user_id'])): ?>
                                    
                                    <a href="aksi_wishlist.php?id=<?= $row['id']; ?>" class="action-btn" title="Favorit">
                                        <i class="bi bi-heart"></i>
                                    </a>
                                    
                                    <a href="proses_keranjang.php?id=<?= $row['id']; ?>" class="action-btn" title="Masukkan Keranjang">
                                        <i class="bi bi-cart-plus"></i>
                                    </a>

                                <?php else: ?>
                                    <a href="login.php" class="action-btn"><i class="bi bi-heart"></i></a>
                                    <a href="login.php" class="action-btn"><i class="bi bi-cart-plus"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Belum ada produk di kategori ini.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

<div class="container mb-5 mt-5" id="testimoni">
        <div class="text-center mb-5">
            <h2 class="brand-font display-6">Apa Kata Mereka?</h2>
            <p class="text-muted">Cerita bahagia dari pelanggan setia Rana Florist</p>
        </div>

        <div class="testimonial-scroll-wrapper">
            <?php 
            // Opsional: Kamu bisa ubah LIMIT 3 jadi LIMIT 5 atau 10 biar efek scrollnya lebih panjang
            $q_testi = mysqli_query($conn, "SELECT * FROM testimonials ORDER BY id DESC LIMIT 5");
            if(mysqli_num_rows($q_testi) > 0):
                while($t = mysqli_fetch_assoc($q_testi)):
            ?>
            
            <div class="testimonial-scroll-card">
                <div class="card border-0 shadow-sm h-100 p-3 text-center" style="border-radius: 20px;">
                    <div class="card-body">
                        <img src="uploads/<?= $t['foto_pelanggan']; ?>" 
                             class="rounded-circle mb-3 shadow-sm" 
                             width="80" height="80" 
                             style="object-fit: cover; border: 3px solid var(--bg-soft);">
                        
                        <h5 class="brand-font mb-1"><?= $t['nama_pelanggan']; ?></h5>
                        
                        <div class="text-warning mb-3 small">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>

                        <p class="text-muted fst-italic">
                            "<?= $t['isi_testimoni']; ?>"
                        </p>
                    </div>
                </div>
            </div>
            
            <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12 text-center text-muted w-100">
                    <p>Belum ada testimoni yang ditampilkan.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="container mb-5 mt-5" id="faq">
        <div class="text-center mb-4">
            <h2 class="brand-font display-6">Sering Ditanyakan</h2>
            <p class="text-muted">Jawaban cepat untuk pertanyaanmu</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="accordion shadow-sm" id="accordionFAQ" style="border-radius: 10px; overflow: hidden;">
                    
                    <?php 
                    // Mengambil data dari tabel faqs
                    $q_faq = mysqli_query($conn, "SELECT * FROM faqs");
                    
                    if(mysqli_num_rows($q_faq) > 0):
                        while($faq = mysqli_fetch_assoc($q_faq)):
                            $collapseID = "collapse" . $faq['id'];
                            $headingID = "heading" . $faq['id'];
                    ?>
                    
                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header" id="<?= $headingID; ?>">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $collapseID; ?>" aria-expanded="false" style="color: var(--text-dark);">
                                <?= $faq['pertanyaan']; ?>
                            </button>
                        </h2>
                        <div id="<?= $collapseID; ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body text-muted bg-light" style="font-size: 15px;">
                                <?= nl2br($faq['jawaban']); ?>
                            </div>
                        </div>
                    </div>

                    <?php endwhile; ?>
                    <?php else: ?>
                        <div class="p-4 text-center text-muted">Belum ada pertanyaan yang ditampilkan.</div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            pagination: { el: ".swiper-pagination", clickable: true },
            loop: true, autoplay: { delay: 3000 },
        });
    </script>
</body>
</html>