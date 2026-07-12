<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'invoice_no',
        'name',
        'phone',
        'email',
        'address',
        'subtotal',
        'shipping',
        'discount',
        'grand_total',
        'payment_method',
        'payment_status',
        'order_status',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
