
<?php
require_once __DIR__ . '/../koneksi.php';

$judul = 'Data Supplier';

$stmt = $pdo->query(
    'SELECT id, name, address, phone, email
     FROM suppliers
     ORDER BY id DESC'
);

$suppliers = $stmt->fetchAll();

include __DIR__ . '/../header.php';
?>

<div class="mb-4">
    <h1 class="h3 fw-bold">Data Supplier</h1>
    <p class="text-muted">Daftar data supplier yang tersimpan.</p>
</div>

<div class="mb-3">
    <a href="tambah.php" class="btn btn-secondary">
        + Tambah Supplier
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
                        <th>Alamat</th>
                        <th>No. Telepon</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (count($suppliers) > 0): ?>
                        <?php foreach ($suppliers as $index => $supplier): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= e($supplier['name']) ?></td>
                                <td><?= e($supplier['address']) ?></td>
                                <td><?= e($supplier['phone']) ?></td>
                                <td><?= e($supplier['email']) ?></td>
                                <td>
                                    <a href="edit.php?id=<?= (int) $supplier['id'] ?>"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="hapus.php" method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus supplier ini?')">

                                        <input type="hidden" name="id"
                                               value="<?= (int) $supplier['id'] ?>">

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
                            <td colspan="6" class="text-center">
                                Belum ada data supplier.
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
