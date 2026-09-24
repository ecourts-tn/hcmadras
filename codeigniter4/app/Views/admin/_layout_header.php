<!DOCTYPE html>
<html lang="en"><head><meta charset="utf-8"><title>Admin – Madras High Court</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"></head>
<body>
<nav class="navbar navbar-dark bg-primary"><div class="container-fluid">
  <span class="navbar-brand">MHC CMS Admin</span>
  <div class="d-flex gap-3">
    <a class="text-white" href="/admin/dashboard">Dashboard</a>
    <a class="text-white" href="/admin/announcements">Announcements</a>
    <a class="text-white" href="/admin/documents">Documents</a>
    <a class="text-white" href="/admin/menu-content">Pages</a>
    <a class="text-white" href="/admin/sliders">Sliders</a>
    <a class="text-white" href="/admin/holidays">Holidays</a>
    <a class="text-white" href="/admin/users">Users</a>
    <a class="text-white" href="/admin/logs">Logs</a>
    <a class="text-white" href="/admin/logout">Logout (<?= esc(session('user_name')) ?>)</a>
  </div>
</div></nav>
<main class="container-fluid py-4">
<?php if (session('success')): ?><div class="alert alert-success"><?= esc(session('success')) ?></div><?php endif; ?>
<?php if (session('errors')): ?><div class="alert alert-danger"><?php foreach ((array) session('errors') as $e): ?><?= esc($e) ?><br><?php endforeach; ?></div><?php endif; ?>
