<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Rana Florist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card border-0 shadow-sm p-4" style="max-width: 400px; width: 100%; border-radius: 15px;">
        <div class="text-center mb-4">
            <h3 class="brand-font text-pink">Lupa Password?</h3>
            <p class="text-muted small">Masukkan email yang terdaftar, kami akan mengirimkan link reset password.</p>
        </div>

        <form action="proses_lupa.php" method="POST">
            <div class="mb-3">
                <label class="form-label small text-muted">EMAIL ADDRESS</label>
                <input type="email" name="email" class="form-control" required placeholder="nama@email.com">
            </div>
            
            <button type="submit" name="kirim_reset" class="btn btn-rana w-100 mb-3">Kirim Link Reset</button>
            
            <div class="text-center">
                <a href="login.php" class="text-secondary small text-decoration-none">Kembali ke Login</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>