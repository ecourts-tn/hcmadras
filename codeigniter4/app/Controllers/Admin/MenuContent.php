<?php

namespace App\Controllers\Admin;

/**
 * Legacy: admin/menu_content*.php + MENUCONTENTFUN class.
 */
class MenuContent extends BaseCrud
{
    protected string $modelClass = \App\Models\MenuContent::class;
    protected string $viewPrefix = 'admin/menucontent';
    protected string $itemLabel  = 'Menu content';
    protected array $validationRules = [
        'title'  => 'required|max_length[200]',
        'm_desc' => 'permit_empty',
    ];
}
