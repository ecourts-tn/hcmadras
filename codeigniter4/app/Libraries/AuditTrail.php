<?php

namespace App\Libraries;

use App\Models\UserLog;

/**
 * Replaces the legacy $log_fun->user_logs(...) calls that were repeated in
 * every admin/function/*_fun.php file. Inject via Services or instantiate
 * directly inside controllers.
 */
class AuditTrail
{
    public function record(string $message, string $action, ?int $recordId = null, ?int $pageId = null): void
    {
        $session = service('session');

        if (! $session->has('user_session')) {
            return; // nothing to attribute
        }

        model(UserLog::class)->record(
            (int) $session->get('user_session'),
            $pageId ?? 0,
            service('request')->IPAddress() ?? '0.0.0.0',
            $message,
            $action,
            $recordId
        );
    }
}
