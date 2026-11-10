<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateApplicationTracking extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'tracking_code' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
            ],
            'service_key' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
            ],
            'application_id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('tracking_code');
        $this->forge->addUniqueKey(['service_key', 'application_id']);
        $this->forge->createTable('application_tracking', true);
    }

    public function down()
    {
        $this->forge->dropTable('application_tracking', true);
    }
}