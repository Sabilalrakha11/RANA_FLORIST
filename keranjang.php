<?php
session_start();
include 'config/database.php';

// --- 1. LOGIKA HAPUS ITEM ---
if (isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];
    unset($_SESSION['keranjang'][$id_hapus]);
    echo "<script>location='keranjang.php';</script>";
}

// --- 2. LOGIKA UBAH JUMLAH (TAMBAH/KURANG) ---
if (isset($_GET['aksi']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $aksi = $_GET['aksi'];

    if (isset($_SESSION['keranjang'][$id])) {
        if ($aksi == 'tambah') {
            $_SESSION['keranjang'][$id] += 1;
        } elseif ($aksi == 'kurang') {
            $_SESSION['keranjang'][$id] -= 1;
            // Kalau jumlah jadi 0, otomatis hapus
            if ($_SESSION['keranjang'][$id] <= 0) {
                unset($_SESSION['keranjang'][$id]);
            }
        }
    }
    echo "<script>location='keranjang.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Rana Florist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">

    <?php include 'includes/navbar.php'; ?>

    <div class="container mt-5 mb-5">
        <h2 class="brand-font mb-4 text-center">Keranjang Belanja</h2>

        <?php 
        // Cek apakah keranjang kosong?
        if (empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang'])): 
        ?>
            <div class="text-center py-5">
                <i class="bi bi-cart-x text-muted" style="font-size: 5rem; opacity: 0.3;"></i>
                <h4 class="mt-3 text-muted brand-font">Wah, keranjangmu kosong!</h4>
                <p class="text-muted">Yuk isi dengan buket cantik pilihanmu.</p>
                <a href="index.php" class="btn btn-rana px-4 py-2 mt-2">Mulai Belanja</a>
            </div>

        <?php else: ?>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-white text-muted small text-uppercase">
                                    <tr>
                                        <th class="ps-4 py-3" width="40%">Produk</th>
                                        <th class="py-3">Harga</th>
                                        <th class="py-3 text-center">Jumlah</th>
                                        <th class="py-3">Total</th>
                                        <th class="pe-4 py-3 text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $total_belanja = 0;
                                    // Variabel string untuk pesan WA nanti
                                    $pesan_wa_items = ""; 
                                    $nomor = 1;

                                    foreach ($_SESSION['keranjang'] as $id_produk => $jumlah):
                                        // Ambil detail produk dari database
                                        $ambil = mysqli_query($conn, "SELECT * FROM products WHERE id='$id_produk'");
                                        $pecah = mysqli_fetch_assoc($ambil);
                                        
                                        // Hitung subtotal
                                        $subharga = $pecah['harga'] * $jumlah;
                                        $total_belanja += $subharga;

                                        // Ambil gambar (primary)
                                        $q_img = mysqli_query($conn, "SELECT nama_file FROM product_images WHERE product_id='$id_produk' AND is_primary=1");
                                        $img = mysqli_fetch_assoc($q_img);
                                        $gambar = $img ? 'uploads/'.$img['nama_file'] : 'assets/images/no-image.jpg';

                                        // Susun teks untuk WA
                                        $pesan_wa_items .= $nomor++ . ". " . $pecah['nama_produk'] . " (" . $jumlah . "x) - Rp " . number_format($subharga, 0, ',', '.') . "%0A";
                                    ?>
                                    <tr>
                                        <td class="ps-4 py-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="<?= $gambar; ?>" class="rounded-3 shadow-sm border" width="70" height="70" style="object-fit: cover;">
                                                <div>
                                                    <a href="detail.php?id=<?= $pecah['id']; ?>" class="text-dark text-decoration-none fw-bold product-link">
                                                        <?= $pecah['nama_produk']; ?>
                                                    </a>
                                                    <div class="small text-muted d-block d-md-none mt-1">
                                                        Rp <?= number_format($pecah['harga'], 0, ',', '.'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="d-none d-md-table-cell">
                                            Rp <?= number_format($pecah['harga'], 0, ',', '.'); ?>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm border rounded-pill overflow-hidden" role="group">
                                                <a href="keranjang.php?aksi=kurang&id=<?= $id_produk; ?>" class="btn btn-light text-muted px-2 py-1 fw-bold">-</a>
                                                <button type="button" class="btn btn-white bg-white border-start border-end px-3 py-1" style="cursor: default; width: 40px;"><?= $jumlah; ?></button>
                                                <a href="keranjang.php?aksi=tambah&id=<?= $id_produk; ?>" class="btn btn-light text-muted px-2 py-1 fw-bold">+</a>
                                            </div>
                                        </td>
                                        <td class="fw-bold text-pink">
                                            Rp <?= number_format($subharga, 0, ',', '.'); ?>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <a href="keranjang.php?hapus=<?= $id_produk; ?>" class="btn btn-sm btn-outline-danger border-0 rounded-circle p-2" onclick="return confirm('Hapus produk ini?')" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="p-3 bg-white border-top">
                            <a href="index.php" class="text-decoration-none text-muted small">
                                <i class="bi bi-arrow-left me-1"></i> Lanjutkan Belanja
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 100px;">
                        <h5 class="brand-font mb-4">Ringkasan Pesanan</h5>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Total Harga</span>
                            <span class="fw-bold">Rp <?= number_format($total_belanja, 0, ',', '.'); ?></span>
                        </div>
                        <hr class="border-dashed my-3">
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold fs-5">Total Bayar</span>
                            <span class="fw-bold fs-5 text-pink">Rp <?= number_format($total_belanja, 0, ',', '.'); ?></span>
                        </div>

                        <?php 
                        // Persiapkan data user untuk WA
                        $nama_user = $_SESSION['nama'] ?? 'Pelanggan';
                        $wa_text = "Halo Rana Florist, saya mau checkout pesanan dari Website:%0A%0A" . 
                                   "*Nama:* " . $nama_user . "%0A%0A" . 
                                   "*Detail Pesanan:*%0A" . $pesan_wa_items . "%0A" . 
                                   "*Total Bayar:* Rp " . number_format($total_belanja, 0, ',', '.') . "%0A%0A" . 
                                   "Mohon info pembayaran ya kak!";
                        ?>

                        <a href="https://wa.me/6283875810570?text=<?= $wa_text; ?>" target="_blank" class="btn btn btn-rana w-100 py-3 rounded-pill fw-bold shadow-sm hover-up">
                            <i class="bi bi-whatsapp me-2"></i> Checkout via WhatsApp
                        </a>

                        <p class="text-muted small text-center mt-3 mb-0">
                            Kamu akan diarahkan ke WhatsApp Admin untuk konfirmasi pembayaran & ongkir.
                        </p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>