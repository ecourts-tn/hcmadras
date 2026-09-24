<?php

namespace App\Models;

/**
 * Legacy: get_holidays.php court-calendar half ($HCMAS_DB -> holiday_t).
 */
class CaseHoliday extends CaseModel
{
    protected $table      = 'holiday_t';
    protected $primaryKey = 'holidaydate';

    public function between(string $from, string $to): array
    {
        return $this->notLike('holidayname', 'Saturday Holiday')
                    ->notLike('holidayname', 'Sunday Holiday')
                    ->where('holidaydate >=', $from)
                    ->where('holidaydate <=', $to)
                    ->where('display', 'Y')
                    ->orderBy('holidaydate')
                    ->findAll();
    }
}
