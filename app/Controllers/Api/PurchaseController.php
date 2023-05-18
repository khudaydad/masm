<?php

namespace App\Controllers\Api;

use App\Libraries\GoogleMockApi;
use App\Libraries\IosMockApi;
use App\Models\Device;
use App\Models\Subscription;
use CodeIgniter\RESTful\ResourceController;

class PurchaseController extends ResourceController
{
    protected $modelName = 'App\Models\Purchase';
    protected $format = 'json';

    public function index()
    {
        // aktif aboneligi var mi?
        $subscriptionModel = new Subscription();
        $activeSubscription = $subscriptionModel->verifySubscription(
            $this->request->getVar('client_token'),
            $this->request->getVar('receipt')
        );

        if (is_null($activeSubscription)) {
            return $this->respond([
                'status' => false,
                'message' => 'Invalid client token or receipt.',
            ]);
        }

        $deviceModel = new Device();
        $os = $deviceModel->getDeviceOS($activeSubscription->device_id);

        $receiptVerified = false;
        if ($os == 'android') {
            if (GoogleMockApi::verifyReceipt($activeSubscription->receipt)) {
                $receiptVerified = true;
            }
        } elseif ($os == 'ios') {
            if (IosMockApi::verifyReceipt($activeSubscription->receipt)) {
                $receiptVerified = true;
            }
        }

        if ($receiptVerified === false) {
            return $this->respond([
                'status' => false,
                'message' => 'Your receipt not verified.',
            ]);
        }

        // satin alma islemini geceklestir
        $purchaseResult = $this->model->insert([
            'subscription_id'   => intval($activeSubscription->id),
            'purchase_request'  => json_encode($this->request->getPost()),
        ]);

        if ($purchaseResult === false) {
            return $this->respond([
                'status' => false,
                'message' => 'Purchase cannot be done.',
            ]);
        }

        return $this->respond([
            'status' => true,
            'message' => 'You have purchased successfully.',
        ]);
    }
}
