<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AddressCollection extends ResourceCollection
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
                'address' => $item->address,
                'no' => $item->no,
                'unit' => $item->unit,
                'city' => $item->city_id,
                'state' => $item->state_id,
                'full_name' => $item->full_name,
                'mobile' => $item->mobile,
                'postal_code' => $item->postal_code,
            ];
        });
    }
}
