<?php

namespace App\Controllers;

use App\Models\TblAbaacUsersModel;
use App\Models\TblAbaccSubscriptionsModel;

class Home extends BaseController
{
    public function index(): string
    {
        if (auth()->user()->inGroup('superadmin')) {

            // Load the subscriptions model
            $subscriptionsModel = new TblAbaccSubscriptionsModel();

            // Fetch all subscriptions
            $subscriptions = $subscriptionsModel->findAll();

            // Load the users model
            $usersModel = new TblAbaacUsersModel();

            // Fetch all users
            $users = $usersModel->findAllUsers();

            // Pass subscriptions and users to the view
            return view('admin/home', ['subscriptions' => $subscriptions, 'users' => $users]);
        } elseif (auth()->user()->inGroup('customer')) {

            //check if user already filled nessossory informations

            $userModel = new \App\Models\TblAbaacUsersModel();
            $exists = $userModel->exists(auth()->user()->id); // Pass the user ID
            if ($exists) { // if user row is inside the custom user table ( Means user already filled all data )
                $userId = auth()->user()->id;

                // Load the subscriptions model
                $subscriptionsModel = new TblAbaccSubscriptionsModel();

                // Fetch subscriptions for the current user
                $subscriptions = $subscriptionsModel->findByUserID($userId);

                // Load the user model
                $usersModel = new TblAbaacUsersModel();

                // Fetch the current user to get the ManagerID
                $currentUser = $usersModel->getUserById($userId);

                // Fetch manager information using ManagerID
                $manager = null;
                if (!empty($currentUser->ManagerID)) {
                    $manager = $usersModel->getUserById($currentUser->ManagerID);
                    // Fetch email and additional fields from Shield
                    $shieldUser = auth()->getProvider()->findById($manager->UserID);
                    if ($shieldUser) {
                        $manager->email = $shieldUser->email;
                        $manager->username = $shieldUser->username;
                    }
                }

                // Pass subscriptions and manager info to the view
                return view('customer/home', [
                    'userid' => $userId,
                    'subscriptions' => $subscriptions,
                    'manager' => $manager
                ]);
            } else {
                $data['userid'] = auth()->user()->id;
                $data['message']  = "Please Help us with few more details so we can entroll you into our system";

                $userModel = new \App\Models\TblAbaacUsersModel();
                $user = $userModel->getUserById(auth()->user()->id);
                if ($user) {
                    // Accessing individual fields directly
                    $data['Phone:'] =  $user->Phone;
                    $data['DOB:'] =  $user->DOB->format('Y-m-d'); // assuming DOB is a DateTime object
                    $data['Gender'] = $user->Gender;
                    $data['Address'] = $user->Address;
                }



                return view('customer/additional_info', $data);
            }

            //echo $exists ? 'User exists' : 'User does not exist';
        } elseif (auth()->user()->inGroup('manager')) {
            $userobj = new TblAbaacUsersModel();
            $manager = $userobj->getUserById(auth()->user()->id);

            // Load the users model
            $usersModel = new TblAbaacUsersModel();

            // Fetch all users managed by the manager
            $users = $usersModel->getUsersByManagerId(auth()->user()->id);

            // Extract user IDs
            $userIds = array_map(function ($user) {
                return $user->UserID;
            }, $users);

            // Load the subscriptions model
            $subscriptionsModel = new TblAbaccSubscriptionsModel();

            // Fetch subscriptions for the users managed by the manager
            $subscriptions = $subscriptionsModel->whereIn('UserID', $userIds)->findAll();

            // Pass subscriptions and users to the view
            return view('manager/home', [
                'manager' => $manager,
                'subscriptions' => $subscriptions,
                'users' => $users
            ]);
        }

        // return view('welcome_message');
    }
}
