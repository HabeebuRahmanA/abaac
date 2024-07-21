<?php

namespace App\Models;

use CodeIgniter\Model;

class TblAbaacUsersModel extends Model
{
    protected $table = 'TblAbaacUsers';
    protected $primaryKey = 'ID';
    protected $returnType = 'object';
    protected $allowedFields = ['UserID', 'FirstName', 'LastName', 'UserRole', 'CreatedDate', 'Phone', 'ManagerID', 'DOB', 'Gender', 'Address'];
    protected $useTimestamps = false;
    protected $dates = ['CreatedDate', 'DOB'];

    // Find all users
    public function findAllUsers()
    {
        return $this->findAll();
    }
    
    public function getAllManagers()
    {
        $users = $this->findAll();
        $managers = [];

        foreach ($users as $user) {
            if ($this->getUserRoleById($user->UserID) == 'manager') {
                $managers[] = $user;
            }
        }

        return $managers;
    }
    public function findByRole($role)
    {
        return $this->where('UserRole', $role)->findAll();
    }

    // Method to check if a user exists by UserID
    public function exists($userId)
    {
        return $this->where('UserID', $userId)->first() !== null;
    }

    public function getUserRoleById($userId)
    {
        $user = auth()->getProvider()->findById($userId);

        if ($user->inGroup('superadmin')) {
            $userRole = 'superadmin';
            return $userRole;
        } elseif ($user->inGroup('customer')) {
            $userRole = 'customer';
            return $userRole;
        } elseif ($user->inGroup('manager')) {
            $userRole = 'manager';
            return $userRole;
        }

        return '';
    }

    // Method to get all fields of a user by UserID
    public function getUserById($userId)
    {
        $user = $this->where('UserID', $userId)->first();
        if ($user) {
            $user->UserRole = $this->getUserRoleById($userId);  // Modify the UserRole property
        }
        return $user;
    }

    // Add or update a user
    public function saveUser($data)
    {
        $existingUser = $this->where('UserID', $data['UserID'])->first();

        if ($existingUser) {
            // Update existing user
            return $this->update($existingUser->ID, $data);
        } else {
            // Insert new user
            return $this->insert($data);
        }
    }

    public function getUsersByManagerId($managerId)
    {
        // Get all users that have the specified ManagerID
        $users = $this->where('ManagerID', $managerId)->findAll();

        // Iterate over each user and enrich with additional properties from Shield
        foreach ($users as &$user) {
            $shieldUser = auth()->getProvider()->findById($user->UserID);

            // Assuming the Shield user has additional fields such as email, username, etc.
            if ($shieldUser) {
                $user->email = $shieldUser->email;
                $user->username = $shieldUser->username;
                $user->groups = $shieldUser->getGroups();
            }
        }

        return $users;
    }

   
}
