<?php

/**
 * Site helper for the Madras High Court portal.
 *
 * Replaces small utility functions that were defined in the legacy
 * flat-file application (header.php / menu_s.php / config.php).
 *
 * Loaded automatically by BaseController via $helpers = ['site'].
 */

use CodeIgniter\I18n\Time;

if (! function_exists('site_uri')) {
    /**
     * Returns the URI string of the current request (without the base URL),
     * e.g. "case-status" or "admin/announcements". Used to mark the active
     * item in the main/side menus, mirroring the legacy $_SERVER['PHP_SELF']
     * comparisons.
     */
    function site_uri(): string
    {
        static $uri = null;

        if ($uri === null) {
            $request = service('request');
            $uri     = trim($request->uri->getPath(), '/ ');
        }

        return $uri;
    }
}

if (! function_exists('is_current_url')) {
    /**
     * True when the given relative path matches the current request URI.
     * Accepts an array of aliases so a parent menu stays highlighted on
     * child pages (e.g. 'cause-list' matches 'cause-list/mas').
     */
    function is_current_url(string|array $paths): bool
    {
        $current = site_uri();

        foreach ((array) $paths as $path) {
            $path = trim(base_url($path), '/ ');

            if ($current === $path || str_starts_with($current, $path . '/')) {
                return true;
            }
        }

        return false;
    }
}

if (! function_exists('format_case_date')) {
    /**
     * Legacy date display format used across the portal: dd-mm-yyyy.
     */
    function format_case_date(?string $date, string $format = 'd-m-Y'): string
    {
        if (empty($date) || $date === '0000-00-00' || str_starts_with($date, '0000')) {
            return '';
        }

        try {
            return Time::parse($date)->format($format);
        } catch (\Throwable $e) {
            return $date;
        }
    }
}

if (! function_exists('format_case_time')) {
    /**
     * Legacy time display format: hh:mm (24h) — used on cause lists and
     * the display board.
     */
    function format_case_time(?string $time): string
    {
        if (empty($time)) {
            return '';
        }

        return date('H:i', strtotime($time));
    }
}

if (! function_exists('clean_case_text')) {
    /**
     * Trims and normalises whitespace coming from the CIS PostgreSQL
     * columns (many are CHAR padded).
     */
    function clean_case_text(?string $text): string
    {
        return trim(preg_replace('/\s+/', ' ', (string) $text));
    }
}
