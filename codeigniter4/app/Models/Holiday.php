<?php

namespace App\Models;

/**
 * Legacy: admin/function/holiday_fun.php + get_holidays.php.
 * Website holidays live in mhc_holiday (CMS DB); court-holiday calendar
 * rows also exist in holiday_t on the CIS DB (see CaseHoliday model).
 */
class Holiday extends BaseModel
{
    protected $table      = 'mhc_holiday';
    protected $primaryKey = 'holiday_id';
    protected $allowedFields = [
        'holidayname', 'holiday_from_date', 'holiday_to_date', 'year', 'display',
    ];

    public function forYear(int $year): array
    {
        return $this->where('year', $year)->findAll();
    }
}
