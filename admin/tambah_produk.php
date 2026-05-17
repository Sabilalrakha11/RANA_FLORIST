<?php 
include 'includes/header.php'; 

// PROSES SIMPAN DATA
if(isset($_POST['simpan'])){
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $dimensi = $_POST['dimensi'];
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $kategori = $_POST['kategori_id'];

    // 1. Simpan ke tabel products
    $insert = mysqli_query($conn, "INSERT INTO products (category_id, nama_produk, deskripsi, harga, dimensi, stok) VALUES ('$kategori', '$nama', '$deskripsi', '$harga', '$dimensi', '$stok')");

    if($insert){
        $product_id = mysqli_insert_id($conn); // Ambil ID produk barusan

        // 2. Proses Upload Banyak Gambar
        $jumlah_file = count($_FILES['foto']['name']);
        
        for($i = 0; $i < $jumlah_file; $i++){
            $nama_file = $_FILES['foto']['name'][$i];
            $tmp_file = $_FILES['foto']['tmp_name'][$i];
            
            // Rename file biar unik (time + namafile)
            $nama_baru = time() . "_" . $nama_file;
            $path = "../uploads/" . $nama_baru;

            if(move_uploaded_file($tmp_file, $path)){
                // Set gambar pertama sebagai primary (is_primary = 1)
                $is_primary = ($i == 0) ? 1 : 0;
                mysqli_query($conn, "INSERT INTO product_images (product_id, nama_file, is_primary) VALUES ('$product_id', '$nama_baru', '$is_primary')");
            }
        }
        
        echo "<script>alert('Produk berhasil ditambahkan!'); window.location='produk.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data!');</script>";
    }
}
?>

<div class="container-fluid">
    <h3 class="brand-font mb-4">Tambah Produk Baru</h3>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data"> <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nama Buket</label>
                        <input type="text" name="nama_produk" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Kategori</label>
                        <select name="kategori_id" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php
                            // Ambil data kategori dari database
                            $q_kat = mysqli_query($conn, "SELECT * FROM categories");
                            while($k = mysqli_fetch_assoc($q_kat)){
                                echo "<option value='".$k['id']."'>".$k['nama_kategori']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Harga (Rp)</label>
                        <input type="number" name="harga" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Stok</label>
                        <input type="number" name="stok" class="form-control" value="10">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Dimensi (cth: 30x40 cm)</label>
                        <input type="text" name="dimensi" class="form-control">
                    </div>
                    <div class="col-12 mb-3">
                        <label>Deskripsi Lengkap</label>
                        <textarea name="deskripsi" class="form-control" rows="5"></textarea>
                    </div>
                    <div class="col-12 mb-3">
                        <label>Foto Produk (Bisa pilih banyak sekaligus)</label>
                        <input type="file" name="foto[]" class="form-control" multiple required>
                        <small class="text-muted">Tekan CTRL saat memilih file untuk upload banyak foto sekaligus.</small>
                    </div>
                </div>
                
                <button type="submit" name="simpan" class="btn btn-rana mt-3">Simpan Produk</button>
                <a href="produk.php" class="btn btn-secondary mt-3">Batal</a>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>