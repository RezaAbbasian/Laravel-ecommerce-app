<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ShippingCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    public function toArray(Request $request):  \Illuminate\Support\Collection
    {
        return $this->collection->map(function ($item){
            return [
                'id' => $item->id,
                'title' => $item->title,
                'price' => $item->price,
                'description' => $item->description,
            ];
        });
    }
}
