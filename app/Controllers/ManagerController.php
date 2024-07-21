<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Shield\Entities\User;
use App\Models\TblAbaacUsersModel;
use CodeIgniter\Shield\Models\UserModel;

use App\Models\TblAbaacFlatsModel;
use App\Models\TblAbaacFlatsUserRelationModel;
use App\Models\TblAbaccSubscriptionsModel;

use function PHPUnit\Framework\isNull;

class ManagerController extends BaseController
{
    public function index(): string
    {
        if (auth()->user()->inGroup('manager')) {
            $userobj = new TblAbaacUsersModel();
            $manager = $userobj->getUserById( auth()->user()->id);
            /* return view('manager/home',[
                'manager'=>$manager
            ]); */

             // Load the subscriptions model
             $subscriptionsModel = new TblAbaccSubscriptionsModel();

             // Fetch all subscriptions
             $subscriptions = $subscriptionsModel->findAll();
 
             // Load the users model
             $usersModel = new TblAbaacUsersModel();
 
             // Fetch all users
             $users = $usersModel->getUsersByManagerId(auth()->user()->id);
 
             // Pass subscriptions and users to the view
             return view('manager/home', [ 'manager'=>$manager,'subscriptions' => $subscriptions, 'users' => $users]);
        }
    }



    public function users(): string
    {
        $perPage = $this->request->getVar('perPage') ?? 10; // Default to 10 if not set
        $page = $this->request->getVar('page') ?? 1;
        $groupFilter = $this->request->getVar('group') ?? '';
        $search = $this->request->getVar('search') ?? '';

        // Get the total number of users (optionally filtered by group)
        $userModel = auth()->getProvider();
        $users = $userModel->findAll();

        if ($groupFilter) {
            $users = array_filter($users, function ($user) use ($groupFilter) {
                return $user->inGroup($groupFilter);
            });
        }


        if ($search && strlen($search) > 3) {
            $users = array_filter($users, function ($user) use ($search) {
                // Check if either the email or username contains the search term
                return strpos($user->email, $search) !== false || strpos($user->username, $search) !== false;
            });
        }


        $totalUsers = count($users);

        // Calculate the slice of users to fetch
        $users = array_slice($users, $perPage * ($page - 1), $perPage);

        // Load the pagination service
        $pager = service('pager');
        $pager->makeLinks($page, $perPage, $totalUsers);

        return view('admin/users', [
            'users' => $users,
            'pager' => $pager,
            'perPage' => $perPage,
            'selectedGroup' => $groupFilter,
            'search' => $search
        ]);
    }


    public function managers(): string
    {
        $perPage = $this->request->getVar('perPage') ?? 10; // Default to 10 if not set
        $page = $this->request->getVar('page') ?? 1;
       
        $search = $this->request->getVar('search') ?? '';

        // Get the total number of users (optionally filtered by group)
        $userModel = auth()->getProvider();
        $users = $userModel->findAll();

     
            $users = array_filter($users, function ($user) {
                return $user->inGroup('manager');
            });
        


        if ($search && strlen($search) > 3) {
            $users = array_filter($users, function ($user) use ($search) {
                // Check if either the email or username contains the search term
                return strpos($user->email, $search) !== false || strpos($user->username, $search) !== false;
            });
        }


        $totalUsers = count($users);

        // Calculate the slice of users to fetch
        $users = array_slice($users, $perPage * ($page - 1), $perPage);

        // Load the pagination service
        $pager = service('pager');
        $pager->makeLinks($page, $perPage, $totalUsers);

        return view('admin/managers', [
            'users' => $users,
            'pager' => $pager,
            'perPage' => $perPage,
            
            'search' => $search
        ]);
    }

    public function manager($id): string
    {
        $perPage = $this->request->getVar('perPage') ?? 10; // Default to 10 if not set
        $page = $this->request->getVar('page') ?? 1;
       
        $search = $this->request->getVar('search') ?? '';

        // Get the total number of users (optionally filtered by group)
        /* $userModel = auth()->getProvider();
        $users = $userModel->findAll(); */

     /* 
            $users = array_filter($users, function ($user) {
                return $user->inGroup('manager');
            }); */

            $userobj = new TblAbaacUsersModel();

            $users = $userobj->getUsersByManagerId($id);
        


        if ($search && strlen($search) > 3) {
            $users = array_filter($users, function ($user) use ($search) {
                // Check if either the email or username contains the search term
                return strpos($user->email, $search) !== false || strpos($user->username, $search) !== false;
            });
        }


        $totalUsers = count($users);

        // Calculate the slice of users to fetch
        $users = array_slice($users, $perPage * ($page - 1), $perPage);

        // Load the pagination service
        $pager = service('pager');
        $pager->makeLinks($page, $perPage, $totalUsers);

        $manager = $userobj->getUserById($id);
        return view('manager/customers', [
            'users' => $users,
            'pager' => $pager,
            'perPage' => $perPage,
            'manager' => $manager,
            'search' => $search
        ]);
    }

