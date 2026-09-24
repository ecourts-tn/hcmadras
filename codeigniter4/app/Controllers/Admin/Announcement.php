<?php

namespace App\Controllers\Admin;

/**
 * Legacy: admin/ann_add.php / ann_edit.php / ann_del.php + ANNOFUN class.
 */
class Announcement extends BaseCrud
{
    protected string $modelClass = \App\Models\Announcement::class;
    protected string $viewPrefix = 'admin/announcement';
    protected string $itemLabel  = 'Announcement';
    protected array $validationRules = [
        'an_text' => 'required|max_length[500]',
    ];
}
