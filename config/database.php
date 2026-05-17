<?php
// ATUR ZONA WAKTU KE INDONESIA (WIB)
date_default_timezone_set('Asia/Jakarta');

$servername = "rana_db";
$username = "root";
$password = "rootpassword";
$dbname = "db_rana_florist";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>