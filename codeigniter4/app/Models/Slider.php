<?php

namespace App\Models;

/**
 * Legacy: admin/function/slid_fun.php – table mhc_sliders.
 */
class Slider extends BaseModel
{
    protected $table      = 'mhc_sliders';
    protected $primaryKey = 'slider_id';
    protected $allowedFields = [
        'bench', 'slider_name', 'slider_img', 'slider_order',
        'slider_up_date', 'slider_display', 'mhc_user', 'slider_url',
    ];

    public function activeList(?string $bench = null): array
    {
        $builder = $this->where('slider_display', 'Y');
        if ($bench !== null) {
            $builder->where('bench', $bench);
        }
        return $builder->orderBy('slider_order')->findAll();
    }
}