    public function unassignedusers(): string
    {

        $model = new TblAbaacUsersModel();

        $perPage = $this->request->getVar('perPage') ?? 10; // Default to 10 if not set
        $page = $this->request->getVar('page') ?? 1;
        $groupFilter = $this->request->getVar('group') ?? '';
        $search = $this->request->getVar('search') ?? '';

        // Get the total number of users (optionally filtered by group)
        $userModel = auth()->getProvider();
        $users = $userModel->findAll();

        if ($groupFilter) {
            $users = array_filter($users, function ($user) use ($groupFilter) {
                return $user->inGroup($groupFilter);
            });
        }


        if ($search && strlen($search) > 3) {
            $users = array_filter($users, function ($user) use ($search) {
                // Check if either the email or username contains the search term
                return strpos($user->email, $search) !== false || strpos($user->username, $search) !== false;
            });
        }

        // show only customers

        $users = array_filter($users, function ($user) use ($model) {
            // Check if either the email or username contains the search term
            if ($model->getUserRoleById($user->id) == 'customer')
                return true;
        });

        $users = array_filter($users, function ($user) use ($model) {
            // Check if either the email or username contains the search term
            if ($model->exists($user->id)) {
                if($model->getUserById($user->id)->ManagerID >0 )
                    return false;
                return true;

            }
            else{
                return true;
            }
             
        });



        $totalUsers = count($users);

        // Calculate the slice of users to fetch
        $users = array_slice($users, $perPage * ($page - 1), $perPage);

        // Load the pagination service
        $pager = service('pager');
        $pager->makeLinks($page, $perPage, $totalUsers);

        return view('admin/users', [
            'users' => $users,
            'pager' => $pager,
            'perPage' => $perPage,
            'selectedGroup' => $groupFilter,
            'search' => $search
        ]);
    }


    public function create()
    {
        return view('manager/create_user');
    }

    public function save()
    {
        $users = auth()->getProvider();

        $user = new User([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ]);

        if ($users->save($user)) {
            $user = $users->findById($users->getInsertID());
            $users->addToDefaultGroup($user);

            return redirect()->to('/manager/users')->with('message', 'User created successfully');
        } else {
            return redirect()->back()->with('errors', $users->errors())->withInput();
        }
    }



    public function edit($id)
    {
        $userobj = new TblAbaacUsersModel();
        $userModel = new UserModel();
        $flatUserRelation = new TblAbaacFlatsUserRelationModel();
        $flatModel = new TblAbaacFlatsModel();
        $subscriptionModel = new TblAbaccSubscriptionsModel(); // Add this line
    
        $user = auth()->getProvider()->findById($id);
        $additionalInfo = $userobj->getUserById($id);
        $userrole = $userobj->getUserRoleById($id);
        $managers = $userModel->getUsersByGroupName('manager');
        $flatID = $flatUserRelation->findByUserID($id)->FlatID ?? '';
    
        $flatDetails = $flatModel->findByFlatID($flatID);
    
        // Retrieve subscriptions for the user
        $subscriptions = $subscriptionModel->where('UserID', $id)->findAll(); // Add this line
    
        return view('admin/edit_user', [
            'user' => $user,
            'additionalinfo' => $additionalInfo,
            'userrole' => $userrole,
            'managers' => $managers,
            'flatdetails' => $flatDetails,
            'subscriptions' => $subscriptions, // Pass subscriptions to the view
        ]);
    }

    public function update($id)
    {
        // updating shield data
        $data = $this->request->getPost();
        $user = auth()->getProvider()->findById($id);
        $user->fill($data);
        auth()->getProvider()->save($user);

     

        // updating custom tables

        $model = new TblAbaacUsersModel();
        $flatModel = new TblAbaacFlatsModel();
        $flatUser = new TblAbaacFlatsUserRelationModel();
        // changing the user group
        if( $this->request->getPost('group') && $this->request->getPost('group')!= $model->getUserRoleById($id))
        {
            $current_group  =(string) $this->request->getPost('group');

            $user->removeGroup(( string )$model->getUserRoleById($id));

            $user->addGroup($current_group);
        }

        //insert flat first 

        $dataflat = [
            'FlatName' => $this->request->getPost('flatname'),
            'FlatAddress' => $this->request->getPost('flataddress'),

        ];

        $flatID = $flatModel->addFlat($dataflat);
        // insert flat user relation
        $dataFlatUser = [
            'FlatID' => $flatID,
            'UserID' => $this->request->getPost('cuserid'),
        ];

        $flatUser->addRelation($dataFlatUser);

        /* echo  $this->request->getPost('manager');
        die(); */
        $data = [
            'UserID' => $this->request->getPost('cuserid'),
            'FirstName' =>  $this->request->getPost('firstname'),
            'LastName' =>  $this->request->getPost('lastname'),
            'Phone' => $this->request->getPost('phone'),
            'ManagerID' => $this->request->getPost('manager') ?? '',
            'DOB' => $this->request->getPost('dob'),
            'Gender' => $this->request->getPost('gender'),
            'Address' => $this->request->getPost('address'),
        ];

        if ($model->saveUser($data)) {
            return redirect()->to('/'); // Redirect to a customer page with success message
        } else {
            return redirect()->back()->with('error', 'Failed to insert details.');
        }




        return redirect()->to('/');
    }

    public function delete($id)
    {
        auth()->getProvider()->delete($id);
        return redirect()->to('/');
    }
    public function updateSubscription($subscriptionId)
    {
        // Get the remaining services value from the POST data
        $remainingServices = $this->request->getPost('remaining_services');

        // Load the subscriptions model
        $subscriptionsModel = new TblAbaccSubscriptionsModel();

        // Find the subscription by ID
        $subscription = $subscriptionsModel->find($subscriptionId);

        if (!$subscription) {
            // Subscription not found, redirect back to home page with error message
            return redirect()->to(site_url('manager'))->with('error', 'Subscription not found.');
        }

        // Update the remaining services
        $subscription->RemainingServices = $remainingServices;

        // Save the updated subscription
        if (!$subscriptionsModel->save($subscription)) {
            // Failed to save, redirect back to home page with error message
            return redirect()->to(site_url('manager'))->with('error', 'Failed to update subscription.');
        }

        // Successfully updated, redirect back to home page with success message
        return redirect()->to(site_url('manager'))->with('success', 'Subscription updated successfully.');
    }
}
