<?php

namespace App\Models;

use CodeIgniter\Model;

class Subscription extends Model
{
    protected $table            = 'subscriptions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'device_id',
        'client_token',
        'receipt',
        'start_date',
        'end_date',
        'status',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];

    public function verifySubscription($clientToken, $receipt)
    {
        return $this->where(['client_token' => $clientToken, 'receipt' => $receipt, 'status' => 'active'])->first();
    }
}
