<?php

namespace App\Controllers;

use App\Models\JudgeMaster;

/**
 * Legacy: judges.php / present_judges.php / former_judges.php / registrars_all.php.
 */
class Judge extends BaseController
{
    public function index()
    {
        $this->data['judges'] = model(JudgeMaster::class)->activeJudges();

        return view('layouts/main', $this->data)
            . view('cms/judges', $this->data)
            . view('layouts/footer', $this->data);
    }

    public function former()
    {
        // former_judges lives in the CMS database (legacy former_judges.php).
        $this->data['judges'] = db_connect('default')
            ->table('former_judges')->orderBy('id', 'DESC')->get()->getResultArray();

        return view('layouts/main', $this->data)
            . view('cms/former_judges', $this->data)
            . view('layouts/footer', $this->data);
    }

    public function registrars()
    {
        $this->data['registrars'] = db_connect('default')
            ->table('registrars')->get()->getResultArray();

        return view('layouts/main', $this->data)
            . view('cms/registrars', $this->data)
            . view('layouts/footer', $this->data);
    }
}
