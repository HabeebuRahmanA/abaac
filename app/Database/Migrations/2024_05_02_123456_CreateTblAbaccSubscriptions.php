<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblAbaccSubscriptions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'SubscriptionID' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'UserID' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => TRUE,
                'null'       => FALSE
            ],
            'PackageID' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => TRUE,
                'null'       => FALSE
            ],
            'PurchaseDate' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ],
            'ExpiryDate' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ],
            'TotalServices' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => TRUE,
                'null'       => FALSE
            ],
            'RemainingServices' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => TRUE,
                'null'       => FALSE
            ],
        ]);
        $this->forge->addKey('SubscriptionID', true); // Primary key
        $this->forge->createTable('TblAbaccSubscriptions');
    }

    public function down()
    {
        $this->forge->dropTable('TblAbaccSubscriptions', true);
    }
}
