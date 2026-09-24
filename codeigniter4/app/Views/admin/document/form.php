<?= $this->include('admin/_layout_header') ?>
<h1 class="h3"><?= empty($row) ? 'Add' : 'Edit' ?> Document</h1>
<form method="post" action="<?= empty($row) ? '/admin/documents/store' : '/admin/documents/update/' . $row['doc_id'] ?>">
<?= csrf_field() ?>
<div class="mb-3"><label class="form-label">Document text</label>
<textarea class="form-control" name="doc_title" rows="4" required><?= esc($row['doc_title'] ?? '') ?></textarea></div>
<div class="mb-3"><label class="form-label">Order</label><input class="form-control" type="number" name="doc_order" value="<?= esc($row['doc_order'] ?? 0) ?>"></div>
<div class="form-check mb-3"><input class="form-check-input" type="checkbox" name="display" value="Y" <?= ($row['display'] ?? 'Y') === 'Y' ? 'checked' : '' ?>><label class="form-check-label">Display</label></div>
<button class="btn btn-primary">Save</button></form>
<?= $this->include('admin/_layout_footer') ?>
