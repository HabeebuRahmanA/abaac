<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblAbaacUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'UserID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'FirstName' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'LastName' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'UserRole' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'CreatedDate' => [
                'type' => 'DATETIME',
            ],
            'Phone' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'ManagerID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'DOB' => [
                'type' => 'DATE',
            ],
            'Gender' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'Address' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            
        ]);
        $this->forge->addKey('ID', true); // Primary key
       // $this->forge->addForeignKey('UserID', 'users', 'id'); // Assuming 'users' table with 'id' as primary key
        $this->forge->createTable('TblAbaacUsers');
    }

    public function down()
    {
        $this->forge->dropTable('TblAbaacUsers', true); // Add true to drop foreign keys as well
    }
}
