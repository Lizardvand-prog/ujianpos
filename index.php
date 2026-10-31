
<?php
require 'koneksi.php';

$totalSupplier = (int) $pdo->query(
    'SELECT COUNT(*) FROM suppliers'
)->fetchColumn();

$totalSales = (int) $pdo->query(
    'SELECT COUNT(*) FROM sales'
)->fetchColumn();

$judul = 'Dashboard';
include 'header.php';
?>

<div class="d-flex align-items-center gap-3 mb-4">
    <img src="images/logo.png"
         alt="Logo TKJ"
         width="75"
         height="75"
         style="object-fit: contain;">

    <div>
        <h1 class="page-title h3 mb-1">UJIANPOS</h1>
        <p class="text-muted mb-0">
            Aplikasi Pengelolaan Supplier dan Sales - TKJ 35
        </p>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="text-muted">Total Supplier</h5>
                <h2 class="fw-bold"><?= $totalSupplier ?></h2>

                <a href="suppliers/index.php" class="btn btn-primary">
                    Kelola Supplier
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="text-muted">Total Sales</h5>
                <h2 class="fw-bold"><?= $totalSales ?></h2>

                <a href="sales/index.php" class="btn btn-secondary">
                    Kelola Sales
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h5>Tentang Aplikasi</h5>
        <p class="mb-0">
            UJIANPOS adalah aplikasi untuk mengelola data supplier
            dan sales. Aplikasi ini dibuat menggunakan PHP Native,
            PDO, dan MariaDB.
        </p>
    </div>
</div>

<?php include 'footer.php'; ?>
