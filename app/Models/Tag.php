<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'parent',
        'description',
        'image',
        'url',
        'seo_description',
        'seo_title',
        'seo_status',
        'status'
        ];

    public function products(){
        return $this->belongsToMany(Product::class);
    }

}
