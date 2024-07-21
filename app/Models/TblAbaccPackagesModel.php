<?php

namespace App\Models;

use CodeIgniter\Model;

class TblAbaccPackagesModel extends Model
{
    protected $table = 'TblAbaccPackages';
    protected $primaryKey = 'PackageID';
    protected $returnType = 'object';
    protected $allowedFields = ['PackageName', 'PackageDescription', 'PackagePrice','PackageValidity_Days','NumberOfServices'];

    protected $useTimestamps = false;

    // Example method to find packages by ID
    public function findByPackageID($packageID)
    {
        return $this->find($packageID);
    }

    // Example method to add a new package
    public function addPackage($data)
    {
        $this->insert($data);
        return $this->db->insertID();
    }

    // Example method to update package details
    public function updatePackage($id, $data)
    {
        return $this->update($id, $data);
    }

    // Example method to delete a package
    public function deletePackage($id)
    {
        return $this->delete($id);
    }
}
