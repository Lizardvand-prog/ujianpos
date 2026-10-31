
<?php
// Pastikan koneksi.php sudah dipanggil sebelum header.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($judul) ? e($judul) . ' | UJIANPOS' : 'UJIANPOS' ?></title>

    <link rel="icon" type="image/png" href="/html-35/ujianpos/images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f5f5;
            color: #333;
            font-family: Arial, sans-serif;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .brand-mark {
            display: inline-block;
            padding: 5px 8px;
            margin-right: 5px;
            background-color: #e9ecef;
            border-radius: 4px;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        .page-title {
            font-weight: bold;
        }

        footer {
            color: #777;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom mb-4">
    <div class="container">
        <a class="navbar-brand text-dark" href="/html-35/ujianpos/index.php">
            <span class="brand-mark">UP</span> UJIANPOS
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#menuNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuNavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/html-35/ujianpos/index.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/html-35/ujianpos/suppliers/index.php">Supplier</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/html-35/ujianpos/sales/index.php">Sales</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container pb-4">

<?php if (!empty($_SESSION['pesan'])): ?>
    <div class="alert alert-<?= e($_SESSION['tipe'] ?? 'success') ?> alert-dismissible fade show" role="alert">
        <?= e($_SESSION['pesan']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
    <?php unset($_SESSION['pesan'], $_SESSION['tipe']); ?>
<?php endif; ?>

