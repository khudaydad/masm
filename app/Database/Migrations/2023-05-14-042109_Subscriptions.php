<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Subscriptions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'device_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
            ],
            'client_token' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
                'unique'        => true,
            ],
            'receipt' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
                'unique'        => true,
            ],
            'start_date' => [
                'type'          => 'DATE',
            ],
            'end_date' => [
                'type'          => 'DATE',
            ],
            'status' => [
                'type'          => 'ENUM',
                'constraint'    => ['active', 'canceled', 'expired'],
                'default'       => 'active',
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey(['client_token', 'receipt', 'status']);
        $this->forge->addKey(['end_date', 'status']);
        $this->forge->createTable('subscriptions');
    }

    public function down()
    {
        $this->forge->dropTable('subscriptions');
    }
}
