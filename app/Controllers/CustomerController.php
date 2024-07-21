<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Shield\Entities\User;
use App\Models\TblAbaacUsersModel;
use App\Models\TblAbaacFlatsModel;
use App\Models\TblAbaacFlatsUserRelationModel;
use App\Models\TblAbaccPackagesModel;
use App\Models\TblAbaccSubscriptionsModel;
use CodeIgniter\Shield\Models\UserModel;

class CustomerController extends BaseController
{
    public function index(): string
    {
        if (auth()->user()->inGroup('customer')) {
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
        }

        // If the user is not in the customer group, you can redirect or show an error message
        return redirect()->to('/'); // Redirect to home page or an error page
    } 

    public function plans()
    {
        return view('customer/plans');
    }

    public function purchase_confirm($packageId) {
        // Load the models
        $packages = new TblAbaccPackagesModel();
        $subscriptions = new TblAbaccSubscriptionsModel();

        // Retrieve the current package details
        $current_package = $packages->findByPackageID($packageId);

        // Get the current user ID
        $userId = auth()->user()->id;

        // Prepare the PhonePe payment integration
        $merchantTransactionId = 'MUID' . substr(uniqid(), -6); // Unique Random transaction Id
        $merchantOrderId = 'Order' . mt_rand(1000, 99999); // OrderId
        $amount = $current_package->PackagePrice * 100; // Amount in Paisa or amount*100
        $redirectUrl = site_url('payment/success'); // Redirect Url after Payment success or fail
        $callbackUrl = site_url('payment/callback'); // Callback Url after Payment success or fail
        $mobileNumber = auth()->user()->phone_number; // Mobile No (you might need to update this to fetch the user's phone number)

        // Store package details in session or pass as parameter to callback
        session()->set('packageId', $packageId);
        session()->set('userId', $userId);

        // Redirect to PaymentController to initiate the payment
        return redirect()->to(site_url('payment/initiate_payment') . '?' . http_build_query([
            'merchantTransactionId' => $merchantTransactionId,
            'merchantOrderId' => $merchantOrderId,
            'amount' => $amount,
            'redirectUrl' => $redirectUrl,
            'callbackUrl' => $callbackUrl,
            'mobileNumber' => $mobileNumber
        ]));
    }

    public function pay($packageId)
    {

        $packages = new TblAbaccPackagesModel();

        $current_package = $packages->findByPackageID($packageId);
        return view('customer/pay', [
            'package' => $current_package,
        ]);
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

            return redirect()->to('/admin/users')->with('message', 'User created successfully');
        } else {
            return redirect()->back()->with('errors', $users->errors())->withInput();
        }
    }


    public function save_AdditionalDetails()
    {


        $model = new TblAbaacUsersModel();
        $flatModel = new TblAbaacFlatsModel();
        $flatUser = new TblAbaacFlatsUserRelationModel();


        // Input validation
        $input = $this->validate([

            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'dob' => 'required|valid_date',
            'gender' => 'required',
            'address' => 'required',
            'flatname' => 'required',
            'flataddress' => 'required'
        ]);

        if (!$input) { // If validation fails
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        //die( $this->request->getPost('cuserid'));

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

        $data = [
            'UserID' => $this->request->getPost('cuserid'),
            'FirstName' =>  $this->request->getPost('firstname'),
            'LastName' =>  $this->request->getPost('lastname'),
            'Phone' => $this->request->getPost('phone'),
            'DOB' => $this->request->getPost('dob'),
            'Gender' => $this->request->getPost('gender'),
            'Address' => $this->request->getPost('address'),

        ];

        if ($model->insert($data)) {
            return redirect()->to('/customer'); // Redirect to a customer page with success message
        } else {
            return redirect()->back()->with('error', 'Failed to insert details.');
        }
    }

    public function account()
    {
        $id = auth()->user()->id;

        $userobj = new TblAbaacUsersModel();
        $userModel = new  UserModel();
        $flatUserRelation = new TblAbaacFlatsUserRelationModel();
        $flatModel = new TblAbaacFlatsModel();

        $user = auth()->getProvider()->findById($id);
        $additionalInfo = $userobj->getUserById($id);
        $userrole = $userobj->getUserRoleById($id);
        $managers = $userModel->getUsersByGroupName('manager');
        $flatID = $flatUserRelation->findByUserID($id)->FlatID ?? '';




        $flatDetails = $flatModel->findByFlatID($flatID);
        //echo $flatDetails;


        //$user['selectedGroup']="customer";
        return view('customer/account', [
            'user' => $user,
            'additionalinfo' => $additionalInfo,
            'userrole' => $userrole,
            'managers' => $managers,
            'flatdetails' => $flatDetails
        ]);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $user = auth()->getProvider()->findById($id);
        $user->fill($data);
        auth()->getProvider()->save($user);

        return redirect()->to('/admin/users');
    }

    public function delete($id)
    {
        auth()->getProvider()->delete($id);
        return redirect()->to('/admin/users');
    }
}
