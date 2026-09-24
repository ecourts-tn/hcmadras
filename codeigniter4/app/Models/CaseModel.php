<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Base model for the eCourts CIS databases (legacy $HCMAS_DB / $CIS_DB /
 * $MDU_HCMAS_DB from config/dbconfig_status.php). These are external,
 * read-only schemas – no migrations are ever run against them.
 */
abstract class CaseModel extends Model
{
    protected $DBGroup     = 'hcmas';   // main bench: hc_cis_mas
    protected $tempAllowCallbacks = true;
    protected $useTimestamps = false;
    protected $allowedFields = [];      // read-only
    protected $useAutoIncrement = false;

    /** Convenience alias used by the MDU-bench variants of the legacy pages. */
    protected function mdu(): static
    {
        $this->DBGroup = 'mduhcmas';
        return $this;
    }
}
