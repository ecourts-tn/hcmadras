<?php

namespace App\Controllers;

/**
 * Legacy one-off informational pages: contact.php, faq.php, help.php,
 * downloads_grid.php, webcasting.php, rti.php, telephone.php, sitemap.php.
 * Each becomes a simple template render inside the shared layout.
 */
class StaticPage extends BaseController
{
    private function render(string $view)
    {
        return view('layouts/main', $this->data)
            . view('cms/' . $view, $this->data)
            . view('layouts/footer', $this->data);
    }

    public function contact()     { return $this->render('contact'); }
    public function faq()         { return $this->render('faq'); }
    public function help()        { return $this->render('help'); }
    public function downloads()   { return $this->render('downloads'); }
    public function webcasting()  { return $this->render('webcasting'); }
    public function rti()         { return $this->render('rti'); }
    public function sitemap()     { return $this->render('sitemap'); }

    /** Legacy telephone.php – phone directory from mhc_telephone_diary. */
    public function telephone()
    {
        $this->data['entries'] = db_connect('default')
            ->table('mhc_telephone_diary')
            ->where('display', 'Y')
            ->orderBy('name')
            ->get()->getResultArray();

        return $this->render('telephone');
    }
}
