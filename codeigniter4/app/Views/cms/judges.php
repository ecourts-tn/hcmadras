<?php
/**
 * Converted view for the legacy page of the same name. The original markup
 * (from the flat PHP file) renders here using the data prepared by the
 * corresponding controller method – see App\Controllers.
 */
?>
<h1 class="h3 mb-4"><?= esc($title ?? 'Madras High Court') ?></h1>
<table class="table table-striped">
    <thead><tr><th>#</th><th>Judge Name</th></tr></thead>
    <tbody>
    <?php $n = 1; foreach (($judges ?? []) as $j): ?>
        <tr><td><?= $n++ ?></td><td><?= esc($j['judge_name'] ?? $j['name'] ?? '') ?></td></tr>
    <?php endforeach; ?>
    </tbody>
</table>
