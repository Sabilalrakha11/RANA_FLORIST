<?php
include 'includes/header.php';

// Ambil ID produk dari URL
$id = $_GET['id'];

// Ambil data produk sekarang
$ambil = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
$pecah = mysqli_fetch_assoc($ambil);

// PROSES UPDATE DATA
if (isset($_POST['ubah'])) {
    $nama      = $_POST['nama'];
    $harga     = $_POST['harga'];
    $stok      = $_POST['stok']; // <--- INI BAGIAN PENTING
    $deskripsi = $_POST['deskripsi'];
    $kategori  = $_POST['kategori_id'];

    // Update data ke database
    $conn->query("UPDATE products SET 
        nama_produk='$nama', 
        harga='$harga', 
        stok='$stok', 
        deskripsi='$deskripsi', 
        category_id='$kategori' 
        WHERE id='$id'");

    echo "<script>alert('Data produk berhasil diubah');</script>";
    echo "<script>location='produk.php';</script>";
}
?>

<div class="container-fluid">
    <h3 class="brand-font mb-4">Edit Produk</h3>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Produk</label>
                    <input type="text" name="nama" class="form-control" value="<?= $pecah['nama_produk']; ?>">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Harga (Rp)</label>
                        <input type="number" name="harga" class="form-control" value="<?= $pecah['harga']; ?>">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold text-danger">Stok Produk</label>
                        <input type="number" name="stok" class="form-control border-danger" value="<?= $pecah['stok']; ?>">
                        <small class="text-muted">Isi <b>0</b> jika barang habis.</small>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Kategori</label>
                    <select name="kategori_id" class="form-select">
                        <option value="">- Pilih Kategori -</option>
                        <?php
                        $ambil_kat = $conn->query("SELECT * FROM categories");
                        while($k = $ambil_kat->fetch_assoc()){
                        ?>
                        <option value="<?= $k['id']; ?>" <?= ($pecah['category_id'] == $k['id']) ? 'selected' : ''; ?>>
                            <?= $k['nama_kategori']; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="5"><?= $pecah['deskripsi']; ?></textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" name="ubah" class="btn btn-primary px-4">Simpan Perubahan</button>
                    <a href="produk.php" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>