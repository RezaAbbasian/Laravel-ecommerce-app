<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status' =>200,'data'=>
        [
        "id"=> $this->id,
        "user_id"=> $this->user_id,
        "address_id"=> $this->address_id,
        "shipping_id"=>$this->shipping_id,
        "tax_rate_id"=>$this->tax_rate_id,
        "shipping_price"=> $this->shipping_price,
        "subtotal"=> $this->subtotal,
        "discount"=> $this->discount,
        "subtotal_less_discount"=> $this->subtotal_less_discount,
        "tax_rate"=> $this->tax_rate,
        "total_tax_rate"=> $this->total_tax_rate,
        "total"=> $this->total,
        "order_num"=> $this->order_num,
        "tracking_code"=> $this->tracking_code,
        "status"=> $this->status,
        "updated_at"=> $this->updated_at,
        "created_at"=> $this->created_at,
        "payment_online"=> url(route('gotobank', ['order'=> $this])),
        "payment_offline"=> url('/offline'),
    ]];
    }
}
