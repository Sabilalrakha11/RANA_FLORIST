<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

include 'config/database.php';

if(isset($_POST['kirim_reset'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // 1. Cek Apakah Email Terdaftar?
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    
    if(mysqli_num_rows($cek) > 0){
        // Ambil nama user untuk sapaan
        $data_user = mysqli_fetch_assoc($cek);
        $nama_user = $data_user['nama']; // Pastikan di tabel users ada kolom 'nama'

        // 2. Buat Token Unik
        $token = bin2hex(random_bytes(32)); 
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour')); 

        // 3. Simpan Token ke Database
        mysqli_query($conn, "UPDATE users SET reset_token='$token', reset_expiry='$expiry' WHERE email='$email'");

        // 4. Kirim Email pakai PHPMailer
        $mail = new PHPMailer(true);

        try {
            // --- SETTING SERVER GMAIL ---
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'sabilalrakha11@gmail.com'; // <--- GANTI EMAIL PENGIRIM
            $mail->Password   = 'kqzc gvca bdwv ytxx';    // <--- GANTI APP PASSWORD
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            // --- PENGIRIM & PENERIMA ---
            $mail->setFrom('EMAIL_KAMU@gmail.com', 'Rana Florist Admin'); // <--- GANTI EMAIL PENGIRIM
            $mail->addAddress($email);

            // --- ISI PESAN (DESAIN BARU) ---
            $mail->isHTML(true);
            $mail->Subject = 'Permintaan Reset Password - Rana Florist';
            
            $link = "http://localhost/RANA_FLORIST/reset_password.php?email=$email&token=$token";
            
            // HTML EMAIL TEMPLATE PRO
            $mail->Body = "
            <div style='font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 40px 0;'>
                <div style='max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05);'>
                    
                    <div style='background-color: #FFB7C5; padding: 30px; text-align: center;'>
                        <h1 style='color: white; margin: 0; font-family: \"Georgia\", serif; letter-spacing: 2px;'>RANA FLORIST</h1>
                        <p style='color: #fff; margin: 5px 0 0 0; font-size: 14px;'>Buket Impian untuk Momen Spesial</p>
                    </div>
                    
                    <div style='padding: 40px 30px; text-align: center; color: #444;'>
                        <h2 style='color: #333; margin-top: 0;'>Lupa Password?</h2>
                        <p style='font-size: 16px; line-height: 1.6; margin-bottom: 30px; color: #555;'>
                            Halo <strong>$nama_user</strong>,<br>
                            Kami menerima permintaan untuk mereset password akun kamu.<br>
                            Jangan khawatir, cukup klik tombol di bawah ini untuk membuat password baru:
                        </p>
                        
                        <a href='$link' style='display: inline-block; background-color: #FFB7C5; color: white; padding: 14px 30px; text-decoration: none; border-radius: 50px; font-weight: bold; font-size: 16px; box-shadow: 0 4px 15px rgba(255, 183, 197, 0.4); transition: background 0.3s;'>
                            RESET PASSWORD SAYA
                        </a>
                        
                        <p style='margin-top: 40px; font-size: 13px; color: #999;'>
                            Link ini hanya berlaku selama <strong>1 jam</strong>.<br>
                            Jika kamu tidak merasa melakukan permintaan ini, abaikan saja email ini.
                        </p>
                    </div>
                    
                    <div style='background-color: #f9f9f9; padding: 20px; text-align: center; font-size: 12px; color: #aaa; border-top: 1px solid #eee;'>
                        <p style='margin: 0;'>&copy; 2025 Rana Florist - Indramayu, Indonesia</p>
                        <p style='margin: 5px 0;'>Butuh bantuan? Balas email ini.</p>
                    </div>
                    
                </div>
            </div>
            ";

            $mail->send();
            echo "<script>alert('Link reset telah dikirim! Cek email kamu sekarang.'); window.location='login.php';</script>";

        } catch (Exception $e) {
            echo "Gagal kirim email. Error: {$mail->ErrorInfo}";
        }

    } else {
        echo "<script>alert('Email tidak terdaftar!'); window.location='lupa_password.php';</script>";
    }
}
?>