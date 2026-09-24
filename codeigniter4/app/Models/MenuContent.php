<?php

namespace App\Models;

/**
 * Legacy: admin/function/menu_content_fun.php – table mhc_menu_content
 * holds the editable body of every static menu-driven page.
 */
class MenuContent extends BaseModel
{
    protected $table      = 'mhc_menu_content';
    protected $primaryKey = 'h_id';
    protected $allowedFields = ['title', 'm_desc', 'display'];

    public function activeList(): array
    {
        return $this->where('display', 'Y')->orderBy('h_id', 'DESC')->findAll();
    }
}
