<?php

namespace App\Controllers\Api;

use App\Models\Subscription;
use CodeIgniter\RESTful\ResourceController;

class RegisterController extends ResourceController
{
    protected $modelName = 'App\Models\Device';
    protected $format = 'json';

    public function index()
    {
        helper(['global']);

        // zorunlu alan kontrolu
        $rules = $this->validate([
            'uid'       => 'required',
            'app_id'    => 'required',
            'language'  => 'required',
            'os'        => 'required',
        ]);

        if (!$rules) {
            return $this->respond([
                'status' => false,
                'message' => 'Invalid inputs.',
                //'message' => $this->validator->getErrors(),
            ]);
        }

        // cihazin onceden kayitli mi?
        $device = $this->model
            ->where('uid', $this->request->getVar('uid'))
            ->where('app_id', $this->request->getVar('app_id'))
            ->first();

        // cihaz onceden kayitli degilse kayit yap
        if (empty($device)) {
            $data = [
                'uid'       => esc($this->request->getVar('uid')),
                'app_id'    => esc($this->request->getVar('app_id')),
                'language'  => esc($this->request->getVar('language')),
                'os'        => esc($this->request->getVar('os')),
            ];

            $deviceId = $this->model->insert($data);
            if ($deviceId === false) {
                return $this->fail([
                    'status'    => false,
                    'message'   => $this->model->errors(),
                ], 409);
            }
        } else {
            $deviceId = $device->id;
        }

        // kayitli cihazin aktif aboneligi var mi?
        $subscriptionModel = new Subscription();
        $subscription = $subscriptionModel
            ->where('device_id', $deviceId)
            ->where('status', 'active')
            ->first();

        // kayitli cihazin onceden aktif aboneligi yoksa abone yap
        if (empty($subscription)) {
            // token olustur
            $clientToken = generateToken();

            // receipt olustur
            $receipt = generateReceipt();

            // abone yap
            $subscriptionModel->insert([
                'device_id' => intval($deviceId),
                'client_token' => $clientToken,
                'receipt' => $receipt,
                'start_date' => date('Y-m-d'),
                'end_date' => date('Y-m-d', strtotime('+15 Days')),
            ]);
        } else {
            $clientToken = $subscription->client_token;
            $receipt = $subscription->receipt;
        }

        return $this->respond([
            'status' => true,
            'message' => 'Your are successfully subscribed.',
            'token' => $clientToken,
            'receipt' => $receipt,
        ]);
    }
}
