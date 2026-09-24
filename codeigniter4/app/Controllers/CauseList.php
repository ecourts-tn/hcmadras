<?php

namespace App\Controllers;

use App\Models\CauseList as CauseListModel;

/**
 * Legacy: cause_list*.php family (by court / judge / case / advocate / party).
 */
class CauseList extends BaseController
{
    public function index()
    {
        return view('layouts/main', $this->data)
            . view('cms/cause_list', $this->data)
            . view('layouts/footer', $this->data);
    }

    private function listFor(callable $query)
    {
        $date = (string) ($this->request->getPost('cl_date') ?: date('Y-m-d'));
        $this->data['date']  = $date;
        $this->data['rows']  = $query(new CauseListModel(), $date);

        return view('layouts/main', $this->data)
            . view('cms/cause_list_result', $this->data)
            . view('layouts/footer', $this->data);
    }

    public function byCourt()
    {
        return $this->listFor(fn ($m, $d) => $m->byCourt((string) $this->request->getPost('court_code'), $d));
    }

    public function byJudge()
    {
        return $this->listFor(fn ($m, $d) => $m->byJudge((string) $this->request->getPost('jud_code'), $d));
    }

    public function byCase()
    {
        return $this->listFor(fn ($m, $d) => $m->byCaseNumber(
            (string) $this->request->getPost('case_type'),
            (string) $this->request->getPost('case_no'),
            (int) $this->request->getPost('case_year'),
            $d
        ));
    }

    public function byAdvocate()
    {
        return $this->listFor(fn ($m, $d) => $m->byAdvocateName((string) $this->request->getPost('adv_name'), $d));
    }

    public function byParty()
    {
        return $this->listFor(fn ($m, $d) => $m->byPartyName((string) $this->request->getPost('party_name'), $d));
    }
}
