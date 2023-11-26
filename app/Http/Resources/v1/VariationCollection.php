<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VariationCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return \Illuminate\Support\Collection
     */
    public function toArray(Request $request): \Illuminate\Support\Collection
    {
        return $this->collection->map(function ($item){
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'price' => $item->price,
                    'max_order' => $item->max_order,
                    'attribute' => $item->attributes()->get(['id']),
                ];
            });

    }
}
