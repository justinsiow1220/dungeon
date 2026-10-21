<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMonstersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'hp' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'attack' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('monsters');
    }

    public function down()
    {
        $this->forge->dropTable('monsters');
    }
}
