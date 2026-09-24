<div class="row">
    <div class="col-md-9">
        <?php if (! empty($sliders)): ?>
        <div id="homeCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
            <div class="carousel-inner rounded">
                <?php foreach ($sliders as $i => $slide): ?>
                <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
                    <img src="/uploads/slider/<?= esc($slide['slider_img']) ?>" class="d-block w-100" alt="<?= esc($slide['slider_name'] ?? '') ?>">
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="row g-3">
            <?php foreach (($cards ?? []) as $card): ?>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?= esc($card['home_title']) ?></h5>
                        <p class="card-text small"><?= esc($card['short_desc'] ?: strip_tags((string) $card['home_desc'])) ?></p>
                        <a href="<?= esc($card['external'] === 'Y' ? $card['page_url'] : base_url('page/' . url_title($card['home_title'], '-', true))) ?>" class="stretched-link small">Read more</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <aside class="col-md-3">
        <div class="card">
            <div class="card-header fw-bold">Latest Announcements</div>
            <ul class="list-group list-group-flush">
                <?php foreach (array_slice($announcements ?? [], 0, 10) as $an): ?>
                <li class="list-group-item small">
                    <a href="<?= base_url('announcement/pdf/' . $an['an_id']) ?>"><?= esc(mb_strimwidth(strip_tags($an['an_text']), 0, 90, '…')) ?></a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </aside>
</div>
