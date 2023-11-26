<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable=[
        'status','metadata','image','card_name','resnumber','type','order_id','card_num','amount','date','time'
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
