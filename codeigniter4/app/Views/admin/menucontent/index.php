<?= $this->include('admin/_layout_header') ?>
<div class="d-flex justify-content-between"><h1 class="h3">Pages</h1>
<a class="btn btn-primary btn-sm" href="/admin/menu-content/create">Add New</a></div>
<table class="table table-striped align-middle"><thead><tr><th>ID</th><th>Text</th><th>Date</th><th>Display</th><th></th></tr></thead><tbody>
<?php foreach (($rows ?? []) as $r): ?>
<tr><td><?= esc($r['h_id']) ?></td><td><?= mb_strimwidth(strip_tags((string)$r['title']),0,120,'…') ?></td>
<td><?= esc($r['h_id'] ?? '') ?></td><td><?= esc($r['display'] ?? '') ?></td>
<td>
 <a class="btn btn-sm btn-outline-secondary" href="/admin/menu-content/edit/<?= esc($r['h_id']) ?>">Edit</a>
 <form class="d-inline" method="post" action="/admin/menu-content/delete/<?= esc($r['h_id']) ?>"><?= csrf_field() ?><button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">Delete</button></form>
</td></tr>
<?php endforeach; ?>
</tbody></table>
<?= $this->include('admin/_layout_footer') ?>
