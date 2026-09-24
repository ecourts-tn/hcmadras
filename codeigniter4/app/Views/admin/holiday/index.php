<?= $this->include('admin/_layout_header') ?>
<h1 class="h3">Holidays</h1>
<form method="post" action="/admin/holidays/store" class="row g-2 mb-4"><?= csrf_field() ?>
<div class="col-auto"><input class="form-control" name="holidayname" placeholder="Holiday name" required></div>
<div class="col-auto"><input class="form-control" type="date" name="holiday_from_date"></div>
<div class="col-auto"><input class="form-control" type="date" name="holiday_to_date"></div>
<div class="col-auto"><input class="form-control" type="number" name="year" placeholder="Year" required></div>
<div class="col-auto"><button class="btn btn-primary">Add</button></div></form>
<table class="table table-striped"><thead><tr><th>Name</th><th>From</th><th>To</th><th>Year</th><th></th></tr></thead><tbody>
<?php foreach (($rows ?? []) as $r): ?>
<tr><td><?= esc($r['holidayname']) ?></td><td><?= esc($r['holiday_from_date']) ?></td><td><?= esc($r['holiday_to_date']) ?></td><td><?= esc($r['year']) ?></td>
<td><form method="post" action="/admin/holidays/delete/<?= esc($r['holiday_id']) ?>"><?= csrf_field() ?><button class="btn btn-sm btn-outline-danger">Delete</button></form></td></tr>
<?php endforeach; ?></tbody></table>
<?= $this->include('admin/_layout_footer') ?>
