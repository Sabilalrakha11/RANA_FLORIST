<?php
session_start();
include 'config/database.php';

// Cek apakah ada ID di URL
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id_produk = $_GET['id'];

// 1. Ambil Data Produk
$queryProduct = mysqli_query($conn, "SELECT * FROM products WHERE id = '$id_produk'");
$produk = mysqli_fetch_assoc($queryProduct);

// Jika produk tidak ditemukan
if (!$produk) {
    echo "Produk tidak ditemukan.";
    exit;
}

// 2. Ambil SEMUA Gambar Produk tersebut
$queryImages = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = '$id_produk'");
$images = [];
while ($row = mysqli_fetch_assoc($queryImages)) {
    $images[] = $row;
}

// 3. Tentukan Gambar Utama
$main_image = 'assets/images/no-image.jpg';
if (count($images) > 0) {
    $main_image = 'uploads/' . $images[0]['nama_file'];
    foreach ($images as $img) {
        if ($img['is_primary'] == 1) {
            $main_image = 'uploads/' . $img['nama_file'];
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $produk['nama_produk']; ?> - Rana Florist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <?php include 'includes/navbar.php'; ?>

    <div class="container mt-5 mb-5">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="link-pink">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $produk['nama_produk']; ?></li>
            </ol>
        </nav>

        <div class="row">
    <div class="col-md-6 mb-4">
        <!-- EDIT: Tambahkan id="zoom-container" di sini -->
        <div id="zoom-container" class="main-img-container mb-3 text-center rounded-3 shadow-sm zoom-wrapper">
            <img id="mainImg" src="<?= $main_image; ?>" class="img-fluid" style="max-height: 500px; width: 100%; object-fit: cover;">
        </div>
        
        <div class="d-flex gap-2 justify-content-center">
            <?php foreach ($images as $img): ?>
                <div class="thumbnail-container">
                    <img src="uploads/<?= $img['nama_file']; ?>" 
                            class="img-thumbnail" 
                            style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;"
                            onclick="document.getElementById('mainImg').src=this.src">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- Penutup col-md-6 dll... -->

            <div class="col-md-6">
                <h1 class="brand-font display-6" style="color: var(--text-dark);"><?= $produk['nama_produk']; ?></h1>
                
                <h2 class="mb-3" style="color: var(--primary-pink);">Rp <?= number_format($produk['harga'], 0, ',', '.'); ?></h2>
                
                <div class="p-3 bg-light rounded mb-3" style="font-size: 14px;">
                    <div class="row">
                        <div class="col-4 text-muted">Dimensi</div>
                        <div class="col-8 fw-bold text-dark">: <?= $produk['dimensi']; ?></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 text-muted">Stok</div>
                        <div class="col-8 fw-bold text-dark">: <?= $produk['stok']; ?> Buah</div>
                    </div>
                </div>

                <div class="mb-4">
                    <h5 class="brand-font">Deskripsi Produk</h5>
                    <p class="text-muted" style="text-align: justify;">
                        <?= nl2br($produk['deskripsi']); ?>
                    </p>
                </div>
                
                <hr>

                <form action="proses_keranjang.php" method="POST">
                    <input type="hidden" name="product_id" value="<?= $produk['id']; ?>">
                    
                    <div class="d-flex align-items-center gap-2 mt-4 flex-wrap">
                        
                        <div class="input-group" style="width: 140px;">
                            <button type="button" class="btn btn-outline-secondary" onclick="ubahJumlah(-1)">-</button>
                            <input type="number" id="inputQty" name="qty" class="form-control text-center border-secondary" value="1" min="1" max="<?= $produk['stok']; ?>" readonly>
                            <button type="button" class="btn btn-outline-secondary" onclick="ubahJumlah(1)">+</button>
                        </div>

                        <?php if(isset($_SESSION['user_id'])): ?>
                            
                            <button type="submit" class="btn btn-rana flex-grow-1 py-2">
                                <i class="bi bi-cart-plus"></i> Cart
                            </button>

                            <button type="button" class="btn btn-success flex-grow-1 py-2" data-bs-toggle="modal" data-bs-target="#modalPesan">
                                <i class="bi bi-whatsapp"></i> Pesan
                            </button>

                            <a href="aksi_wishlist.php?id=<?= $produk['id']; ?>" class="btn btn-rana-outline px-3" title="Favorit">
                                <i class="bi bi-heart"></i>
                            </a>

                        <?php else: ?>
                            <a href="login.php" class="btn btn-rana flex-grow-1 py-2">Login untuk Membeli</a>
                        <?php endif; ?>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalPesan" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title"><i class="bi bi-whatsapp"></i> Form Pemesanan</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="formWA">
                <div class="mb-3">
                    <label class="form-label text-muted small">Nama Pemesan</label>
                    <input type="text" id="wa_nama" class="form-control" value="<?= $_SESSION['nama'] ?? ''; ?>" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-muted small">Produk</label>
                    <input type="text" class="form-control bg-light" value="<?= $produk['nama_produk']; ?>" readonly>
                </div>

                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label text-muted small">Jumlah</label>
                        <input type="number" id="wa_qty" class="form-control" value="1" readonly>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label text-muted small">Metode Ambil</label>
                        <select id="wa_metode" class="form-select">
                            <option value="Ambil Sendiri">Ambil ke Rumah</option>
                            <option value="COD / Kurir">COD / Kurir</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted small">Catatan / Ucapan (Kartu Ucapan)</label>
                    <textarea id="wa_catatan" class="form-control" rows="3" placeholder="Tulis ucapan untuk di kartu..."></textarea>
                </div>

                <button type="button" onclick="kirimWhatsApp()" class="btn btn-success w-100 fw-bold">
                    Kirim Pesanan ke WhatsApp <i class="bi bi-send"></i>
                </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="container mb-5">
        <hr class="mb-5"> <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="brand-font" style="font-size: 1.5rem;">Mungkin Kamu Juga Suka</h3>
            <a href="index.php" class="text-pink text-decoration-none small fw-bold">Lihat Semua <i class="bi bi-arrow-right"></i></a>
        </div>
        
        <div class="row">
            <?php
            // 1. Ambil Kategori Produk yang sedang dilihat
            $kategori_saat_ini = $produk['category_id'];
            $id_produk_saat_ini = $produk['id'];

            // 2. Cari produk lain dengan Kategori SAMA, tapi BUKAN produk ini (Limit 4, Acak)
            $query_related = mysqli_query($conn, "SELECT * FROM products WHERE category_id = '$kategori_saat_ini' AND id != '$id_produk_saat_ini' ORDER BY RAND() LIMIT 4");

            if(mysqli_num_rows($query_related) > 0):
                while($rel = mysqli_fetch_assoc($query_related)):
                    
                    // Ambil Gambar Utama Produk Terkait
                    $id_rel = $rel['id'];
                    $q_img_rel = mysqli_query($conn, "SELECT nama_file FROM product_images WHERE product_id='$id_rel' AND is_primary=1");
                    
                    if(mysqli_num_rows($q_img_rel) == 0){
                        // Fallback kalau gak ada primary, ambil random 1
                        $q_img_rel = mysqli_query($conn, "SELECT nama_file FROM product_images WHERE product_id='$id_rel' LIMIT 1");
                    }
                    
                    $img_rel_data = mysqli_fetch_assoc($q_img_rel);
                    $gambar_rel = $img_rel_data ? 'uploads/'.$img_rel_data['nama_file'] : 'assets/images/no-image.jpg';
            ?>
            
            <div class="col-6 col-md-3 mb-4">
                <div class="card-product">
                    <div class="card-img-wrapper">
                        <a href="detail.php?id=<?= $rel['id']; ?>">
                            <img src="<?= $gambar_rel; ?>" alt="<?= $rel['nama_produk']; ?>">
                        </a>
                    </div>
                    
                    <div class="card-body">
                        <a href="detail.php?id=<?= $rel['id']; ?>" class="product-title"><?= $rel['nama_produk']; ?></a>
                        <div class="product-price">Rp <?= number_format($rel['harga'], 0, ',', '.'); ?></div>
                        
                        <div class="d-flex justify-content-center">
                             <a href="aksi_wishlist.php?id=<?= $rel['id']; ?>" class="action-btn" title="Favorit">
                                <i class="bi bi-heart"></i>
                            </a>
                            <a href="detail.php?id=<?= $rel['id']; ?>" class="action-btn" title="Lihat Detail">
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12 text-muted small text-center">Belum ada produk lain di kategori ini.</div>
            <?php endif; ?>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // 1. Script Tombol Tambah/Kurang Jumlah
        function ubahJumlah(nilai) {
            var input = document.getElementById('inputQty');
            var inputModal = document.getElementById('wa_qty'); // Input di dalam Modal
            var stokMaks = <?= $produk['stok']; ?>;
            var angkaSekarang = parseInt(input.value);
            var hasil = angkaSekarang + nilai;

            if (hasil >= 1 && hasil <= stokMaks) {
                input.value = hasil;
                inputModal.value = hasil; // Update juga angka di pop-up WA biar sinkron
            }
        }

        // 2. Script Kirim WhatsApp
        function kirimWhatsApp() {
            // Ambil data dari form modal
            var nama = document.getElementById('wa_nama').value;
            var produk = "<?= $produk['nama_produk']; ?>";
            var qty = document.getElementById('wa_qty').value;
            var metode = document.getElementById('wa_metode').value;
            var catatan = document.getElementById('wa_catatan').value;
            
            // --- GANTI NOMOR INI DENGAN NOMOR WA PACAR KAMU ---
            var nomorHP = "6283875810570"; 
            // --------------------------------------------------

            // Format Pesan Rapi
            var pesan = "Halo Rana Florist, saya mau pesan:%0A" +
                        "--------------------------------%0A" +
                        "*Nama:* " + nama + "%0A" +
                        "*Produk:* " + produk + "%0A" +
                        "*Jumlah:* " + qty + " Buah%0A" +
                        "*Metode:* " + metode + "%0A" +
                        "*Catatan:* " + (catatan ? catatan : "-") + "%0A" +
                        "--------------------------------%0A" +
                        "Mohon diproses ya kak!";

            // Buka WhatsApp
            var link = "https://wa.me/" + nomorHP + "?text=" + pesan;
            window.open(link, '_blank');
        }
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const container = document.getElementById("zoom-container");
        const img = document.getElementById("mainImg");

        container.addEventListener("mousemove", function(e) {
            // Ambil ukuran dan posisi container gambar
            const rect = container.getBoundingClientRect();
            
            // Hitung posisi mouse di dalam gambar
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            // Ubah ke persentase (%)
            const xPercent = (x / rect.width) * 100;
            const yPercent = (y / rect.height) * 100;
            
            // Pindahkan titik pusat zoom ke persentase posisi mouse
            img.style.transformOrigin = `${xPercent}% ${yPercent}%`;
        });

        // Balikin zoom ke tengah kalau mouse keluar dari gambar
        container.addEventListener("mouseleave", function() {
            img.style.transformOrigin = "center center";
        });
    });
</script>
</body>
</html>