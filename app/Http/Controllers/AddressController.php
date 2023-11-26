<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Models\Address;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd(auth()->user()->addresses()->get());
        return view('address.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('address.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAddressRequest $request)
    {
        $input = $request->validate([
            'title' => '',
            'user_id'=> 'null',
            'state_id'=> '',
            'city_id'=> '',
            'address'=> '',
            'no'=>'',
            'unit'=>'',
            'postal_code'=>'',
            'full_name'=>'',
            'mobile'=>'',
            'lat'=>'',
            'long'=>'',
        ]);
        $user_id = auth()->user()->addresses()->create($input);

//        dd($input);

//        $user_id = auth()->user()->id;
//        $address = Address::create($input);

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        return view('address.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAddressRequest $request, Address $address)
    {
        $input = $request->validate([

        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        $address->delete();
        return redirect()->back();
    }
}
