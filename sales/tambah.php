<?php
require_once __DIR__ . '/../koneksi.php';

$judul = 'Tambah Penjualan';
$error = '';

$suppliers = $pdo->query(
    'SELECT id, name FROM suppliers ORDER BY name ASC'
)->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
        $error = 'Permintaan tidak valid. Silakan coba lagi.';
    } else {
        $supplierId = filter_var($_POST['supplier_id'] ?? '', FILTER_VALIDATE_INT);
        $totalInput = $_POST['total'] ?? '';

        if (!$supplierId || !isset($suppliers[array_search($supplierId, array_column($suppliers, 'id'))])) {
            $error = 'Silakan pilih pemasok yang valid.';
        } elseif ($totalInput === '' || !ctype_digit((string) $totalInput)) {
            $error = 'Total penjualan harus berupa angka bulat positif atau nol.';
        } else {
            $stmt = $pdo->prepare(
                'INSERT INTO sales (supplier_id, total) VALUES (?, ?)'
            );
            $stmt->execute([$supplierId, (int) $totalInput]);

            setFlash('Data penjualan berhasil ditambahkan.');
            redirect('index.php');
        }
    }
}

include __DIR__ . '/../header.php';
?>

<div class="container py-4">
    <h2>Tambah Penjualan</h2>
    <p>Masukkan data penjualan baru.</p>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= e($error) ?></div>
    <?php endif; ?>

    <div class="card shadow-sm p-4">
        <form method="POST">
            <input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>">

            <div class="mb-3">
                <label class="form-label">Nama Pemasok</label>
                <select name="supplier_id" class="form-select" required>
                    <option value="">-- Pilih Pemasok --</option>
                    <?php foreach ($suppliers as $supplier): ?>
                        <option value="<?= e($supplier['id']) ?>"
                            <?= (string)($_POST['supplier_id'] ?? '') === (string)$supplier['id'] ? 'selected' : '' ?>>
                            <?= e($supplier['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Total Penjualan (Rp)</label>
                <input type="number" name="total" class="form-control"
                       min="0" step="1" required
                       value="<?= e($_POST['total'] ?? '') ?>">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>
