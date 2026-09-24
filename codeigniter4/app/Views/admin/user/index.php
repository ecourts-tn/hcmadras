<?= $this->include('admin/_layout_header') ?>
<h1 class="h3">Users</h1>
<table class="table table-striped"><thead><tr><th>ID</th><th>Username</th><th>Name</th><th>Designation</th><th>Status</th><th></th></tr></thead><tbody>
<?php foreach (($rows ?? []) as $r): ?>
<tr><td><?= esc($r['mhc_user_id']) ?></td><td><?= esc($r['username']) ?></td><td><?= esc($r['full_name']) ?></td><td><?= esc($r['designation']) ?></td><td><?= esc($r['status']) ?></td>
<td><form method="post" action="/admin/users/reset-password/<?= esc($r['mhc_user_id']) ?>"><?= csrf_field() ?><button class="btn btn-sm btn-outline-warning">Reset password</button></form></td></tr>
<?php endforeach; ?></tbody></table>
<?= $this->include('admin/_layout_footer') ?>
