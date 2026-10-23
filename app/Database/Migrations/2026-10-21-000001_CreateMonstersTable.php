<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMonstersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'monster-id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'monster-name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'monster-hp' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'monster-atk' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'monster-mp' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'monster-level' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'monster-xp' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
        ]);

        $this->forge->addKey('monster-id', true);
        $this->forge->createTable('monsters');
    }

    public function down()
    {
        $this->forge->dropTable('monsters');
    }
}
