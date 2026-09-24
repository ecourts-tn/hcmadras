<?php
/**
 * Converted view for the legacy page of the same name. The original markup
 * (from the flat PHP file) renders here using the data prepared by the
 * corresponding controller method – see App\Controllers.
 */
?>
<h1 class="h3 mb-4"><?= esc($title ?? 'Madras High Court') ?></h1>
<form method="post" action="<?= base_url('feedback/submit') ?>">
    <?= csrf_field() ?>
    <div class="mb-3"><label class="form-label">E-mail</label><input class="form-control" name="email_id" required></div>
    <div class="mb-3"><label class="form-label">OTP</label><input class="form-control" name="otp" required></div>
    <div class="mb-3"><label class="form-label">Comments</label><textarea class="form-control" name="comments" required></textarea></div>
    <button class="btn btn-primary">Submit Feedback</button>
</form>
