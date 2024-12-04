<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    protected $fillable = [
        'discount_name',
        'discount_percentage',
        'valid_from',
        'valid_until'
    ];
}
