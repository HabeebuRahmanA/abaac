<?php

namespace App\Models;

use CodeIgniter\Model;

class TblAbaccPaymentsModel extends Model
{
    protected $table = 'TblAbaccPayments';
    protected $primaryKey = 'TransactionUID';
    protected $returnType = 'object';
    protected $allowedFields = ['UserID', 'SubscriptionID', 'TotalAmount', 'TransactionDetails'];

    protected $useTimestamps = false;

    // Example method to find payments by TransactionUID
    public function findByTransactionUID($transactionUID)
    {
        return $this->find($transactionUID);
    }

    // Example method to add a new payment transaction
    public function addPayment($data)
    {
        $this->insert($data);
        return $this->db->insertID();
    }

    // Example method to update payment transaction details
    public function updatePayment($transactionUID, $data)
    {
        return $this->update($transactionUID, $data);
    }

    // Example method to delete a payment transaction
    public function deletePayment($transactionUID)
    {
        return $this->delete($transactionUID);
    }
}
