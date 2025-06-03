<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateResetTokens extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'correo' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'token' => [
                'type'       => 'VARCHAR',
                'constraint' => 64,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('reset_tokens');
    }

    public function down()
    {
        $this->forge->dropTable('reset_tokens');
    }
}
