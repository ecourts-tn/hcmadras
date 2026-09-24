<?= $this->include('admin/_layout_header') ?>
<h1 class="h3">Dashboard</h1>
<p>Visits today: <b><?= esc($visitsToday ?? 0) ?></b></p>
<h2 class="h5">Recent admin activity</h2>
<table class="table table-sm table-striped">
<thead><tr><th>User</th><th>Action</th><th>Message</th><th>Date</th></tr></thead><tbody>
<?php foreach (($recentLogs ?? []) as $log): ?>
<tr><td><?= esc($log['user_id']) ?></td><td><?= esc($log['action']) ?></td><td><?= esc($log['message']) ?></td><td><?= esc($log['created_on'] ?? '') ?></td></tr>
<?php endforeach; ?>
</tbody></table>
<?= $this->include('admin/_layout_footer') ?>
