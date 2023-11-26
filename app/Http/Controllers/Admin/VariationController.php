<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\Pivot;

class VariationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $product = Product::find(Request()->product);
//        dd($product);
        $variations = Product::query();
        $variations = $variations->where('parent',$product->id)->get();
//        dd($variations);

        return view('admin.variations.index', compact('variations', 'product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $product = Request()->product;
        return view('admin.variations.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {
//        dd($request);


        $input = $request->validate([
            'status' => 'required',
            'price' => 'required',
            'inventory' => 'required',
            'max_order' => 'required',
            'attributes' => '',
            'image' => '',
            'product_num'=> 'null',
            'title'=> 'null',
        ]);

        $input['parent'] = $request->product->id;
        $input['product_num'] = "BSV-0".mt_rand(1000000000,9999999999);
        $input['title'] = $input['product_num'] ;
        $var = auth()->user()->products()->create($input);
        $this->attachAttributesToProduct($var, $input);
//        dd($input);
        return redirect(route('admin.products.variations.index', ['product'=>$product]));
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
    public function edit(Product $product, $variation)
    {
        $variation = $product->find($variation);
//        dd($variation);
        return view('admin.variations.edit', compact('product','variation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Product $product, Request $request, string $id)
    {
        $input = $request->validate([
            'price' => 'required',
            'attributes' => '',
            'inventory' => 'required',
            'max_order' => 'required',
            'status' => 'required'
        ]);
//        dd($request);

        $var = $product->find($id);
        $var->update($input);
        $var->attributes()->detach();
        $this->attachAttributesToProduct($var, $input);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, string $id)
    {
        $product->find($id)->delete();
        return redirect(route('admin.products.variations.index', ['product'=>$product]));
    }

    protected function attachAttributesToProduct(Product $product, array $input): void
    {
//        dd($input['attributes']);
        if (isset($input['attributes']) && is_array($input['attributes'])){
            $attributes = collect($input['attributes']);

            $attributes->each(function ($item) use ($product) {
                if (is_null($item['title']) || is_null($item['value'])) return;

                $attr = Attribute::firstOrCreate(
                    ['title' => $item['title']]
                );

                $attr_value = $attr->values()->firstOrCreate(
                    ['value' => $item['value']]
                );

                $product->attributes()->attach($attr->id, ['value_id' => $attr_value->id]);
            });

        }

    }
}
