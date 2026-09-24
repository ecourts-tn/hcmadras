<?= $this->include('admin/_layout_header') ?>
<h1 class="h3">Audit Log</h1>
<table class="table table-sm table-striped"><thead><tr><th>ID</th><th>User</th><th>Action</th><th>Message</th><th>IP</th><th>Date</th></tr></thead><tbody>
<?php foreach (($rows ?? []) as $l): ?>
<tr><td><?= esc($l['log_id']) ?></td><td><?= esc($l['user_id']) ?></td><td><?= esc($l['action']) ?></td><td><?= esc($l['message']) ?></td><td><?= esc($l['ip']) ?></td><td><?= esc($l['created_on'] ?? '') ?></td></tr>
<?php endforeach; ?></tbody></table>
<?= $this->include('admin/_layout_footer') ?>
