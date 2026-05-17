<?php 
include 'includes/header.php'; 

// --- PROSES TAMBAH KATEGORI ---
if(isset($_POST['tambah_kategori'])){
    $nama = mysqli_real_escape_string($conn, $_POST['nama_kategori']);
    $simpan = mysqli_query($conn, "INSERT INTO categories (nama_kategori) VALUES ('$nama')");
    if($simpan){
        echo "<script>window.location='kategori.php';</script>";
    }
}

// --- PROSES HAPUS KATEGORI ---
if(isset($_GET['hapus'])){
    $id_hapus = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM categories WHERE id='$id_hapus'");
    echo "<script>alert('Kategori dihapus!'); window.location='kategori.php';</script>";
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white brand-font text-pink">
                    Tambah Kategori
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label>Nama Kategori</label>
                            <input type="text" name="nama_kategori" class="form-control" placeholder="Contoh: Buket Uang" required>
                        </div>
                        <button type="submit" name="tambah_kategori" class="btn btn-rana w-100">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white brand-font">
                    Daftar Kategori
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            $qry = mysqli_query($conn, "SELECT * FROM categories ORDER BY id DESC");
                            while($kat = mysqli_fetch_assoc($qry)):
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $kat['nama_kategori']; ?></td>
                                <td>
                                    <a href="kategori.php?hapus=<?= $kat['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>