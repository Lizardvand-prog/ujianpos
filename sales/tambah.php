
<?php
require_once __DIR__ . '/../koneksi.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    redirect('index.php');
}

$stmt = $pdo->prepare('SELECT * FROM sales WHERE id = ?');
$stmt->execute([$id]);
$sale = $stmt->fetch();

if (!$sale) {
    setFlash('Data penjualan tidak ditemukan.', 'danger');
    redirect('index.php');
}

$suppliers = $pdo->query(
    'SELECT id, name FROM suppliers ORDER BY name ASC'
)->fetchAll();

$judul = 'Edit Penjualan';
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
            $update = $pdo->prepare(
                'UPDATE sales
                 SET supplier_id = ?, total = ?
                 WHERE id = ?'
            );

            $update->execute([
                $supplierId,
                (int) $totalInput,
                $id
            ]);

            setFlash('Data penjualan berhasil diperbarui.');
            redirect('index.php');
        }
    }
}

include __DIR__ . '/../header.php';
?>

<div class="mb-4">
    <h1 class="page-title h3">Edit Penjualan</h1>
    <p class="text-muted">Perbarui data penjualan.</p>
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
                    <?php foreach ($suppliers as $supplier): ?>
                        <option value="<?= e($supplier['id']) ?>"
                            <?= (string)($_POST['supplier_id'] ?? $sale['supplier_id']) === (string)$supplier['id'] ? 'selected' : '' ?>>
                            <?= e($supplier['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Total Penjualan (Rp)</label>
                <input type="number" name="total" class="form-control"
                       min="0" step="1" required
                       value="<?= e($_POST['total'] ?? $sale['total']) ?>">
            </div>

            <button type="submit" class="btn btn-primary">
                Simpan Perubahan
            </button>

            <a href="index.php" class="btn btn-secondary">
                Kembali
            </a>
        </form>

    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>
