<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Madras High Court') ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">Madras High Court</a>
        <div class="collapse navbar-collapse show">
            <ul class="navbar-nav me-auto">
                <?php foreach (($menus ?? []) as $menu): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= esc(base_url('page/' . url_title($menu['page_name'], '-', true))) ?>">
                            <?= esc($menu['page_name']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <form class="d-flex" action="<?= url_action('Search::results') ?>" method="post">
                <?= csrf_field() ?>
                <input class="form-control me-2" type="search" name="search_for" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light" type="submit">Go</button>
            </form>
        </div>
    </div>
</nav>
<main class="container my-4">
