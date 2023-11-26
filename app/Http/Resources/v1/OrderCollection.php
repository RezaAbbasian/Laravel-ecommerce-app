<?php

namespace App\Http\Resources\v1;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use Morilog\Jalali\Jalalian;

class OrderCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return Collection
     */
    public function toArray(Request $request):  \Illuminate\Support\Collection
    {
        return $this->collection->map(function ($item){
            return [
            "id" => $item->id,
            "user_id" => $item->user_id,
            "address_id" => $item->address_id,
            "shipping_id" => $item->shipping_id,
            "tax_rate_id" => $item->tax_rate_id,
            "shipping_price" => $item->shipping_price,
            "subtotal" => $item->subtotal,
            "discount" => $item->discount,
            "subtotal_less_discount" => $item->subtotal_less_discount,
            "tax_rate" => $item->tax_rate,
            "total_tax_rate" => $item->total_tax_rate,
            "total" => $item->total,
            "order_num" => $item->order_num,
            "tracking_code" => $item->tracking_code,
            "status" => ($item->status),
            "updated_at" => $item->updated_at,
            "created_at" => $item->created_at,
            "payment_online" => url($item->payment_online),
            "payment_offline" => $item->payment_offline,

            ];
        });
    }
}
