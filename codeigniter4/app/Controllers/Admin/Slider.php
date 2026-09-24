<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Slider as SliderModel;

/**
 * Legacy: admin/slid_list.php + SLIDFUN (display toggle / ordering).
 */
class Slider extends BaseController
{
    public function index()
    {
        $this->data['rows'] = model(SliderModel::class)->orderBy('slider_order')->findAll();
        return view('admin/slider/index', $this->data);
    }

    public function toggle(int $id)
    {
        $model = model(SliderModel::class);
        $row   = $model->find($id);
        if ($row) {
            $model->update($id, ['slider_display' => $row['slider_display'] === 'Y' ? 'N' : 'Y']);
            service('audit')->record('Toggled slider display', 'UPDATE mhc_sliders SET slider_display WHERE slider_id=' . $id, $id);
        }
        return redirect()->to('/admin/sliders');
    }
}
