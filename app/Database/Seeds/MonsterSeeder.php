<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MonsterSeeder extends Seeder
{
    public function run()
    {
        $monsters = [
            [
                'name'   => 'Slime',
                'hp'     => 30,
                'attack' => 5,
            ],
            [
                'name'   => 'Skeleton',
                'hp'     => 50,
                'attack' => 10,
            ],
            [
                'name'   => 'Goblin',
                'hp'     => 40,
                'attack' => 8,
            ],
        ];

        $this->db->table('monsters')->insertBatch($monsters);
    }
}
