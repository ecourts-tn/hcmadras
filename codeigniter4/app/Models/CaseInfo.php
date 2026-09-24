<?php

namespace App\Models;

/**
 * Legacy: case_status_result.php / case_status_cnr_result.php /
 * case_status_party_result.php / case_status_filing_result.php and fun_class.php
 * (class GETDETAILS). Tables: civil_t(_a), case_info(_a), daily_proc(_a),
 * order_details(_a), case_type_t, advocate_t.
 */
class CaseInfo extends CaseModel
{
    protected $table      = 'civil_t';
    protected $primaryKey = 'id';

    /** Look up a case by case type / number / year (legacy "by case number"). */
    public function findByCaseNumber(string $caseType, string $caseNo, int $year, bool $archived = false): ?array
    {
        $table = $archived ? 'civil_t_a' : 'civil_t';
        $row = $this->db->table($table)
            ->where('case_type', $caseType)
            ->where('case_no', trim($caseNo))
            ->where('case_year', $year)
            ->get()->getRowArray();
        return $row ?: null;
    }

    public function findByCnrNumber(string $cnrNumber): ?array
    {
        foreach (['civil_t', 'civil_t_a'] as $table) {
            $row = $this->db->table($table)
                ->where('cnr_number', strtolower(trim($cnrNumber)))
                ->get()->getRowArray();
            if ($row) {
                return $row;
            }
        }
        return null;
    }

    /** Daily proceedings (order history) for a case – legacy daily_proc(_a). */
    public function dailyProceedings(array $case, bool $archived = false): array
    {
        $table = $archived ? 'daily_proc_a' : 'daily_proc';
        return $this->db->table($table)
            ->where('case_type', $case['case_type'])
            ->where('case_no', $case['case_no'])
            ->where('case_year', $case['case_year'])
            ->orderBy('c_date', 'DESC')
            ->get()->getResultArray();
    }

    public function caseTypeName(string $caseType): string
    {
        $row = $this->db->table('case_type_t')
            ->select('type_name')
            ->where('case_type', $caseType)
            ->get()->getRowArray();
        return $row['type_name'] ?? '';
    }

    /** Legacy GETDETAILS::getAdvCd – map bar registration no to advocate code. */
    public function advocateCodeByBarNo(string $barNo): string
    {
        $row = $this->db->table('advocate_t')
            ->select('adv_code')
            ->where('adv_reg', trim($barNo))
            ->get()->getRowArray();
        return $row['adv_code'] ?? '';
    }
}
