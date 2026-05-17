<?php 
include 'includes/header.php'; 

// --- LOGIKA HAPUS USER ---
if(isset($_GET['hapus'])){
    $id_user = $_GET['hapus'];
    
    // Hapus data user dari database
    $hapus = mysqli_query($conn, "DELETE FROM users WHERE id='$id_user' AND role='user'");
    
    if($hapus){
        echo "<script>alert('Data pelanggan berhasil dihapus!'); window.location='users.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus! Mungkin user ini masih punya data pesanan.'); window.location='users.php';</script>";
    }
}
?>

<div class="container-fluid">
    <h3 class="brand-font mb-4">Data Pelanggan</h3>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Terdaftar Sejak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        // Ambil semua user yang role-nya BUKAN admin
                        $query = mysqli_query($conn, "SELECT * FROM users WHERE role='user' ORDER BY id DESC");
                        
                        if(mysqli_num_rows($query) > 0){
                            while($user = mysqli_fetch_assoc($query)):
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-pink fw-bold" style="width: 35px; height: 35px; border: 1px solid #eee;">
                                        <?= substr($user['nama'], 0, 1); ?>
                                    </div>
                                    <?= $user['nama']; ?>
                                </div>
                            </td>
                            <td><?= $user['email']; ?></td>
                            <td>
                                <?= isset($user['created_at']) ? date('d M Y', strtotime($user['created_at'])) : '-'; ?>
                            </td>
                            <td>
                                <a href="users.php?hapus=<?= $user['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus pelanggan ini? Semua data keranjang & wishlist dia juga akan hilang.')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; 
                        } else {
                            echo "<tr><td colspan='5' class='text-center text-muted py-4'>Belum ada pelanggan yang mendaftar.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>