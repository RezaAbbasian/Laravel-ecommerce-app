<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','days', 'price', 'status','description'
    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function cities(){
        return $this->belongsToMany(City::class);
    }
}
