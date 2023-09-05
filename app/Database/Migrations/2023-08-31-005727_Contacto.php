<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Contacto extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'contacto_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nombre' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'telefono' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'correo' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type' => 'DATETIME'
            ],
            'updated_at' => [
                'type' => 'DATETIME'
            ]
        ]);
        $this->forge->addKey('contacto_id', true);
        $this->forge->createTable('contacto');
    }

    public function down()
    {
        $this->forge->dropTable('contacto');
    }
}
