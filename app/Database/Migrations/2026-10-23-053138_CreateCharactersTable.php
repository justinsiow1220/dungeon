<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCharactersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'character-id' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'character-name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'character-class' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'character-level' => ['type' => 'INT'],
            'character-xp'    => ['type' => 'INT'],
            'character-hp'    => ['type' => 'INT'],
            'character-mp'    => ['type' => 'INT'],
            'character-atk'   => ['type' => 'INT'],
        ]);

        $this->forge->addKey('character-id', true);
        $this->forge->createTable('characters');
    }

    public function down()
    {
        $this->forge->dropTable('characters');
    }
}