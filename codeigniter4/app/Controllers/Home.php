<?php

namespace App\Controllers;

use App\Models\Announcement;
use App\Models\Document;
use App\Models\HomePage;
use App\Models\MenuItem;
use App\Models\Slider;

/**
 * Legacy: index.php + index_data.php + sidebar_r.php (latest updates block).
 */
class Home extends BaseController
{
    public function index()
    {
        $this->data['menus'] = model(MenuItem::class)->topLevel('M');
        $this->data['cards'] = model(HomePage::class)->activeList();
        $this->data['sliders'] = model(Slider::class)->activeList();
        $this->data['announcements'] = model(Announcement::class)->activeList();
        $this->data['documents'] = model(Document::class)->activeList();

        return view('layouts/main', $this->data) . view('home/index', $this->data) . view('layouts/footer', $this->data);
    }
}
