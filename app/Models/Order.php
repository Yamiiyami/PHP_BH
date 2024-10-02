<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'total_amount',
        'shipping_address',
        'recipient_name',
        'recipient_phone',
        'notes',
        'order_status',
    ];

    public function user()
    {
        return $this->belongsTo(Customer::class);
    }
    public function cart()
    {
        return $this->belongsTo(cart::class);
    }
}
