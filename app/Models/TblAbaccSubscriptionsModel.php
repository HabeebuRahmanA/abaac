<?php

namespace App\Models;

use CodeIgniter\Model;

class TblAbaccSubscriptionsModel extends Model
{
    protected $table = 'TblAbaccSubscriptions';
    protected $primaryKey = 'SubscriptionID';
    protected $returnType = 'object';
    protected $allowedFields = ['UserID', 'PackageID', 'PurchaseDate', 'ExpiryDate', 'TotalServices', 'RemainingServices'];

    protected $useTimestamps = false;

    // Example method to find subscriptions by user ID
    public function findByUserID($userID)
    {
        return $this->select('TblAbaccSubscriptions.*, TblAbaccPackages.PackageName')
                    ->join('TblAbaccPackages', 'TblAbaccSubscriptions.PackageID = TblAbaccPackages.PackageID')
                    ->where('TblAbaccSubscriptions.UserID', $userID)
                    ->findAll();
    }

    // Example method to add a new subscription
    public function addSubscription($data)
    {
        $this->insert($data);
        return $this->db->insertID();
    }

    // Example method to update subscription details
    public function updateSubscription($id, $data)
    {
        return $this->update($id, $data);
    }

    // Example method to delete a subscription
    public function deleteSubscription($id)
    {
        return $this->delete($id);
    }
}
