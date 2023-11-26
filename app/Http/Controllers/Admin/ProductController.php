<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products= Product::query();
        if($keyword =  request('search')){
            $products->where('title','LIKE', "%{$keyword}%")
                ->orWhere('id','LIKE',"%{$keyword}%");
        }

        $products = $products->where('parent',0)->latest()->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
//        dd($request->parent);
//        $input['categories'] = [];
        $input = $request->validate([
            'title' => '',
            'status' => 'nullable',
            'seo_description' => 'nullable',
            'seo_title' => 'nullable',
            'description' => 'nullable',
            'price' => 'nullable',
            'slug' => 'nullable',
            'categories' => 'nullable',
            'attributes' => 'nullable',
            'brand_id' => 'nullable',
            'tags' => 'nullable',
            'image' =>'nullable'
        ]);
//        dd($input['categories']);
        $input['product_num'] = "BSP-0".mt_rand(100000000,999999999);
//        if (isset($request->image)) {
//            $imageName = $input['product_num'] . '.' . $request->image->extension();
//            $request->image->move(public_path('images/products'), $imageName);
//            $input['image'] = $imageName;
//        }
        $product= auth()->user()->products()->create($input);
        if (isset($input['categories']) && is_array($input['categories'])){
        $product->categories()->sync($input['categories']);
        }
        if (isset($input['tags']) && is_array($input['tags'])){
            $product->tags()->sync($input['tags']);
        }
        $this->attachAttributesToProduct($product, $input);
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     */
//    public function show(Product $product)
//    {
//        dd($product->title);
//
//        $product = new Product();
//        $product = Product::find($product);
//        return view('admin.products.show', ['product'=>$product]);
//    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $input = $request->validate([
            'title' => 'required',
            'status' => 'nullable',
            'seo_description' => 'nullable',
            'seo_title' => 'nullable',
            'description' => 'nullable',
            'price' => 'nullable',
            'slug' => 'nullable',
            'categories' => 'array',
            'attributes' => 'nullable',
            'brand_id' => 'nullable',
            'image' =>'nullable',
            'tags'=>'nullable'
            ]);

//        if (isset($request->image)) {
////            dd($request);
//            $image = $request->image;
//            $imageName = ($product->product_num.'.'.$image->extension());
//            $image->move('images/products', $imageName, 0777,true);
//
//            //Update Image
//            $input['image'] = $imageName;
//        }

//dd($input['image']);

        $product->update($input);
//        $product->update($input);

        if (isset($input['categories']) && is_array($input['categories'])){
        $product->categories()->sync($input['categories']);
        }else{
            $cat = Category::firstOrCreate(
                ['title' => 'بدون دسته بندی']
            );
            $input['categories'] = [ 0 =>$cat->id ];
            $product->categories()->sync($input['categories']);
        }

        if (isset($input['tags']) && is_array($input['tags'])){
        $product->tags()->sync($input['tags']);
        }

        $product->attributes()->detach();
        $this->attachAttributesToProduct($product, $input);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index');
    }

    public function duplicate(Product $product)
    {
//        $product = Product::find($product->id);
//        dd($product);
        $newproduct = $product->replicate();
        $newproduct->created_at = Carbon::now();
        $newproduct->product_num = "BSP-0".mt_rand(100000000,999999999);
        $newproduct->save();
//        dd($newproduct);
        return redirect()->route('admin.products.index');
    }


    /**
     * @param Product $product
     * @param array $validData
     */
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
