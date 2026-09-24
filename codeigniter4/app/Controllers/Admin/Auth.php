<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\User;

/**
 * Legacy: admin/login.php + admin/function/login_fun.php (class lOGIN).
 */
class Auth extends BaseController
{
    public function loginForm()
    {
        return view('admin/login', $this->data);
    }

    public function attempt()
    {
        if (! $this->validate([
            'username' => 'required|max_length[50]',
            'password' => 'required',
        ])) {
            return redirect()->to('/admin/login')->with('error', 'Invalid username or password.');
        }

        $user = model(User::class)->verify(
            (string) $this->request->getPost('username'),
            (string) $this->request->getPost('password')
        );

        if (! $user) {
            return redirect()->to('/admin/login')->with('error', 'Invalid username or password.');
        }

        $session = session();
        $session->regenerate(true);
        // Same keys as the legacy $_SESSION set-up in login_fun.php.
        $session->set([
            'user_session'  => $user['mhc_user_id'],
            'user_name'     => $user['full_name'],
            'roll'          => $user['roll'],
            'court_type'    => $user['court_type'],
            'usr_dist'      => $user['dist_id'],
            'default_pass'  => $user['default_pass'],
            'dept'          => $user['dept'],
            'uMenu'         => $user['menu_id'],
            'last_action'   => time(),
        ]);

        model(User::class)->markLogin((int) $user['mhc_user_id']);

        return redirect()->to('/admin/dashboard');
    }

    public function logout()
    {
        $session = session();
        if ($session->has('user_session')) {
            model(User::class)->clearLogin((int) $session->get('user_session'));
        }
        $session->destroy();

        return redirect()->to('/admin/login');
    }
}
