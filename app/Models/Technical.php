<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Technical extends Model
{
    protected $table = 'technicals';
    protected $primaryKey = 'id';
    protected $fillable = [
        'service_package',
        'id_photo_url',
        'selfie_id_photo_url'
    ];
}
