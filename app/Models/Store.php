<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'store_name',
        'store_phone',
        'slug',
        'store_description',
        'store_address',
        'store_logo',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
