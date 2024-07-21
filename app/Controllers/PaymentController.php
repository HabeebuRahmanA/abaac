<?php


namespace App\Controllers;
use App\Models\TblAbaccPackagesModel;
use App\Models\TblAbaccSubscriptionsModel;
use Dwivedianuj9118\PhonepePaymentGateway\Phonepe;

class PaymentController extends BaseController {

    public function initiate_payment() {
        // Retrieve the query parameters
        $merchantTransactionId = $this->request->getGet('merchantTransactionId');
        $merchantOrderId = $this->request->getGet('merchantOrderId');
        $amount = $this->request->getGet('amount');
        $redirectUrl = $this->request->getGet('redirectUrl');
        $callbackUrl = $this->request->getGet('callbackUrl');
        $mobileNumber = $this->request->getGet('mobileNumber');
        $mode = $this->request->getGet('mode', 'UAT'); // Default to 'UAT' if not provided

        // Initialize the PhonePe payment gateway
        $phonepe = new Phonepe('PGTESTPAYUAT86', '96434309-7796-489d-8924-ab56988a6076', 1);
        
        // Call the PhonePe Payment API
        $data = $phonepe->PaymentCall($merchantTransactionId, $merchantOrderId, $amount, $redirectUrl, $callbackUrl, $mobileNumber, $mode);
        
        // Handle the response
        if ($data['status'] == 'SUCCESS') {
            return redirect()->to($data['url']);
        } else {
            return view('payment_failure', ['message' => $data['msg']]);
        }
    }

    public function success() {
        // Load the models
        $packages = new TblAbaccPackagesModel();
        $subscriptions = new TblAbaccSubscriptionsModel();
    
        // Retrieve the package details from session
        $packageId = session()->get('packageId');
        $current_package = $packages->findByPackageID($packageId);
    
        // Get the current user ID from session
        $userId = session()->get('userId');
    
        // Set the purchase date as the current date
        $purchaseDate = date('Y-m-d');
    
        // Calculate the expiry date based on the package validity
        $expiryDate = date('Y-m-d', strtotime($purchaseDate . ' + ' . $current_package->PackageValidity_Days . ' days'));
    
        // Prepare the subscription data
        $subscriptionData = [
            'UserID' => $userId,
            'PackageID' => $packageId,
            'PurchaseDate' => $purchaseDate,
            'ExpiryDate' => $expiryDate,
            'TotalServices' => $current_package->NumberOfServices,
            'RemainingServices' => $current_package->NumberOfServices
        ];
    
        // Insert the new subscription record
        $subscriptions->insert($subscriptionData);
    
        // Show the success page
        return view('payment_success');
    }
    

    public function callback() {
        // Handle the callback response from PhonePe
        // You can add your own logic to process the callback data
        return view('payment_callback');
    }

    
}
