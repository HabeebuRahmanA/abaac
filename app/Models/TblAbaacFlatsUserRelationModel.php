<?php

namespace App\Models;

use CodeIgniter\Model;

class TblAbaacFlatsUserRelationModel extends Model
{
    protected $table = 'TblAbaacFlatsUserRelation'; // This matches the name used in your migration
    protected $primaryKey = 'ID';
    protected $returnType = 'object'; // Can be 'array' if you prefer arrays
    protected $allowedFields = ['FlatID', 'UserID']; // 'ID' is auto-increment and should not be listed in allowedFields

    protected $useTimestamps = false; // Set to true if you have created_at and updated_at fields

    // Example method to find relations by FlatID
    public function findByFlatID($flatID)
    {
        return $this->where('FlatID', $flatID)->findAll();
    }

  
    // Method to get the latest entry by UserID
    public function findByUserID($userID)
    {
        // Order by 'ID' in descending order to get the newest entry based on ID
        return $this->where('UserID', $userID)->orderBy('ID', 'DESC')->first();
    }
    


    // Example method to add a new relation
    public function addRelation($data)
    {
        $this->insert($data);
        return $this->insertID(); // This returns the ID of the newly inserted record
    }

    // Example method to update relation details
    public function updateRelation($id, $data)
    {
        return $this->update($id, $data);
    }

    // Example method to delete a relation
    public function deleteRelation($id)
    {
        return $this->delete($id);
    }
}
