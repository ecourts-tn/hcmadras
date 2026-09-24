<?php

namespace App\Models;

/**
 * Legacy: admin/function/login_fun.php (class lOGIN) + admin/function/user_fun.php
 * Table: mhc_users
 */
class User extends BaseModel
{
    protected $table         = 'mhc_users';
    protected $primaryKey    = 'mhc_user_id';
    protected $allowedFields = [
        'username', 'password', 'full_name', 'designation', 'status', 'roll',
        'mobile', 'email_id', 'menu_id', 'dept', 'court_type', 'dist_id',
        'default_pass', 'session_id', 'login_flag',
    ];

    /**
     * Verify credentials exactly like the legacy login() routine:
     * user must exist with status='A' and password_verify() must pass.
     */
    public function verify(string $username, string $password): ?array
    {
        $row = $this->where('username', $username)
                    ->where('status', 'A')
                    ->first();

        if ($row && password_verify($password, $row['password'])) {
            return $row;
        }

        return null;
    }

    /** Record the DB-side session id / login flag (legacy single-sign-on check). */
    public function markLogin(int $userId): void
    {
        $sessionId = uniqid((string) $userId);
        $this->update($userId, ['session_id' => $sessionId, 'login_flag' => 1]);
    }

    public function clearLogin(int $userId): void
    {
        $this->update($userId, ['login_flag' => 0]);
    }
}
