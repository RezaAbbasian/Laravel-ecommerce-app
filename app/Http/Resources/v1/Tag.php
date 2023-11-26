<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Tag extends JsonResource
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
            'description' => $this->description,
            'slug'=>$this->slug,
            'image'=>url($this->image),
            'seo_title'=>$this->seo_title,
            'seo_description'=>$this->seo_description,
            'url'=>$this->url,
            'seo_status'=>$this->seo_status,
            'products'=>$this->products,
        ];
    }
}
