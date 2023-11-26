<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TagCollection extends ResourceCollection
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
                'description' => $item->description,
                'slug'=>$item->slug,
                'image'=>url($item->image),
                'seo_title'=>$item->seo_title,
                'seo_description'=>$item->seo_description,
                'url'=>$item->url,
                'seo_status'=>$item->seo_status,
                'products'=>$item->products,
            ];
        });
    }
}
