<footer class="text-center text-lg-start mt-5" style="border-top: 5px solid var(--primary-pink); background-color: #fff;">
    <div class="container p-4 mt-4">
        <div class="row">
            
            <div class="col-lg-5 col-md-12 mb-4 mb-md-0 text-start">
                <h5 class="text-uppercase brand-font" style="color: var(--primary-pink); font-weight: 700;">RANA FLORIST</h5>
                <p class="text-muted mb-4" style="font-size: 14px; line-height: 1.8;">
                    Menyediakan buket bunga segar, buket uang, dan buket snack untuk momen spesialmu. 
                    Dibuat dengan cinta dan ketelitian untuk orang tercinta.
                </p>

                <h6 class="text-uppercase fw-bold mb-3" style="font-size: 13px; color: #333;">METODE PEMBAYARAN:</h6>
                
                <div class="payment-marquee-wrapper">
                    <div class="payment-marquee-content">
                        <!-- Gunakan link .svg asli, bukan hasil convert /thumb/ -->
                        <img src="https://upload.wikimedia.org/wikipedia/commons/7/72/Logo_dana_blue.svg" alt="Dana">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/8/86/Gopay_logo.svg" alt="Gopay">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/e/eb/Logo_ovo_purple.svg" alt="OVO">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/f/fe/Shopee.svg" alt="ShopeePay">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo_QRIS.svg" alt="QRIS">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/9/9e/ALFAMART_LOGO_BARU.png" alt="Alfamart">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/9/9d/Logo_Indomaret.png" alt="Indomaret">

                        <!-- Duplikat untuk efek marquee -->
                        <img src="https://upload.wikimedia.org/wikipedia/commons/7/72/Logo_dana_blue.svg" alt="Dana">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/8/86/Gopay_logo.svg" alt="Gopay">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/e/eb/Logo_ovo_purple.svg" alt="OVO">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/f/fe/Shopee.svg" alt="ShopeePay">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo_QRIS.svg" alt="QRIS">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/9/9e/ALFAMART_LOGO_BARU.png" alt="Alfamart">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/9/9d/Logo_Indomaret.png" alt="Indomaret">
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 mb-md-0 text-start">
                <h5 class="text-uppercase fw-bold mb-3" style="font-size: 14px;">MENU</h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><a href="index.php" class="text-secondary text-decoration-none">Home</a></li>
                    <li class="mb-2"><a href="index.php#katalog" class="text-secondary text-decoration-none">Katalog Buket</a></li>
                    <li class="mb-2"><a href="index.php#testimoni" class="text-secondary text-decoration-none">Testimoni</a></li>
                    <li class="mb-2"><a href="index.php#faq" class="text-secondary text-decoration-none">FAQ</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-6 mb-4 mb-md-0 text-start">
                <h5 class="text-uppercase fw-bold mb-3" style="font-size: 14px;">HUBUNGI KAMI</h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2 text-secondary"><i class="bi bi-geo-alt-fill text-pink me-2"></i> Kedokan Bunder, Indramayu, Indonesia</li>
                    <li class="mb-2 text-secondary"><i class="bi bi-whatsapp text-pink me-2"></i> +62 812 3456 7890</li>
                    <li class="mb-2 text-secondary"><i class="bi bi-envelope-fill text-pink me-2"></i> rana@florist.com</li>
                </ul>

                <h5 class="text-uppercase fw-bold mt-4 mb-3" style="font-size: 14px;">IKUTI KAMI</h5>
                <div class="d-flex gap-3">
                    <a href="https://instagram.com/lookitrana23/" target="_blank" class="text-secondary text-decoration-none" style="font-size: 1.5rem;">
                        <i class="bi bi-instagram text-pink"></i>
                    </a>
                    <a href="https://tiktok.com" target="_blank" class="text-secondary text-decoration-none" style="font-size: 1.5rem;">
                        <i class="bi bi-tiktok text-pink"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="text-center p-3 text-white" style="background-color: var(--primary-pink);">
        © 2025 Rana Florist - All Rights Reserved
    </div>
</footer>

<style>
    /* CSS untuk Efek Running Logo */
    .payment-marquee-wrapper {
        width: 100%;
        overflow: hidden; 
        background: #f9f9f9;
        padding: 15px 0;
        border-radius: 10px;
        border: 1px solid #eee;
        position: relative;
    }

    .payment-marquee-content {
        display: flex;
        width: 200%; 
        animation: scrollPayment 20s linear infinite; 
    }

    .payment-marquee-content img {
        height: 25px; 
        margin: 0 20px; 
        object-fit: contain;
        filter: grayscale(100%); 
        opacity: 0.7;
        transition: 0.3s;
    }

    .payment-marquee-content:hover img {
        filter: grayscale(0%);
        opacity: 1;
    }
    
    .payment-marquee-wrapper:hover .payment-marquee-content {
        animation-play-state: paused;
    }

    @keyframes scrollPayment {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); } 
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<a href="https://wa.me/6283875810570?text=Halo%20Rana%20Florist,%20saya%20tertarik%20dengan%20produk%20buketnya..." class="floating-wa" target="_blank" title="Chat WhatsApp">
    <i class="bi bi-whatsapp"></i>
</a>

<style>
    /* CSS Tombol WA Melayang */
    .floating-wa {
        position: fixed;
        bottom: 30px;       /* Jarak dari bawah */
        right: 30px;        /* Jarak dari kanan */
        background-color: #25d366; /* Warna Hijau Resmi WA */
        color: #fff;
        width: 60px;
        height: 60px;
        border-radius: 50%; /* Bikin bulat */
        text-align: center;
        font-size: 32px;
        line-height: 60px;  /* Supaya icon di tengah vertikal */
        z-index: 9999;      /* Supaya selalu di atas elemen lain */
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        transition: all 0.3s ease;
        animation: pulse-green 2s infinite; /* Efek berdenyut */
    }

    /* Efek saat mouse diarahkan */
    .floating-wa:hover {
        background-color: #128c7e; /* Hijau lebih gelap */
        color: #fff;
        transform: scale(1.1); /* Membesar sedikit */
        box-shadow: 0 6px 16px rgba(0,0,0,0.4);
    }

    /* Animasi Berdenyut (Pulse) biar menarik perhatian */
    @keyframes pulse-green {
        0% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
        }
        70% {
            transform: scale(1.05);
            box-shadow: 0 0 0 15px rgba(37, 211, 102, 0);
        }
        100% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
        }
    }

    /* Penyesuaian di Layar HP (Biar gak kegedean) */
    @media (max-width: 768px) {
        .floating-wa {
            width: 50px;
            height: 50px;
            font-size: 26px;
            line-height: 50px;
            bottom: 20px;
            right: 20px;
        }
    }
</style>

</body>
</html>