<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Devices extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'uid' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
            ],
            'app_id' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
            ],
            'language' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
                'null'          => true,
            ],
            'os' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
                'null'          => true,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['uid', 'app_id']);
        $this->forge->createTable('devices');
    }

    public function down()
    {
        $this->forge->dropTable('devices');
    }
}
