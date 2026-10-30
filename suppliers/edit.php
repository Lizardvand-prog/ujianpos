<?php
require_once __DIR__ . '/../koneksi.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    redirect('index.php'); 
}

$stmt = $pdo->prepare('SELECT * FROM suppliers WHERE id = ?');
$stmt->execute([$id]);
$supplier = $stmt->fetch();

if (!$supplier) {
    setFlash('Supplier tidak ditemukan.', 'danger');
    redirect('index.php');
}

$judul = 'Edit Supplier';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
        $error = 'Permintaan tidak valid.';
    } else {
        $name = trim($_POST['name'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if ($name === '') {
            $error = 'Nama supplier wajib diisi.';
        } elseif (strlen($name) > 50) {
            $error = 'Nama maksimal 50 karakter.';
        } elseif (strlen($address) > 255) {
            $error = 'Alamat maksimal 255 karakter.';
        } elseif (strlen($phone) > 50) {
            $error = 'Nomor telepon maksimal 50 karakter.';
        } elseif (strlen($email) > 50) {
            $error = 'Email maksimal 50 karakter.';
        } elseif ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Format email tidak valid.';
        } else {
            $update = $pdo->prepare(
                'UPDATE suppliers
                 SET name = ?, address = ?, phone = ?, email = ?
                 WHERE id = ?'
            );

            $update->execute([
                $name,
                $address,
                $phone,
                $email,
                $id
            ]);

            setFlash('Data supplier berhasil diperbarui.');
            redirect('index.php');
        }

        $supplier['name'] = $name;
        $supplier['address'] = $address;
        $supplier['phone'] = $phone;
        $supplier['email'] = $email;
    }
}

include __DIR__ . '/../header.php';
?>

<div class="mb-4">
    <h1 class="h3 fw-bold">Edit Supplier</h1>
    <p class="text-secondary">Perbarui informasi supplier.</p>
</div>

<div class="card shadow-soft">
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
                <label class="form-label">Nama Supplier</label>
                <input type="text" name="name" class="form-control"
                       maxlength="50" required
                       value="<?= e($supplier['name']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="address" class="form-control"
                          maxlength="255" rows="3"><?= e($supplier['address']) ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Nomor Telepon</label>
                <input type="text" name="phone" class="form-control"
                       maxlength="50"
                       value="<?= e($supplier['phone']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                       maxlength="50"
                       value="<?= e($supplier['email']) ?>">
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
