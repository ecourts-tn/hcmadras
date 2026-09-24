<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Base model for the primary CMS database (legacy $DB_con -> hcmadrasn).
 * All mhc_* content tables live here.
 */
abstract class BaseModel extends Model
{
    protected $DBGroup = 'default';
    protected $useTimestamps = false;
    protected $returnArray = true;
}
