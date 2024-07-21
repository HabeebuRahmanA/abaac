<?php

namespace App\Models;

use CodeIgniter\Model;

class TblAbaacFlatsManagerRelationModel extends Model
{
    protected $table = 'TblAbaacFlatsManagerRelation';
    protected $primaryKey = 'ID';
    protected $returnType = 'object';  // Can be 'array' if you prefer arrays
    protected $allowedFields = ['FlatID', 'ManagerID'];

    protected $useTimestamps = false;

    // Example method to find relations by manager ID
    public function findByManagerID($managerID)
    {
        return $this->where('ManagerID', $managerID)->findAll();
    }

    // Example method to add a new manager relation
    public function addManagerRelation($data)
    {
        $this->insert($data);
        return $this->db->insertID();
    }

    // Example method to delete a relation
    public function deleteRelation($id)
    {
        return $this->delete($id);
    }

    
}
