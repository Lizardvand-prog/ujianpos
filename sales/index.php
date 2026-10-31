
<?php
require_once __DIR__ . '/../koneksi.php';

$judul = 'Data Sales';

$stmt = $pdo->query(
    'SELECT sales.id, sales.supplier_id, sales.total, suppliers.name AS supplier_name
     FROM sales
     INNER JOIN suppliers ON sales.supplier_id = suppliers.id
     ORDER BY sales.id DESC'
);

$sales = $stmt->fetchAll();

include __DIR__ . '/../header.php';
?>

<div class="mb-4">
    <h1 class="h3 fw-bold">Data Sales</h1>
    <p class="text-muted">Daftar data penjualan yang tersimpan.</p>
</div>

<div class="mb-3">
    <a href="tambah.php" class="btn btn-primary">
        + Tambah Sales
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No.</th>
                        <th>Nama Supplier</th>
                        <th>Total Penjualan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (count($sales) > 0): ?>
                        <?php foreach ($sales as $index => $item): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= e($item['supplier_name']) ?></td>
                                <td>
                                    Rp <?= number_format((int) $item['total'], 0, ',', '.') ?>
                                </td>
                                <td>
                                    <a href="edit.php?id=<?= (int) $item['id'] ?>"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="hapus.php" method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus data sales ini?')">

                                        <input type="hidden" name="id"
                                               value="<?= (int) $item['id'] ?>">

                                        <input type="hidden" name="csrf_token"
                                               value="<?= e(csrfToken()) ?>">

                                        <button type="submit"
                                                class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">
                                Belum ada data sales.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <a href="../index.php" class="btn btn-secondary">
            Kembali
        </a>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>
