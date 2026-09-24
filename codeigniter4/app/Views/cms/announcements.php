<h1 class="h3 mb-4">Announcements</h1>
<table class="table table-striped align-middle">
    <thead><tr><th>#</th><th>Announcement</th><th>Date</th><th></th></tr></thead>
    <tbody>
    <?php $n = 1; foreach (($announcements ?? []) as $an): ?>
        <tr>
            <td><?= $n++ ?></td>
            <td><?= $an['an_text'] /* trusted CMS HTML */ ?></td>
            <td class="text-nowrap small"><?= esc($an['an_update_date']) ?></td>
            <td><a class="btn btn-sm btn-outline-primary" href="<?= base_url('announcement/pdf/' . $an['an_id']) ?>">View</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
