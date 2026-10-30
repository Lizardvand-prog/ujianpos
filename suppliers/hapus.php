<?php
require_once __DIR__ . '/../koneksi.php';

// Pastikan permintaan menggunakan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('index.php');
}

// Periksa token CSRF
if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
    setFlash('Permintaan tidak valid.', 'danger');
    redirect('index.php');
}

// Validasi ID supplier
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    setFlash('ID supplier tidak valid.', 'danger');
    redirect('index.php');
}

// Periksa apakah supplier tersedia
$stmt = $pdo->prepare('SELECT id FROM suppliers WHERE id = ?');
$stmt->execute([$id]);

if (!$stmt->fetch()) {
    setFlash('Supplier tidak ditemukan.', 'danger');
    redirect('index.php');
}

// Hapus supplier
$delete = $pdo->prepare('DELETE FROM suppliers WHERE id = ?');
$delete->execute([$id]);

setFlash('Supplier berhasil dihapus.');
redirect('index.php');
