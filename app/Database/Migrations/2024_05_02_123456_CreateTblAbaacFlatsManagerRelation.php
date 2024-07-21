<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblAbaacFlatsManagerRelation extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'FlatID' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => TRUE,
                'null'       => FALSE
            ],
            'ManagerID' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => TRUE,
                'null'       => FALSE
            ],
        ]);
        $this->forge->addKey('ID', true); // Primary key
        $this->forge->createTable('TblAbaacFlatsManagerRelation');
    }

    public function down()
    {
        $this->forge->dropTable('TblAbaacFlatsManagerRelation', true);
    }
}
