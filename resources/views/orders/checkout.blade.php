@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
                {{$order}}
                <form action="{{route('orders.gotobank', compact('order'))}}" method="post">
                    @csrf
                    <button class="btn btn-primary">پرداخت</button>
                </form>

    </div>
</div>
@endsection
