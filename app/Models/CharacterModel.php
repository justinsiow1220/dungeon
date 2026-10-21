<?php

namespace App\Models;

use CodeIgniter\Model;

class CharacterModel extends Model
{
    protected $table = 'characters';
    protected $primaryKey = 'character-id';

    protected $allowedFields = [
        'character-name',
        'character-class',
        'character-hp',
        'character-atk',
        'character-mp',
        'character-level',
        'character-xp',
    ];
}
