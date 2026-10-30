<?php
require_once __DIR__ . '/../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('index.php');
}

if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
    setFlash('Permintaan tidak valid.', 'danger');
    redirect('index.php');
}

$id = filter_var($_POST['id'] ?? '', FILTER_VALIDATE_INT);

if (!$id) {
    setFlash('ID penjualan tidak valid.', 'danger');
    redirect('index.php');
}

$stmt = $pdo->prepare('DELETE FROM sales WHERE id = ?');
$stmt->execute([$id]);

if ($stmt->rowCount() > 0) {
    setFlash('Data penjualan berhasil dihapus.');
} else {
    setFlash('Data penjualan tidak ditemukan.', 'danger');
}

redirect('index.php');
