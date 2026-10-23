<?php

namespace App\Models;

use CodeIgniter\Model;

class MonsterModel extends Model
{
    protected $table = 'monsters';
    protected $primaryKey = 'monster-id';

    protected $allowedFields = [
        'monster-name',
        'monster-hp',
        'monster-atk',
        'monster-mp',
        'monster-level',
        'monster-xp',
    ];
}
