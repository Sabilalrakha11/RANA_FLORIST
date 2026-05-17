<?php
include 'includes/header.php';

// --- PROSES UPLOAD BANNER ---
if(isset($_POST['upload'])){
    $nama_file = $_FILES['foto']['name'];
    $tmp_file = $_FILES['foto']['tmp_name'];
    $tipe_file = $_FILES['foto']['type'];
    
    // Rename agar unik
    $nama_baru = "banner_" . time() . "_" . $nama_file;
    $path = "../uploads/" . $nama_baru;

    // Cek format gambar
    if($tipe_file == "image/jpeg" || $tipe_file == "image/png" || $tipe_file == "image/jpg"){
        if(move_uploaded_file($tmp_file, $path)){
            mysqli_query($conn, "INSERT INTO banners (gambar) VALUES ('$nama_baru')");
            echo "<script>alert('Banner berhasil diupload!'); window.location='banner.php';</script>";
        }
    } else {
        echo "<script>alert('Format file harus JPG/PNG!');</script>";
    }
}

// --- PROSES HAPUS BANNER ---
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    // Ambil nama file dulu buat dihapus dari folder
    $q = mysqli_query($conn, "SELECT gambar FROM banners WHERE id='$id'");
    $data = mysqli_fetch_assoc($q);
    
    // Hapus file fisik
    unlink("../uploads/" . $data['gambar']);
    
    // Hapus data database
    mysqli_query($conn, "DELETE FROM banners WHERE id='$id'");
    echo "<script>window.location='banner.php';</script>";
}
?>

<div class="container-fluid">
    <h3 class="brand-font mb-4">Kelola Banner Promo</h3>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white text-pink fw-bold">
                    + Upload Banner Baru
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="small text-muted">Pilih Gambar (Landscape)</label>
                            <input type="file" name="foto" class="form-control" required>
                            <small class="text-danger">*Disarankan ukuran 1200x400 px</small>
                        </div>
                        <button type="submit" name="upload" class="btn btn-rana w-100">Upload Banner</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Pratinjau</th>
                                    <th>Nama File</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $qry = mysqli_query($conn, "SELECT * FROM banners ORDER BY id DESC");
                                if(mysqli_num_rows($qry) > 0){
                                    while($row = mysqli_fetch_assoc($qry)):
                                ?>
                                <tr>
                                    <td>
                                        <img src="../uploads/<?= $row['gambar']; ?>" class="rounded shadow-sm" style="height: 60px; object-fit: cover;">
                                    </td>
                                    <td><?= $row['gambar']; ?></td>
                                    <td>
                                        <a href="banner.php?hapus=<?= $row['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus banner ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; 
                                } else {
                                    echo "<tr><td colspan='3' class='text-center py-4 text-muted'>Belum ada banner aktif.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>