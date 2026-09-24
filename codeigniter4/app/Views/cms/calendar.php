<?php
/**
 * Converted view for the legacy page of the same name. The original markup
 * (from the flat PHP file) renders here using the data prepared by the
 * corresponding controller method – see App\Controllers.
 */
?>
<h1 class="h3 mb-4"><?= esc($title ?? 'Madras High Court') ?></h1>
<h2 class="h5">Court Holidays <?= esc($year) ?></h2>
<ul>
<?php foreach (($courtHolidays ?? []) as $h): ?>
    <li><?= esc($h['holidaydate']) ?> — <?= esc($h['holidayname']) ?></li>
<?php endforeach; ?>
</ul>
