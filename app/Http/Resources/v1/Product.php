<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'description' => $this->description,
            'slug'=>$this->slug,
            'product_num'=>$this->product_num,
            'image'=>url($this->image),
            'parent'=>$this->parent,
            'type'=>$this->type,
            'seo_title'=>$this->seo_title,
            'seo_description'=>$this->seo_description,
            'inventory'=>$this->inventory,
            'max_order'=>$this->max_order,
            'url'=>$this->url,
            'seo_status'=>$this->seo_status,
            'brand'=>$this->brand->title ?? '',
            'variations'=> new VariationCollection($this->variations),
            'tags'=> new TagCollection($this->tags),
            'categories'=> new CategoryCollection($this->categories)
        ];
    }
}
