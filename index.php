
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


<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="text-muted">Total Supplier</h5>
                <h2 class="fw-bold"><?= $totalSupplier ?></h2>

                <a href="suppliers/index.php" class="btn btn-secondary">
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
