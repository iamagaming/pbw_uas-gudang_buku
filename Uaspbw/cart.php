<?php
session_start();
require_once "config/database.php";

if(!isset($_SESSION['customer_id'])) {
    $_SESSION['redirect_url'] = "cart.php";
    header('Location: login.php');
    exit;
}

$database = new Database();
$db = $database->getConnection();

// Handle update quantity
if(isset($_POST['update_quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    
    if($quantity > 0) {
        foreach($_SESSION['cart'] as &$item) {
            if($item['product_id'] == $product_id) {
                $item['quantity'] = $quantity;
                break;
            }
        }
    }
    header('Location: cart.php');
    exit;
}

// Handle remove item
if(isset($_POST['remove_item'])) {
    $product_id = $_POST['product_id'];
    foreach($_SESSION['cart'] as $key => $item) {
        if($item['product_id'] == $product_id) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array
    header('Location: cart.php');
    exit;
}

// Calculate total
$total = 0;
if(isset($_SESSION['cart'])) {
    foreach($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Toko Buku Budi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="container py-5">
        <h2 class="mb-4">Keranjang Belanja</h2>

        <?php if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])): ?>
            <div class="alert alert-info">
                Keranjang belanja Anda kosong. 
                <a href="products.php" class="alert-link">Belanja sekarang</a>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-md-8">
                    <?php foreach($_SESSION['cart'] as $item): ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <?php if($item['image_url']): ?>
                                            <img src="<?php echo $item['image_url']; ?>" 
                                                 alt="<?php echo htmlspecialchars($item['title']); ?>"
                                                 class="img-fluid">
                                        <?php else: ?>
                                            <div class="no-image-placeholder">
                                                <i class="bi bi-book"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4">
                                        <h5 class="card-title"><?php echo htmlspecialchars($item['title']); ?></h5>
                                        <p class="card-text">Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></p>
                                    </div>
                                    <div class="col-md-3">
                                        <form method="POST" class="d-flex align-items-center">
                                            <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                            <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" 
                                                   min="1" class="form-control me-2" style="width: 70px;">
                                            <button type="submit" name="update_quantity" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-arrow-clockwise"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <p class="fw-bold">
                                            Rp <?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?>
                                        </p>
                                    </div>
                                    <div class="col-md-1">
                                        <form method="POST">
                                            <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                            <button type="submit" name="remove_item" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ringkasan Belanja</h5>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Total Harga</span>
                                <span class="fw-bold">Rp <?php echo number_format($total, 0, ',', '.'); ?></span>
                            </div>
                            <a href="checkout.php" class="btn btn-primary w-100">
                                Lanjut ke Pembayaran
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 