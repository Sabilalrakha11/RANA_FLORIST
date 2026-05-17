<?php
include 'config/database.php';

// Cek Kelengkapan Link
if(!isset($_GET['token']) || !isset($_GET['email'])){
    die("Link tidak valid!");
}

$token = $_GET['token'];
$email = $_GET['email'];

// Proses Simpan Password Baru
if(isset($_POST['ubah_password'])){
    $pass_baru = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Update Password & Hapus Token (Biar link gabisa dipakai 2x)
    $update = mysqli_query($conn, "UPDATE users SET password='$pass_baru', reset_token=NULL, reset_expiry=NULL WHERE email='$email'");
    
    if($update){
        echo "<script>alert('Password berhasil diubah! Silakan Login.'); window.location='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card border-0 shadow-sm p-4" style="max-width: 400px; width: 100%;">
        
        <?php
        $cek = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND reset_token='$token' AND reset_expiry > NOW()");
        if(mysqli_num_rows($cek) > 0):
        ?>

            <div class="text-center mb-4">
                <h3 class="brand-font text-pink">Password Baru</h3>
                <p class="text-muted small">Silakan buat password baru kamu.</p>
            </div>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label small text-muted">PASSWORD BARU</label>
                    <input type="password" name="password" class="form-control" required minlength="6" placeholder="******">
                </div>
                <button type="submit" name="ubah_password" class="btn btn-rana w-100">Simpan Password</button>
            </form>

        <?php else: ?>
            <div class="text-center text-danger">
                <h4>Link Kadaluarsa!</h4>
                <p>Silakan request reset ulang.</p>
                <a href="lupa_password.php" class="btn btn-secondary btn-sm">Ulangi</a>
            </div>
        <?php endif; ?>

    </div>
</div>

</body>
</html>