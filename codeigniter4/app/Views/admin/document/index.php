<?= $this->include('admin/_layout_header') ?>
<div class="d-flex justify-content-between"><h1 class="h3">Documents</h1>
<a class="btn btn-primary btn-sm" href="/admin/documents/create">Add New</a></div>
<table class="table table-striped align-middle"><thead><tr><th>ID</th><th>Text</th><th>Date</th><th>Display</th><th></th></tr></thead><tbody>
<?php foreach (($rows ?? []) as $r): ?>
<tr><td><?= esc($r['doc_id']) ?></td><td><?= mb_strimwidth(strip_tags((string)$r['doc_title']),0,120,'…') ?></td>
<td><?= esc($r['doc_f_date'] ?? '') ?></td><td><?= esc($r['display'] ?? '') ?></td>
<td>
 <a class="btn btn-sm btn-outline-secondary" href="/admin/documents/edit/<?= esc($r['doc_id']) ?>">Edit</a>
 <form class="d-inline" method="post" action="/admin/documents/delete/<?= esc($r['doc_id']) ?>"><?= csrf_field() ?><button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">Delete</button></form>
</td></tr>
<?php endforeach; ?>
</tbody></table>
<?= $this->include('admin/_layout_footer') ?>
