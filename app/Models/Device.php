<?php

namespace App\Models;

use CodeIgniter\Model;

class Device extends Model
{
    protected $table            = 'devices';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'uid',
        'app_id',
        'language',
        'os',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getDeviceOS($deviceId)
    {
        $row = $this->select('os')->where('id', intval($deviceId))->first();
        return isset($row->os)? $row->os : '';
    }
}
