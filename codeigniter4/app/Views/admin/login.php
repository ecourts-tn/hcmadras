<!DOCTYPE html>
<html lang="en">
<head><meta charset="utf-8"><title>Admin Login – Madras High Court</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"></head>
<body class="bg-light">
<div class="container" style="max-width:420px;margin-top:10vh">
    <div class="card shadow-sm"><div class="card-body">
        <h1 class="h4 mb-3">MHC Admin Login</h1>
        <?php if (session('error')): ?><div class="alert alert-danger"><?= esc(session('error')) ?></div><?php endif; ?>
        <form method="post" action="<?= base_url('admin/login') ?>">
            <?= csrf_field() ?>
            <div class="mb-3"><label class="form-label">Username</label>
                <input class="form-control" name="username" required autofocus></div>
            <div class="mb-3"><label class="form-label">Password</label>
                <input class="form-control" type="password" name="password" required></div>
            <button class="btn btn-primary w-100">Login</button>
        </form>
    </div></div>
</div>
</body></html>
