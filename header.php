
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
            background-color: #edf0ee;
            color: #353232;
            font-family: Arial, sans-serif;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .brand-mark {
            display: inline-block;
            padding: 5px 8px;
            margin-right: 5px;
            background-color: #f0f0f0;
            border-radius: 4px;
        }

        .card {
            border: 1px solid #f1f3f1;
            border-radius: 6px;
        }

        .page-title {
            font-weight: bold;
        }

        footer {
            color: #312f2f;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark mb-4"
     style="background-color: #d6dbd6e7;">
    <div class="container">
<a class="navbar-brand d-flex align-items-center gap-2"
   href="/html-35/ujianpos/index.php">
    <img src="/html-35/ujianpos/images/logo.png"
         alt="Logo TKJ"
         style="height: 45px; width: auto;">
    <span class="fw-bold">Aplikasi POS</span>
</a>
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#menuNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuNavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-black" href="/html-35/ujianpos/index.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-black" href="/html-35/ujianpos/suppliers/index.php">Supplier</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-black" href="/html-35/ujianpos/sales/index.php">Sales</a>
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

