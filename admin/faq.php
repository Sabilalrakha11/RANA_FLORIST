<?php 
include 'includes/header.php'; 

// --- 1. PROSES SIMPAN FAQ ---
if(isset($_POST['simpan'])){
    $tanya = mysqli_real_escape_string($conn, $_POST['tanya']);
    $jawab = mysqli_real_escape_string($conn, $_POST['jawab']);
    
    $simpan = mysqli_query($conn, "INSERT INTO faqs (pertanyaan, jawaban) VALUES ('$tanya', '$jawab')");
    
    if($simpan){
        echo "<script>alert('FAQ berhasil ditambahkan!'); window.location='faq.php';</script>";
    }
}

// --- 2. PROSES HAPUS FAQ ---
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM faqs WHERE id='$id'");
    echo "<script>window.location='faq.php';</script>";
}
?>

<div class="container-fluid">
    <h3 class="brand-font mb-4">Kelola FAQ (Tanya Jawab)</h3>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white text-pink fw-bold">
                    + Tambah Pertanyaan
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="small text-muted">Pertanyaan</label>
                            <input type="text" name="tanya" class="form-control" placeholder="Misal: Bisa kirim keluar kota?" required>
                        </div>
                        <div class="mb-3">
                            <label class="small text-muted">Jawaban</label>
                            <textarea name="jawab" class="form-control" rows="4" placeholder="Jawabannya..." required></textarea>
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
                                    <th>Pertanyaan & Jawaban</th>
                                    <th width="100">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $qry = mysqli_query($conn, "SELECT * FROM faqs ORDER BY id DESC");
                                if(mysqli_num_rows($qry) > 0){
                                    while($row = mysqli_fetch_assoc($qry)):
                                ?>
                                <tr>
                                    <td>
                                        <strong class="text-pink"><i class="bi bi-question-circle-fill"></i> <?= $row['pertanyaan']; ?></strong><br>
                                        <small class="text-muted"><?= nl2br($row['jawaban']); ?></small>
                                    </td>
                                    <td>
                                        <a href="faq.php?hapus=<?= $row['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus pertanyaan ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; 
                                } else {
                                    echo "<tr><td colspan='2' class='text-center text-muted py-4'>Belum ada FAQ.</td></tr>";
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