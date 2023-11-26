<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrdersExport;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Imports\OrdersImport;
use App\Models\Order;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders= Order::query();

        if($keyword =  request('search')) {
            $orders->where('status', 'LIKE', "%{$keyword}%")
                ->orWhere('shipping_id', 'LIKE', "%{$keyword}%");
        }
        $orders = $orders->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
//dd($order->status);
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $input = $request->validate([
            'status'=> 'required',
            'tracking_code'=> ''
        ]);
//            dd($input);
        $order->update($input);

        return redirect(route('admin.orders.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }


    public function export()
    {

        return (new OrdersExport('Completed'))->download('orders.xlsx');

    }

    public function importfile(){
        return view('admin.orders.importfile');
    }

    public function import()
    {
            Excel::import(new OrdersImport(), request()->file('file'));
            return redirect('/admin')->with('success', 'All good!');
    }

    public function storeImport(Request $request){

    $import = [
            ['name'=> 'رضا عباسیان',
            'mobile'=> '09124958039',
            'tracking_code'=> '012345678910'],
            ['name'=> 'امین مهدوی',
            'mobile'=> '09331231234',
            'tracking_code'=> '09876543210']
    ];

        return view('admin.orders.imported', compact('import'));
    }



}
