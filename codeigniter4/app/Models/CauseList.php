<?php

namespace App\Models;

/**
 * Legacy: cause_list*.php (by court / judge / case number / advocate / party).
 * Table: cause_list (+ cause_list_a archive) on the CIS database.
 */
class CauseList extends CaseModel
{
    protected $table      = 'cause_list';
    protected $primaryKey = 'id';

    public function byCourt(string $courtCode, string $date): array
    {
        return $this->where('court_code', $courtCode)
                    ->where('cl_date', $date)
                    ->orderBy('serial_no')
                    ->findAll();
    }

    public function byJudge(string $judgeCode, string $date): array
    {
        return $this->where('jud_code', $judgeCode)
                    ->where('cl_date', $date)
                    ->orderBy('serial_no')
                    ->findAll();
    }

    public function byCaseNumber(string $caseType, string $caseNo, int $year, string $date): array
    {
        return $this->where('case_type', $caseType)
                    ->where('case_no', $caseNo)
                    ->where('case_year', $year)
                    ->where('cl_date', $date)
                    ->findAll();
    }

    public function byAdvocateName(string $advName, string $date): array
    {
        return $this->like('advocate_name', trim($advName))
                    ->where('cl_date', $date)
                    ->findAll();
    }

    public function byPartyName(string $partyName, string $date): array
    {
        return $this->like('party_name', trim($partyName))
                    ->where('cl_date', $date)
                    ->findAll();
    }
}
