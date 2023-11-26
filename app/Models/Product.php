<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'product_num',
        'description',
        'image',
        'price',
        'user_id',
        'brand_id',
        'view_count',
        'status',
        'parent',
        'type',
        'metadata',
        'inventory',
        'max_order',
        'seo_title',
        'seo_description',
        'url',
        'seo_status'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function gallery(){
        $this->hasMany(ProductGallery::class);
    }

    public function cart()
    {
        return $this->belongsToMany(Cart::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class)->using(ProductAttributeValues::class)->withPivot(['value_id']);
    }

    public function variations()
    {
        return $this->hasMany(Product::class, 'parent');
    }
}
