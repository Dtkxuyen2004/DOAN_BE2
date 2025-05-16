<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'customer_id', 'services', 'staffs', 'total_amount', 'payment_method',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
