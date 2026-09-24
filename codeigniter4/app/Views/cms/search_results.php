<h1 class="h3 mb-4">Results for “<?= esc($term) ?>”</h1>
<?php if (empty($results)): ?>
    <p>No matching records found.</p>
<?php else: foreach ($results as $r): ?>
    <div class="mb-3">
        <a href="<?= $r['title'] === 'A' ? base_url('announcement/pdf/' . $r['id']) : base_url('document/pdf/' . $r['id']) ?>">
            <?= esc(mb_strimwidth(strip_tags((string) $r['text']), 0, 160, '…')) ?>
        </a>
        <div class="small text-muted"><?= esc($r['an_update_date'] ?? '') ?></div>
    </div>
<?php endforeach; endif; ?>
