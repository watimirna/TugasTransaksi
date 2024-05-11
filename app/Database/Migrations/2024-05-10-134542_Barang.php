<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Barang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_dosen' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kode_dosen' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'nama_dosen' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],
            'status_dosen' => [
                'type'       => 'CHAR',
                'constraint' => 1,
            ],
        ]);
        $this->forge->addKey('id_dosen', true);
        $this->forge->createTable('dosen');
    }

    public function down()
    {
        //
    }
}
