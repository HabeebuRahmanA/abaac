<?php

namespace App\Models;

use CodeIgniter\Model;

class TblAbaacFlatsModel extends Model
{
    protected $table = 'TblAbaacFlats'; // Ensure this matches the name used in your migration
    protected $primaryKey = 'FlatID';
    protected $returnType = 'object';  // Can be 'array' if you prefer arrays
    protected $allowedFields = ['ManagerID', 'FlatName', 'FlatAddress'];

    protected $useTimestamps = false; // Set to true if you have created_at and updated_at fields

    // Example method to find flats by manager ID
    public function findByManagerID($managerID)
    {
        return $this->where('ManagerID', $managerID)->findAll();
    }

    // Method to find flats by FlatID
    public function findByFlatID($flatID)
    {
        return $this->where('FlatID', $flatID)->first();
    }

    // Modified method to add or return existing flat
    public function addFlat($data)
    {
        // Check if a flat with the same name and address already exists
        $existingFlat = $this->where('FlatName', $data['FlatName'])
            ->where('FlatAddress', $data['FlatAddress'])
            ->first();

        if ($existingFlat) {
            // Flat already exists, return the ID
            return $existingFlat->FlatID;
        } else {
            // No existing flat, proceed to insert
            $this->insert($data);
            return $this->insertID(); // Return the ID of the newly inserted record
        }
    }

    // Example method to update flat details
    public function updateFlat($id, $data)
    {
        return $this->update($id, $data);
    }

    // Example method to delete a flat
    public function deleteFlat($id)
    {
        return $this->delete($id);
    }

    public function getAllFlats()
    {
        return $this->findAll();
    }

    public function getAllFlatsWithManagers()
    {
        $builder = $this->db->table($this->table);
        $builder->select('TblAbaacFlats.FlatID, TblAbaacFlats.FlatName, TblAbaacFlats.FlatAddress, CONCAT(TblAbaacUsers.FirstName, " ", TblAbaacUsers.LastName) as ManagerName');
        $builder->join('TblAbaacUsers', 'TblAbaacFlats.ManagerID = TblAbaacUsers.UserID');
        $builder->orderBy('TblAbaacFlats.FlatID', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }



    //crud


}
