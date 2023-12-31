<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'image','title','alt','caption','product_id'
    ];
    public function product(){
        $this->belongsTo(Product::class);
    }
}
