<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserLog;

/**
 * Legacy: admin/log_view.php – browse the user_logs audit trail.
 */
class Log extends BaseController
{
    public function index()
    {
        $this->data['rows'] = model(UserLog::class)->recent(200);
        return view('admin/log/index', $this->data);
    }
}
