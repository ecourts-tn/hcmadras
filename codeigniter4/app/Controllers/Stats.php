<?php

namespace App\Controllers;

use App\Models\VisitorLog;

/**
 * Legacy: get_data.php – daily visitor counts for the admin dashboard.
 */
class Stats extends BaseController
{
    public function daily()
    {
        $today = db_connect('default')
            ->table('visitor_logs')
            ->where('date(created)', date('Y-m-d'))
            ->countAllResults();

        return $this->response->setJSON(['date' => date('Y-m-d'), 'visits' => $today]);
    }
}
