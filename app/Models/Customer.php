<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'address',
        'class',
        'email',
        'identity_number',
        'company_name',
        'company_address',
        'company_npwp',
        'company_employees',
    ];
}
