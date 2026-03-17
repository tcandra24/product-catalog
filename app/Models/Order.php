<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'code',
        'customer_id',
        'product_name',
        'brand_name',
        'qty',
        'price',
        'total_price',
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
