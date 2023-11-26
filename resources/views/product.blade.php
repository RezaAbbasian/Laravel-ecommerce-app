@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach(\App\Models\Product::where('parent','0')->get() as $product)
        <div class="card" style="width: 18rem;">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#868e96"></rect>
                <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
            </svg>
            <div class="card-body">
                <h5 class="card-title">{{$product->title}}</h5>
                <p class="card-text">{{$product->description}}</p>
                <form action="{{route('cart.add.item', ['product'=>$product])}}" method="post">
                    @csrf
                    تعداد:<input name="quantity" type="number" min="0" max="10" value="0" min="0" max="{{$product->inventory}}">
                    <button class="btn btn-primary">خرید</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
