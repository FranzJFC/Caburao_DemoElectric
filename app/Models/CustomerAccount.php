<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerAccount extends Model
{
    protected $table         = 'customer_accounts';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = [
        'account_number', 'customer_name', 'address', 'phone', 'email',
        'meter_number', 'connection_type', 'status',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
