<?php

namespace App\Models;

use CodeIgniter\Model;

class Purchase extends Model
{
    protected $table            = 'purchases';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'subscription_id',
        'purchase_request',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
