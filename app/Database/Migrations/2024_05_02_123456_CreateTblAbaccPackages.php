<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblAbaccPackages extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'PackageID' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'PackageName' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => FALSE
            ],
            'PackageDescription' => [
                'type'       => 'TEXT',
                'null'       => TRUE
            ],
            'PackagePrice' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',  // Adjust precision and scale according to your needs
                'null'       => FALSE
            ],
        ]);
        $this->forge->addKey('PackageID', true); // Primary key
        $this->forge->createTable('TblAbaccPackages');
    }

    public function down()
    {
        $this->forge->dropTable('TblAbaccPackages', true);
    }
}
