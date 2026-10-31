<?php
require_once __DIR__ . '/../koneksi.php';

$judul = 'Tambah Supplier';
$error = '';

$name = '';
$address = '';
$phone = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
        $error = 'Permintaan tidak valid. Silakan coba lagi.';
    } else {
        $name = trim($_POST['name'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if ($name === '') {
            $error = 'Nama supplier wajib diisi.';
        } elseif (strlen($name) > 50) {
            $error = 'Nama supplier maksimal 50 karakter.';
        } elseif (strlen($address) > 255) {
            $error = 'Alamat maksimal 255 karakter.';
        } elseif (strlen($phone) > 50) {
            $error = 'Nomor telepon maksimal 50 karakter.';
        } elseif (strlen($email) > 50) {
            $error = 'Email maksimal 50 karakter.';
        } elseif ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Format email tidak valid.';
        } else {
            $stmt = $pdo->prepare(
                'INSERT INTO suppliers (name, address, phone, email)
                 VALUES (?, ?, ?, ?)'
            );

            $stmt->execute([
                $name,
                $address,
                $phone,
                $email
            ]);

            setFlash('Supplier berhasil ditambahkan!');
            redirect('index.php');
        }
    }
}

include __DIR__ . '/../header.php';
?>

<div class="mb-4">
    <h1 class="h3 fw-bold">Tambah Supplier</h1>
    <p class="text-secondary">Masukkan informasi supplier baru.</p>


<div class="mb-4">
    <h1 class="h3 fw-bold">Tambah Supplier</h1>
    <p class="text-muted">Silakan isi data supplier berikut.</p>
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
                <label class="form-label">Nama Supplier</label>
                <input type="text" name="name" class="form-control"
                       maxlength="50" required
                       value="<?= e($name) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="address" class="form-control"
                          maxlength="255" rows="3"><?= e($address) ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Nomor Telepon</label>
                <input type="text" name="phone" class="form-control"
                       maxlength="50"
                       value="<?= e($phone) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                       maxlength="50"
                       value="<?= e($email) ?>">
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
