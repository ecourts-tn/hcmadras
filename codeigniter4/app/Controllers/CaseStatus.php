<?php

namespace App\Controllers;

use App\Models\CaseInfo;

/**
 * Legacy: case_status_mas.php + case_status_result*.php (+ _mdu variants).
 */
class CaseStatus extends BaseController
{
    public function index()
    {
        return view('layouts/main', $this->data)
            . view('cms/case_status', $this->data)
            . view('layouts/footer', $this->data);
    }

    public function byCaseNumber()
    {
        if (! $this->validate([
            'case_type' => 'required|max_length[10]',
            'case_no'   => 'required|max_length[20]',
            'case_year' => 'required|integer',
        ])) {
            return redirect()->to('/case-status')->with('error', 'Invalid case number search.');
        }

        $model = model(CaseInfo::class);
        $case  = $model->findByCaseNumber(
            (string) $this->request->getPost('case_type'),
            (string) $this->request->getPost('case_no'),
            (int) $this->request->getPost('case_year')
        ) ?? $model->findByCaseNumber(
            (string) $this->request->getPost('case_type'),
            (string) $this->request->getPost('case_no'),
            (int) $this->request->getPost('case_year'),
            true // fall back to the archive table civil_t_a
        );

        return $this->showResult($case);
    }

    public function byCnrNumber()
    {
        if (! $this->validate(['cnr_number' => 'required|max_length[30]'])) {
            return redirect()->to('/case-status')->with('error', 'Invalid CNR number.');
        }

        $model = model(CaseInfo::class);
        $case  = $model->findByCnrNumber((string) $this->request->getPost('cnr_number'));

        return $this->showResult($case);
    }

    public function byParty()
    {
        // Placeholder for legacy party-name search across case_info(_a):
        // kept as form redirect until the multi-table join queries are ported.
        return redirect()->to('/case-status');
    }

    public function byFiling()
    {
        return redirect()->to('/case-status');
    }

    private function showResult(?array $case)
    {
        $this->data['case'] = $case;
        if ($case) {
            $model = model(CaseInfo::class);
            $archived = ! array_key_exists('next_date', $case) || empty($case['next_date']);
            $this->data['proceedings'] = $model->dailyProceedings($case, $archived);
            $this->data['typeName']    = $model->caseTypeName($case['case_type']);
        }

        return view('layouts/main', $this->data)
            . view('cms/case_status_result', $this->data)
            . view('layouts/footer', $this->data);
    }
}
