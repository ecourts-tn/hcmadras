<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * Extended by every controller in the converted Madras High Court portal.
 * The shared view data replaces the globals that the legacy includes
 * (header.php / footer.php / sidebar_*.php) relied on.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon class instantiation.
     */
    protected $helpers = ['url', 'form', 'text'];

    /** Data shared with all views (layout chrome: menu, announcements…). */
    protected array $data = [];

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // Asia/Kolkata – same as legacy date_default_timezone_set() calls.
        \CodeIgniter\I18n\Time::setTestNow();
        date_default_timezone_set('Asia/Kolkata');

        $this->data['title']      = 'Madras High Court';
        $this->data['session']    = session();
        $this->data['currentUrl'] = site_uri();
    }
}
