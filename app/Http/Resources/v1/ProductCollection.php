<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    public function toArray(Request $request): \Illuminate\Support\Collection
    {
        return $this->collection->map(function ($item){
        return [
            'id' => $item->id,
            'title' => $item->title,
            'price' => $item->price,
            'description' => $item->description,
            'slug'=>$item->slug,
            'product_num'=>$item->product_num,
            'image'=>url($item->image),
            'parent'=>$item->parent,
            'type'=>$item->type,
            'seo_title'=>$item->seo_title,
            'seo_description'=>$item->seo_description,
            'inventory'=>$item->inventory,
            'max_order'=>$item->max_order,
            'url'=>$item->url,
            'seo_status'=>$item->seo_status,
//            'brand'=>new Brand($item->brand->title),
            'brand'=>$item->brand()->get(['title','slug']),
//            'tags'=> new TagCollection($item->tags),
            'tags'=> $item->tags()->get(['title','slug']),
//            'categories'=> new CategoryCollection($item->categories),
            'categories'=> $item->categories()->get(['title','slug']),
        ];
        });
    }
}
