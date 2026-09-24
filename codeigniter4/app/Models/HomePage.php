<?php

namespace App\Models;

/**
 * Legacy: admin/function/home_fun.php – tables mhc_homepage & home_gallery.
 */
class HomePage extends BaseModel
{
    protected $table      = 'mhc_homepage';
    protected $primaryKey = 'h_id';
    protected $allowedFields = [
        'home_title', 'home_desc', 'display', 'thumb_img', 'page_url',
        'short_desc', 'page_order', 'page', 'ntab', 'external',
    ];

    public function activeList(): array
    {
        return $this->where('display', 'Y')->orderBy('h_id', 'DESC')->findAll();
    }
}
