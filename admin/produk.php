<?php include 'includes/header.php'; ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="brand-font">Daftar Produk</h3>
        <a href="tambah_produk.php" class="btn btn-rana">+ Tambah Produk</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th class="text-center">Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        // Join tabel produk dengan gambar (ambil 1 gambar aja buat thumbnail)
                        $query = "SELECT p.*, 
                                 (SELECT nama_file FROM product_images WHERE product_id = p.id LIMIT 1) as foto 
                                  FROM products p ORDER BY p.id DESC";
                        $result = mysqli_query($conn, $query);

                        while($row = mysqli_fetch_assoc($result)):
                            // Logika warna stok (Merah kalau habis)
                            $stok_class = ($row['stok'] < 1) ? 'text-danger fw-bold' : 'text-dark';
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>
                                <img src="../uploads/<?= $row['foto'] ?? 'default.jpg'; ?>" width="50" height="50" class="rounded shadow-sm" style="object-fit: cover;">
                            </td>
                            <td class="fw-bold"><?= $row['nama_produk']; ?></td>
                            <td>Rp <?= number_format($row['harga']); ?></td>
                            
                            <td class="text-center <?= $stok_class; ?>">
                                <?= $row['stok']; ?>
                            </td>
                            
                            <td>
                                <a href="edit_produk.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning text-white me-1" title="Edit Stok & Harga">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <a href="hapus_produk.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin mau hapus buket ini?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>