<?php
/**
 * Converted view for the legacy page of the same name. The original markup
 * (from the flat PHP file) renders here using the data prepared by the
 * corresponding controller method – see App\Controllers.
 */
?>
<h1 class="h3 mb-4"><?= esc($title ?? 'Madras High Court') ?></h1>
<form method="post" action="<?= base_url('case-status/by-case-number') ?>" class="row g-2 col-md-8">
    <?= csrf_field() ?>
    <div class="col-auto"><input class="form-control" name="case_type" placeholder="Case Type (e.g. SA)" required></div>
    <div class="col-auto"><input class="form-control" name="case_no" placeholder="Case Number" required></div>
    <div class="col-auto"><input class="form-control" name="case_year" placeholder="Year" required></div>
    <div class="col-auto"><button class="btn btn-primary">Search</button></div>
</form>
