<?php
session_start();
// Jika sudah login, lempar ke index
if(isset($_SESSION['login_status']) && $_SESSION['login_status'] == true){
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rana Florist</title>
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
                <h2 class="mb-2 text-center" style="color: var(--primary-pink);">Rana Florist</h2>
                <p class="text-center text-muted mb-4">Selamat datang kembali!</p>

                <?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'gagal'): ?>
                    <div class="alert alert-danger py-2 text-center" style="font-size:13px;">
                        Email atau Password salah!
                    </div>
                <?php endif; ?>

                <form action="proses_login.php" method="POST">
                    <div class="mb-4">
                        <label class="form-label text-muted" style="font-size:12px;">EMAIL ADDRESS</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan email kamu" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label text-muted" style="font-size:12px;">PASSWORD</label>
                        <input type="password" name="password" class="form-control" placeholder="********" required>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember" style="font-size:13px;">Ingat Saya</label>
                        </div>
                        <a href="lupa_password.php" class="link-pink">Lupa Password?</a>
                    </div>

                    <button type="submit" class="btn btn-rana mb-3">MASUK SEKARANG</button>

                    <div class="text-center">
                        <span style="font-size:13px; color:#666;">Belum punya akun? </span>
                        <a href="register.php" class="link-pink fw-bold">Daftar Disini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>