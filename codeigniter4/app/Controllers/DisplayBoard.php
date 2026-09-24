<?php

namespace App\Controllers;

/**
 * Legacy: display_board*.php – reads from the displayboard DB
 * (CI4 group "display", formerly $DISPLAY_con / $DISPLAY_con_MDU).
 */
class DisplayBoard extends BaseController
{
    public function index()
    {
        return $this->board('display');
    }

    public function mdu()
    {
        return $this->board('display'); // same schema; MDU instance behind VPN
    }

    private function board(string $group)
    {
        try {
            $db = db_connect($group);
            $this->data['cases'] = $db->table('current_case')->get()->getResultArray();
        } catch (\Throwable $e) {
            log_message('error', 'Display board unavailable: ' . $e->getMessage());
            $this->data['cases'] = [];
        }

        return view('layouts/main', $this->data)
            . view('cms/display_board', $this->data)
            . view('layouts/footer', $this->data);
    }
}
