<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Session-based authentication guard for the admin area.
 * Replaces the per-page `include 'session_check.php'` style checks
 * used throughout the legacy application.
 */
class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = service('session');

        if (! $session->has('user_session')) {
            return service('response')
                ->redirect(site_url('admin/login'));
        }

        // Idle-timeout (30 minutes), mirroring legacy admin/login.php behaviour.
        $lastAction = $session->get('last_action');
        if ($lastAction !== null && (time() - (int) $lastAction) > 30 * 60) {
            $session->destroy();

            return service('response')->redirect(site_url('admin/login'));
        }

        $session->set('last_action', time());
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nothing to do here.
    }
}
