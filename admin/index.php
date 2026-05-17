<?php include 'includes/header.php'; 

// Hitung data ringkasan
$jumlah_produk = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM products"));
$jumlah_user = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE role='user'"));
// $jumlah_pesanan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM orders")); // Nanti kalau tabel order sudah ada
?>

<div class="container-fluid">
    <h2 class="mb-4 brand-font">Halo, Admin Cantik! 👋</h2>
    
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Total Produk</h6>
                        <h3><?= $jumlah_produk; ?> Buket</h3>
                    </div>
                    <i class="fas fa-box fa-3x text-pink" style="color: var(--primary-pink); opacity: 0.5;"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Total Pelanggan</h6>
                        <h3><?= $jumlah_user; ?> Orang</h3>
                    </div>
                    <i class="fas fa-users fa-3x text-info" style="opacity: 0.5;"></i>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Pesanan Baru</h6>
                        <h3>0</h3>
                    </div>
                    <i class="fas fa-shopping-cart fa-3x text-success" style="opacity: 0.5;"></i>
                </div>
            </div>
        </div>
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
                    $q_faq = mysqli_query($conn, "SELECT * FROM faqs");
                    $no = 1;
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