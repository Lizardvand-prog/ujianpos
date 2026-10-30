
<?php
require 'koneksi.php';

$totalSupplier = (int) $pdo->query(
    'SELECT COUNT(*) FROM suppliers'
)->fetchColumn();

$totalSales = (int) $pdo->query(
    'SELECT COUNT(*) FROM sales'
)->fetchColumn();

$judul = 'Dashboard UJIANPOS';
include 'header.php';
?>

<div class="mb-4">
    <p class="text-primary fw-semibold small text-uppercase mb-1">
        Dashboard
    </p>
    <h1 class="page-title h3 mb-1">Selamat Datang di UJIANPOS</h1>
    <p class="text-secondary">
        Sistem Informasi Pengelolaan Supplier dan Sales.
    </p>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card shadow-soft h-100">
            <div class="card-body">
                <p class="text-secondary mb-1">Total Supplier</p>
                <h2 class="display-5 fw-bold">
                    <?= $totalSupplier ?>
                </h2>
                <a href="suppliers/index.php"
                   class="btn btn-primary">
                    Kelola Supplier
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-soft h-100">
            <div class="card-body">
                <p class="text-secondary mb-1">Total Sales</p>
                <h2 class="display-5 fw-bold">
                    <?= $totalSales ?>
                </h2>
                <a href="sales/index.php"
                   class="btn btn-success">
                    Kelola Sales
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-soft">
    <div class="card-body">
        <h2 class="h5">Tentang Aplikasi</h2>
        <p class="mb-0">
            UJIANPOS merupakan aplikasi berbasis PHP Native dan PDO
            untuk mengelola data supplier serta transaksi sales.
        </p>
    </div>
</div>

<?php include 'footer.php'; ?>

