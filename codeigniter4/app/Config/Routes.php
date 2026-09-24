<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 *
 * Routes for the Madras High Court website, converted from the legacy
 * flat-file PHP application (each old *.php page maps to a controller method).
 */

// ---- Public portal pages -------------------------------------------------
$routes->get('/', 'Home::index');                                // index.php
$routes->get('home', 'Home::index');
$routes->get('search', 'Search::index');                          // search.php / getSearch.php
$routes->post('search/results', 'Search::results');
$routes->get('contact', 'StaticPage::contact');                   // contact.php
$routes->get('faq', 'StaticPage::faq');                           // faq.php
$routes->get('help', 'StaticPage::help');                         // help.php
$routes->get('downloads', 'StaticPage::downloads');               // downloads_grid.php
$routes->get('webcasting', 'StaticPage::webcasting');             // webcasting.php
$routes->get('rti', 'StaticPage::rti');                           // rti.php
$routes->get('telephone-directory', 'StaticPage::telephone');     // telephone.php
$routes->get('sitemap', 'StaticPage::sitemap');                   // sitemap.php

// ---- CMS content (announcement / documents / menu content) --------------
$routes->get('announcements', 'Announcement::index');             // announcement_grid.php
$routes->get('announcement/pdf/(:num)', 'Announcement::pdf/$1');  // announcement_pdf.php
$routes->get('document/pdf/(:num)', 'Document::download/$1');     // admin/download.php (public side)
$routes->get('page/(:segment)', 'Content::show/$1');              // menu-driven static pages

// ---- Judges & administration info --------------------------------------
$routes->get('judges', 'Judge::index');                           // judges.php / present_judges.php
$routes->get('former-judges', 'Judge::former');                   // former_judges.php
$routes->get('registrars', 'Judge::registrars');                  // registrars_all.php

// ---- Calendar / holidays -------------------------------------------------
$routes->get('calendar', 'Calendar::index');                      // calendar.php
$routes->get('calendar/holidays/(:num)', 'Calendar::holidays/$1');// get_holidays.php

// ---- Case status (eCourts CIS databases) -------------------------------
$routes->get('case-status', 'CaseStatus::index');                 // case_status_mas.php
$routes->post('case-status/by-case-number', 'CaseStatus::byCaseNumber');   // case_status_result.php
$routes->post('case-status/by-cnr-number', 'CaseStatus::byCnrNumber');     // case_status_cnr_result.php
$routes->post('case-status/by-party', 'CaseStatus::byParty');             // case_status_party_result.php
$routes->post('case-status/by-filing', 'CaseStatus::byFiling');           // case_status_filing_result.php
$routes->get('cause-list', 'CauseList::index');                   // cause_list*.php
$routes->post('cause-list/by-court', 'CauseList::byCourt');       // cause_list_court.php
$routes->post('cause-list/by-judge', 'CauseList::byJudge');       // cause_list_jud.php
$routes->post('cause-list/by-case', 'CauseList::byCase');         // cause_list_case.php
$routes->post('cause-list/by-advocate', 'CauseList::byAdvocate'); // cause_list_adv_name.php
$routes->post('cause-list/by-party', 'CauseList::byParty');       // cause_list_party_name.php
$routes->get('display-board', 'DisplayBoard::index');             // display_board.php
$routes->get('display-board/mdu', 'DisplayBoard::mdu');           // display_board_mdu.php

// ---- Feedback (OTP verified, like legacy action.php) -------------------
$routes->get('feedback', 'Feedback::index');                      // feedback.php
$routes->post('feedback/send-otp', 'Feedback::sendOtp');
$routes->post('feedback/submit', 'Feedback::submit');

// ---- Visitor statistics helper -----------------------------------------
$routes->get('visitor-stats', 'Stats::daily');                    // get_data.php

// ---- Admin area ----------------------------------------------------------
$routes->group('admin', ['filter' => 'auth'], static function ($routes): void {
    $routes->get('dashboard', 'Admin\Dashboard::index');          // admin/dashboard.php

    // Announcements
    $routes->get('announcements', 'Admin\Announcement::index');
    $routes->get('announcements/create', 'Admin\Announcement::create');
    $routes->post('announcements/store', 'Admin\Announcement::store');
    $routes->get('announcements/edit/(:num)', 'Admin\Announcement::edit/$1');
    $routes->post('announcements/update/(:num)', 'Admin\Announcement::update/$1');
    $routes->post('announcements/delete/(:num)', 'Admin\Announcement::delete/$1');

    // Documents
    $routes->get('documents', 'Admin\Document::index');
    $routes->get('documents/create', 'Admin\Document::create');
    $routes->post('documents/store', 'Admin\Document::store');
    $routes->get('documents/edit/(:num)', 'Admin\Document::edit/$1');
    $routes->post('documents/update/(:num)', 'Admin\Document::update/$1');
    $routes->post('documents/delete/(:num)', 'Admin\Document::delete/$1');

    // Menu content (static pages)
    $routes->get('menu-content', 'Admin\MenuContent::index');
    $routes->get('menu-content/create', 'Admin\MenuContent::create');
    $routes->post('menu-content/store', 'Admin\MenuContent::store');
    $routes->get('menu-content/edit/(:num)', 'Admin\MenuContent::edit/$1');
    $routes->post('menu-content/update/(:num)', 'Admin\MenuContent::update/$1');
    $routes->post('menu-content/delete/(:num)', 'Admin\MenuContent::delete/$1');

    // Sliders
    $routes->get('sliders', 'Admin\Slider::index');
    $routes->post('sliders/toggle/(:num)', 'Admin\Slider::toggle/$1');

    // Holidays
    $routes->get('holidays', 'Admin\Holiday::index');
    $routes->post('holidays/store', 'Admin\Holiday::store');
    $routes->post('holidays/delete/(:num)', 'Admin\Holiday::delete/$1');

    // Users
    $routes->get('users', 'Admin\User::index');
    $routes->post('users/reset-password/(:num)', 'Admin\User::resetPassword/$1');

    // Audit logs
    $routes->get('logs', 'Admin\Log::index');
});

// Admin authentication (outside the auth filter)
$routes->get('admin/login', 'Admin\Auth::loginForm');
$routes->post('admin/login', 'Admin\Auth::attempt');
$routes->get('admin/logout', 'Admin\Auth::logout');
