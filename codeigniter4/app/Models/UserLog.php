<?php

namespace App\Models;

/**
 * Legacy: admin/function/log_fun.php – audit trail of admin actions.
 */
class UserLog extends BaseModel
{
    protected $table      = 'user_logs';
    protected $primaryKey = 'log_id';
    protected $allowedFields = ['user_id', 'page_id', 'ip', 'message', 'action', 'record_id', 'created_on'];

    public function record(int $userId, int $pageId, string $ip, string $message, string $action, ?int $recordId = null): void
    {
        $this->insert([
            'user_id'   => $userId,
            'page_id'   => $pageId,
            'ip'        => $ip,
            'message'   => $message,
            'action'    => $action,
            'record_id' => $recordId,
        ]);
    }

    public function recent(int $limit = 100): array
    {
        return $this->orderBy('log_id', 'DESC')->findAll($limit);
    }
}
