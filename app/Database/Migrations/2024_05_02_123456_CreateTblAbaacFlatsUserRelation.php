<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblAbaacFlatsUserRelation extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'FlatID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => FALSE
            ],
            'UserID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => FALSE
            ]
        ]);

        $this->forge->addKey('ID', true); // Primary key
        //$this->forge->addForeignKey('FlatID', 'tblabaacflats', 'FlatID', 'CASCADE', 'CASCADE');
        //$this->forge->addForeignKey('UserID', 'tblabaacusers', 'UserID', 'CASCADE', 'CASCADE');
        $this->forge->createTable('TblAbaacFlatsUserRelation');
    }

    public function down()
    {
        $this->forge->dropTable('TblAbaacFlatsUserRelation', true);
    }
}
