<?php

namespace App\Controllers;

use App\Models\CaseHoliday;
use App\Models\Holiday;

/**
 * Legacy: calendar.php / calendar_year.php / get_holidays.php.
 */
class Calendar extends BaseController
{
    public function index()
    {
        return $this->holidays((int) date('Y'));
    }

    public function holidays(int $year)
    {
        $this->data['year'] = $year;
        $this->data['websiteHolidays'] = model(Holiday::class)->forYear($year);
        $this->data['courtHolidays']   = model(CaseHoliday::class)
            ->between($year . '-01-01', $year . '-12-31');

        return view('layouts/main', $this->data)
            . view('cms/calendar', $this->data)
            . view('layouts/footer', $this->data);
    }
}
