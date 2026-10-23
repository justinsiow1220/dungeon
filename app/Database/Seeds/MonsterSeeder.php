<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MonsterSeeder extends Seeder
{
    public function run()
    {
        $monsters = [
            [
                'monster-name'   => 'Slime',
                'monster-hp'     => 30,
                'monster-atk' => 5,
                'monster-mp' => 0,
                'monster-level' => 1,
                'monster-xp' => 10,
            ],
            [
                'monster-name'   => 'Skeleton',
                'monster-hp'     => 50,
                'monster-atk' => 10,
                'monster-mp' => 0,
                'monster-level' => 2,
                'monster-xp' => 25,
            ],
            [
                'monster-name'   => 'Goblin',
                'monster-hp'     => 40,
                'monster-atk' => 8,
                'monster-mp' => 0,
                'monster-level' => 1,
                'monster-xp' => 15,
            ],
        ];

        $this->db->table('monsters')->insertBatch($monsters);
    }
}
