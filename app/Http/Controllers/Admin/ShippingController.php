<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shippings = Shipping::all();
        return view('admin.shipping.index', compact('shippings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shipping.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $input = $request->validate(
            [
                'title' => 'required',
                'price' => 'required',
                'days' => 'required',
                'status' => 'required',
                'cities' => 'nullable',
                'description' => 'nullable',
                'parent' => 'nullable',
                ]
        );
        $shipping = Shipping::create($input);
        if ($input['cities'] = null){
            $shipping->cities()->attach($input['cities']);
        }

        return redirect()->route('admin.shipping.index');
//        dd($input);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Shipping $shipping)
    {
        return view('admin.shipping.edit', compact('shipping'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shipping $shipping)
    {
        //
        $input = $request->validate(
            [
                'title' => 'required',
                'price' => 'required',
                'status' => 'required',
                'days' => 'required',
                'description' => 'nullable',
                'cities' => 'nullable',
                'parent' => 'nullable',
            ]
        );
        $shipping->update($input);
        if($input['cities'] = null){
            $shipping->cities()->attach($input['cities']);
        }
        return redirect()->route('admin.shipping.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipping $shipping)
    {
       Shipping::find($shipping->id)->delete();
       return redirect()->back();
    }
}
