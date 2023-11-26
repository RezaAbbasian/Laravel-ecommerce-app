<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ShippingCollection;
use App\Models\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function index(){
        $shippings = Shipping::where('status', 1)->get();
        return new ShippingCollection($shippings);
    }
}
