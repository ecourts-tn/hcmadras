<?php

namespace App\Models;

/**
 * Legacy: admin/function/menu_fun.php + menu_s.php – table mhc_menu.
 */
class MenuItem extends BaseModel
{
    protected $table      = 'mhc_menu';
    protected $primaryKey = 'menu_id';
    protected $allowedFields = [
        'page_name', 'page_url', 'menu_parent_id', 'main_menu_order',
        'sub_menu_order', 'sub_sub_menu_order', 'display', 'menu',
        'class_fun', 'menu_tab', 'set_menu', 'sub_parent_menu_id',
        'external', 'menu_user',
    ];

    /** Top-level menu rows for a bench ('M'=Madras, 'S'=Madurai...). */
    public function topLevel(string $bench = 'S'): array
    {
        return $this->where('menu', $bench)
                    ->where('display', 'Y')
                    ->where('set_menu', 'FM')
                    ->orderBy('main_menu_order')
                    ->orderBy('sub_menu_order')
                    ->orderBy('sub_sub_menu_order')
                    ->findAll();
    }
}
