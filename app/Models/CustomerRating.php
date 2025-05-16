<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerRating extends Model
{
    protected $table = 'customer_ratings'; // tên bảng

    protected $fillable = [
        'customer_name',
        'service_rating',
        'comments',
    ];

    public $timestamps = true;
}
