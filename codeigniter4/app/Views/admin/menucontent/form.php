<?= $this->include('admin/_layout_header') ?>
<h1 class="h3"><?= empty($row) ? 'Add' : 'Edit' ?> Page Content</h1>
<form method="post" action="<?= empty($row) ? '/admin/menu-content/store' : '/admin/menu-content/update/' . $row['h_id'] ?>">
<?= csrf_field() ?>
<div class="mb-3"><label class="form-label">Title</label><input class="form-control" name="title" value="<?= esc($row['title'] ?? '') ?>" required></div>
<div class="mb-3"><label class="form-label">Content (HTML)</label><textarea class="form-control" name="m_desc" rows="12"><?= esc($row['m_desc'] ?? '') ?></textarea></div>
<button class="btn btn-primary">Save</button></form>
<?= $this->include('admin/_layout_footer') ?>
