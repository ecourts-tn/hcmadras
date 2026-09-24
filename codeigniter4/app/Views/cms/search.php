<h1 class="h3 mb-4">Search</h1>
<form action="<?= base_url('search/results') ?>" method="post" class="row g-2">
    <?= csrf_field() ?>
    <div class="col-auto"><input class="form-control" name="search_for" placeholder="Enter keyword" required></div>
    <div class="col-auto"><button class="btn btn-primary">Search</button></div>
</form>
