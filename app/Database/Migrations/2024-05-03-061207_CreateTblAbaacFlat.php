<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblAbaacFlat extends Migration
{
    public function up() {
        $this->forge->addField([
          'FlatID' => [
            'type' => 'INT',
            'constraint' => 11,
            'auto_increment' => TRUE,
          ],
          'ManagerID' => [
            'type' => 'INT',
            'constraint' => 11,
            'null' => TRUE,
          ],
          'FlatName' => [
            'type' => 'VARCHAR',
            'constraint' => 255,
          ],
          'FlatAddress' => [
            'type' => 'TEXT',
          ],
        ]);
        $this->forge->addKey('FlatID', true); // Primary key
        $this->forge->createTable('TblAbaacFlats');
      }
    
      public function down() {
        $this->forge->dropTable('TblAbaacFlats', true); 
      }
}
