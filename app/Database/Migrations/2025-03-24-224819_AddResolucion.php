<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddResolucion extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'SMALLINT',
                'constraint'     => 6,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nom' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ]
        ]);
        
        $this->forge->addKey('id', true); // Clave primaria
        $this->forge->createTable('resolucion', true);
    }

    public function down()
    {
        $this->forge->dropTable('resolucion', true);
    }
}
