<?php
require_once __DIR__ . '/../koneksi.php';

$suppliers = $pdo->query(
    'SELECT id, name FROM suppliers ORDER BY name ASC'
)->fetchAll();

$judul = 'Tambah Penjualan';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
        $error = 'Permintaan tidak valid.';
    } else {
        $supplierId = filter_var(
            $_POST['supplier_id'] ?? '',
            FILTER_VALIDATE_INT
        );

        $totalInput = $_POST['total'] ?? '';
        $validSupplier = false;

        foreach ($suppliers as $supplier) {
            if ((int) $supplier['id'] === $supplierId) {
                $validSupplier = true;
                break;
            }
        }

        if (!$validSupplier) {
            $error = 'Silakan pilih pemasok yang valid.';
        } elseif ($totalInput === '' || !ctype_digit((string) $totalInput)) {
            $error = 'Total harus berupa angka bulat positif atau nol.';
        } else {
            $insert = $pdo->prepare(
                'INSERT INTO sales (supplier_id, total)
                 VALUES (?, ?)'
            );

            $insert->execute([
                $supplierId,
                (int) $totalInput
            ]);

            setFlash('Data penjualan berhasil ditambahkan.');
            redirect('index.php');
        }
    }
}

include __DIR__ . '/../header.php';
?>

<div class="mb-4">
    <h1 class="page-title h3">Tambah Penjualan</h1>
    <p class="text-muted">Silakan isi data penjualan berikut.</p>
</div>

<div class="card">
    <div class="card-body">

        <?php if ($error !== ''): ?>
            <div class="alert alert-danger">
                <?= e($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <input type="hidden" name="csrf_token"
                   value="<?= e(csrfToken()) ?>">

            <div class="mb-3">
                <label class="form-label">Nama Pemasok</label>
                <select name="supplier_id" class="form-select" required>
                    <option value="">Pilih Pemasok</option>

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

            <button type="submit" class="btn btn-primary">
                Simpan
            </button>

            <a href="index.php" class="btn btn-secondary">
                Kembali
            </a>
        </form>

    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>
