<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="bi bi-book"></i> Toko Buku Budi
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categories_list.php">Kategori</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="products.php">Produk</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <?php if(isset($_SESSION['customer_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">
                            <i class="bi bi-cart"></i> Keranjang
                            <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                                <span class="badge bg-danger"><?php echo count($_SESSION['cart']); ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
                           data-bs-toggle="dropdown">
                            <?php echo htmlspecialchars($_SESSION['customer_name']); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="orders.php">Pesanan Saya</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav> 