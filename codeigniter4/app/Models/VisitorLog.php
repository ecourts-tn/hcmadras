<?php

namespace App\Models;

use CodeIgniter\I18n\Time;

/**
 * Legacy: header.php inserted one row into visitor_logs on EVERY page hit,
 * and config/dbconfig.php moved older rows to visitor_logs_1 at day rollover.
 * In CI4 this is handled by the VisitorLogging filter instead of a global include.
 */
class VisitorLog extends BaseModel
{
    protected $table      = 'visitor_logs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['page_url', 'referrer_url', 'user_ip_address', 'user_agent', 'created'];

    public function logVisit(string $url, string $referrer, string $ip, string $agent): void
    {
        $this->insert([
            'page_url'        => mb_substr($url, 0, 500),
            'referrer_url'    => mb_substr($referrer, 0, 500),
            'user_ip_address' => $ip,
            'user_agent'      => mb_substr($agent, 0, 300),
            'created'         => Time::now()->format('Y-m-d H:i:s'),
        ]);
    }

    /** Archive yesterday's rows into visitor_logs_1 (legacy daily housekeeping). */
    public function archiveOlderThan(string $date): int
    {
        $db = db_connect('default');
        $moved = $db->query(
            'INSERT INTO visitor_logs_1 SELECT * FROM visitor_logs WHERE created < ?',
            [$date]
        ) ? 1 : 0;
        if ($moved) {
            $db->query('DELETE FROM visitor_logs WHERE created < ?', [$date]);
        }
        return $moved;
    }
}
