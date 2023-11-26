<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'user_id',
        'province_id',
        'city_id',
        'address',
        'no',
        'unit',
        'postal_code',
        'full_name',
        'mobile',
        'lat',
        'long',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
