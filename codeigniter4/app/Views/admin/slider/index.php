<?= $this->include('admin/_layout_header') ?>
<h1 class="h3">Sliders</h1>
<table class="table table-striped"><thead><tr><th>ID</th><th>Name</th><th>Bench</th><th>Order</th><th>Display</th><th></th></tr></thead><tbody>
<?php foreach (($rows ?? []) as $r): ?>
<tr><td><?= esc($r['slider_id']) ?></td><td><?= esc($r['slider_name']) ?></td><td><?= esc($r['bench']) ?></td><td><?= esc($r['slider_order']) ?></td><td><?= esc($r['slider_display']) ?></td>
<td><form method="post" action="/admin/sliders/toggle/<?= esc($r['slider_id']) ?>"><?= csrf_field() ?><button class="btn btn-sm btn-outline-primary">Toggle</button></form></td></tr>
<?php endforeach; ?></tbody></table>
<?= $this->include('admin/_layout_footer') ?>
