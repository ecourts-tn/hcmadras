<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Holiday as HolidayModel;

/**
 * Legacy: admin/holiday_add.php / holiday_list.php + HOLIDAYFUN.
 */
class Holiday extends BaseController
{
    public function index()
    {
        $this->data['rows'] = model(HolidayModel::class)->orderBy('year', 'DESC')->findAll();
        return view('admin/holiday/index', $this->data);
    }

    public function store()
    {
        if (! $this->validate([
            'holidayname'       => 'required|max_length[200]',
            'year'              => 'required|integer',
            'holiday_from_date' => 'permit_empty|valid_date',
            'holiday_to_date'   => 'permit_empty|valid_date',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $id = model(HolidayModel::class)->insert($this->request->getPost());
        service('audit')->record('Added holiday', 'INSERT INTO mhc_holiday', (int) $id);

        return redirect()->to('/admin/holidays')->with('success', 'Holiday added.');
    }

    public function delete(int $id)
    {
        model(HolidayModel::class)->delete($id);
        service('audit')->record('Deleted holiday', 'DELETE FROM mhc_holiday WHERE holiday_id=' . $id, $id);

        return redirect()->to('/admin/holidays');
    }
}
