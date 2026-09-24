<?php

namespace App\Models;

/**
 * Legacy: judges.php / present_judges.php / cause_judment*.php lookups.
 * Tables: judge_name_t (CIS db) and judges / former_judges (CMS db helpers).
 */
class JudgeMaster extends CaseModel
{
    protected $table      = 'judge_name_t';
    protected $primaryKey = 'jud_code';

    public function activeJudges(): array
    {
        return $this->where('display', 'Y')
                    ->orderBy('jud_code')
                    ->findAll();
    }

    public function nameByCode(string $code): string
    {
        $row = $this->find(strtoupper(trim($code)));
        return $row['judge_name'] ?? '';
    }
}
