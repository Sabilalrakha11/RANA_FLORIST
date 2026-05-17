<nav class="navbar navbar-expand-lg navbar-light sticky-top bg-white">
  <div class="container">
    <a class="navbar-brand py-0" href="index.php">
      <img src="assets/images/logo.png" alt="Logo" height="55">
    </a>
    
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item"><a class="nav-link mx-2" href="index.php">Home</a></li>
        
        <li class="nav-item"><a class="nav-link mx-2" href="index.php#katalog">Katalog</a></li>
        
        <li class="nav-item"><a class="nav-link mx-2" href="index.php#testimoni">Testimoni</a></li>

        <li class="nav-item"><a class="nav-link mx-2" href="index.php#faq">FAQ</a></li>
        
        <?php if(isset($_SESSION['login_status']) && $_SESSION['login_status'] == true): ?>
            
            <li class="nav-item mx-2">
                <a class="nav-link position-relative" href="keranjang.php" style="font-size: 1.3rem;">
                    <i class="bi bi-bag"></i> 
                    <span class="position-absolute top-25 start-100 translate-middle badge rounded-circle bg-danger border border-light p-1" style="font-size: 10px;">
                        2
                    </span>
                </a>
            </li>
            
            <li class="nav-item dropdown ms-2">
                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-pink fw-bold" style="width: 35px; height: 35px; border: 1px solid #eee;">
                        <?= substr($_SESSION['nama'], 0, 1); ?>
                    </div>
                    <span style="font-size: 14px;"><?= explode(' ', $_SESSION['nama'])[0]; ?></span>
                </a>
                
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2" style="border-radius: 10px; min-width: 200px;">
                    <li><h6 class="dropdown-header text-muted">Akun Saya</h6></li>
                    
                    <?php if($_SESSION['role'] == 'admin'): ?>
                        <li><a class="dropdown-item rounded py-2" href="admin/index.php"><i class="bi bi-speedometer2 me-2"></i> Dashboard Admin</a></li>
                    <?php endif; ?>

                    <li><a class="dropdown-item rounded py-2" href="favorit.php"><i class="bi bi-heart me-2"></i> Favorit Saya</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item rounded py-2 text-danger fw-bold" href="logout.php">
                            <i class="bi bi-box-arrow-right me-2"></i> Keluar / Logout
                        </a>
                    </li>
                </ul>
            </li>

        <?php else: ?>
            <li class="nav-item ms-3">
                <a class="btn btn-rana shadow-sm px-4" href="login.php">Masuk</a>
            </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>