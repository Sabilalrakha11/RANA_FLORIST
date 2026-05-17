<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Rana Florist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="container-fluid login-container">
    <div class="row">
        <div class="col-md-6 left-side d-none d-md-block" style="position: relative; overflow: hidden; padding: 0;">
    
    <video autoplay loop muted playsinline style="width: 100%; height: 100vh; object-fit: cover; position: absolute; top: 0; left: 0;">
        <source src="assets/video/bg-login.mp4" type="video/mp4">
    </video>

</div>

        <div class="col-md-6 right-side">
            <div class="form-wrapper">
                <h2 class="mb-2 text-center" style="color: var(--primary-pink);">Daftar Dulu Yuk</h2>
                <p class="text-center text-muted mb-4">Buat akun untuk mulai berbelanja buket cantik.</p>

                <form action="proses_register.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label text-muted" style="font-size:12px;">NAMA LENGKAP</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama lengkap kamu" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted" style="font-size:12px;">EMAIL ADDRESS</label>
                        <input type="email" name="email" class="form-control" placeholder="email@contoh.com" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label text-muted" style="font-size:12px;">PASSWORD</label>
                        <input type="password" name="password" class="form-control" placeholder="Buat password yang aman" required>
                    </div>

                    <button type="submit" class="btn btn-rana mb-3">DAFTAR SEKARANG</button>

                    <div class="text-center">
                        <span style="font-size:13px; color:#666;">Sudah punya akun? </span>
                        <a href="login.php" class="link-pink fw-bold">Login Disini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>