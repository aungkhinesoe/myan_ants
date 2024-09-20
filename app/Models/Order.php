<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'address', 'service',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function service()
    {
        return $this->hasOne('App\Models\Service','id','service_id');
    }
}
