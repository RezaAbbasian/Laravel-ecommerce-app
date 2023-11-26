<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'total',
        'total_tax_rate',
        'tax_rate',
        'tax_rate_id',
        'subtotal_less_discount',
        'discount',
        'subtotal',
        'coupon_id',
        'user_id',
        'address_id',
        'shipping_id',
        'shipping_price',
        'tracking_code',
        'order_num',
        'delivery_time',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('title','product_num', 'unit_price','quantity','total');;
    }
    public function address(){
        return $this->belongsTo(Address::class);
    }
    public function shipping(){
        return $this->belongsTo(Shipping::class);
    }
    public function payments(){
        return $this->hasMany(Payment::class);
    }
}
