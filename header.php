
<?php
// Pastikan koneksi.php sudah dipanggil sebelum header.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0e1b1f">
    <title><?= isset($judul) ? e($judul) . ' | UJIANPOS' : 'UJIANPOS' ?></title>

    <link rel="icon" type="image/png" href="/html-35/ujianpos/images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --green: #34383b;
            --green-dark: #9b9da1;
        }
        body { background:#f3f6f4; color:#1f2933; }
        .navbar { background:linear-gradient(110deg,var(--green-dark),var(--green)); }
        .brand-mark {
            display:inline-grid; place-items:center;
            width:34px; height:34px; border-radius:10px;
            background:#ffffff20; margin-right:8px; font-weight:800;
        }
        .page-title { font-weight:750; letter-spacing:-.03em; }
        .card { border:0; border-radius:16px; }
        .shadow-soft { box-shadow:0 12px 32px #3b3e52d5; }
        .btn-success { background:var(--green); border-color:var(--green); }
        .table thead th { white-space:nowrap; font-size:.86rem; }
        footer { color:#6b7280; }
    </style>
</head>
<body>
<nav class="navbar navbar-dark mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center"
           href="/html-35/ujianpos/index.php">
            <span class="brand-mark">UP</span> UJIANPOS
        </a>
        <span class="navbar-text text-white-50 small">
            Aplikasi Penjualan PHP &amp; MariaDB
        </span>
    </div>
</nav>

<main class="container pb-5">
<?php if (!empty($_SESSION['pesan'])): ?>
    <div class="alert alert-<?= e($_SESSION['tipe'] ?? 'success') ?> alert-dismissible fade show" role="alert">
        <?= e($_SESSION['pesan']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
    <?php unset($_SESSION['pesan'], $_SESSION['tipe']); ?>
<?php endif; ?> 