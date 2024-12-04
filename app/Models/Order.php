<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderItem;

class Order extends Model
{
    protected $fillable = [
        'invoice_number',
        'user_id',
        'status',
        'payment_method',
        'shipping_cost',
        'total_amount',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'order_items', 'order_id', 'store_id', 'id', 'id');
    }
}
