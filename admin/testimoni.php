<?php 
include 'includes/header.php'; 

// --- 1. PROSES SIMPAN TESTIMONI ---
if(isset($_POST['simpan'])){
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $isi = mysqli_real_escape_string($conn, $_POST['isi']);
    
    // Upload Foto Pelanggan
    $foto = 'default.jpg';
    if($_FILES['foto']['name'] != ''){
        $foto = time() . '_' . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], '../uploads/' . $foto);
    }

    $simpan = mysqli_query($conn, "INSERT INTO testimonials (nama_pelanggan, isi_testimoni, foto_pelanggan) VALUES ('$nama', '$isi', '$foto')");
    
    if($simpan){
        echo "<script>alert('Testimoni berhasil ditambahkan!'); window.location='testimoni.php';</script>";
    }
}

// --- 2. PROSES HAPUS TESTIMONI ---
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    
    // Hapus foto lama dulu
    $q = mysqli_query($conn, "SELECT foto_pelanggan FROM testimonials WHERE id='$id'");
    $data = mysqli_fetch_assoc($q);
    if($data['foto_pelanggan'] != 'default.jpg'){
        if(file_exists('../uploads/' . $data['foto_pelanggan'])){
            unlink('../uploads/' . $data['foto_pelanggan']);
        }
    }

    mysqli_query($conn, "DELETE FROM testimonials WHERE id='$id'");
    echo "<script>window.location='testimoni.php';</script>";
}
?>

<div class="container-fluid">
    <h3 class="brand-font mb-4">Kelola Testimoni</h3>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white text-pink fw-bold">
                    + Tambah Testimoni Baru
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="small text-muted">Nama Pelanggan</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="small text-muted">Isi Ulasan</label>
                            <textarea name="isi" class="form-control" rows="4" required placeholder="Apa kata mereka tentang Rana Florist?"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="small text-muted">Foto Pelanggan (Optional)</label>
                            <input type="file" name="foto" class="form-control">
                        </div>
                        <button type="submit" name="simpan" class="btn btn-rana w-100">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama & Ulasan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $qry = mysqli_query($conn, "SELECT * FROM testimonials ORDER BY id DESC");
                                if(mysqli_num_rows($qry) > 0){
                                    while($row = mysqli_fetch_assoc($qry)):
                                ?>
                                <tr>
                                    <td>
                                        <img src="../uploads/<?= $row['foto_pelanggan']; ?>" class="rounded-circle" width="50" height="50" style="object-fit:cover;">
                                    </td>
                                    <td>
                                        <strong><?= $row['nama_pelanggan']; ?></strong><br>
                                        <small class="text-muted">"<?= substr($row['isi_testimoni'], 0, 80); ?>..."</small>
                                    </td>
                                    <td>
                                        <a href="testimoni.php?hapus=<?= $row['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus ulasan ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; 
                                } else {
                                    echo "<tr><td colspan='3' class='text-center text-muted py-4'>Belum ada testimoni.</td></tr>";
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