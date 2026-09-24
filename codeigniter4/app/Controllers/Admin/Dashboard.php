<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserLog;

/**
 * Legacy: admin/dashboard.php + admin_dashboard.php.
 */
class Dashboard extends BaseController
{
    public function index()
    {
        $this->data['recentLogs'] = model(UserLog::class)->recent(20);
        $this->data['visitsToday'] = db_connect('default')
            ->table('visitor_logs')
            ->where('date(created)', date('Y-m-d'))
            ->countAllResults();

        return view('admin/dashboard', $this->data);
    }
}
