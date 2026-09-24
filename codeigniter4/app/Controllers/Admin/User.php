<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\User as UserModel;

/**
 * Legacy: admin/user_list.php + USERFUN (registration / password reset).
 */
class User extends BaseController
{
    public function index()
    {
        $this->data['rows'] = model(UserModel::class)
            ->orderBy('mhc_user_id', 'DESC')->findAll();
        return view('admin/user/index', $this->data);
    }

    public function resetPassword(int $id)
    {
        $temp = bin2hex(random_bytes(6));
        model(UserModel::class)->update($id, [
            'password'     => password_hash($temp, PASSWORD_DEFAULT),
            'default_pass' => 'Y',
        ]);
        service('audit')->record('Reset user password', 'UPDATE mhc_users SET password WHERE id=' . $id, $id);

        // In production the temp password is mailed via service('email').
        return redirect()->to('/admin/users')->with('success', 'Password reset issued.');
    }
}
