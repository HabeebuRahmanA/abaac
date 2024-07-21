<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblAbaccPayments extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'TransactionUID' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'unique'     => TRUE,
            ],
            'UserID' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => TRUE,
            ],
            'SubscriptionID' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => TRUE,
            ],
            'TotalAmount' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => TRUE,
            ],
            'TransactionDetails' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
        ]);
        $this->forge->addKey('TransactionUID', true); // Primary key
        $this->forge->createTable('TblAbaccPayments');
    }

    public function down()
    {
        $this->forge->dropTable('TblAbaccPayments', true);
    }
}
