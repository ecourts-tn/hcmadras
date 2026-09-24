<?php

namespace Config;

use App\Libraries\AuditTrail;
use CodeIgniter\Config\BaseService;

/**
 * Services Configuration file.
 */
class Services extends BaseService
{
    /**
     * Audit trail helper replacing the legacy $log_fun object that had to be
     * constructed on every admin page.
     */
    public static function audit(?bool $getShared = true): AuditTrail
    {
        if ($getShared) {
            return static::getSharedInstance('audit');
        }

        return new AuditTrail();
    }
}
