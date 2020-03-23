@extends('layouts.page-layout')
@section('title', 'Homepage')

@section('main')
<section class="product-list">
    @if (isset($category_name))
    <h2>Category: {{$category_name}}</h2>
    @else
    <h2>New Products</h2>
    @endif

    <ul>
        @foreach ($products as $product)
        <li>
            <a href="product/{{$product->id}}">
                <img src="{{$product->image}}" alt="">
            </a>
            <div>
                <a href="product/{{$product->id}}">
                    <h3>{{$product->name}}</h3>
                </a>
                <p>{{number_format($product->price)}}$</p>
                <a class= 'buy' href="cart/{{$product->id}}">Add to cart</a>
            </div>
        </li>
        @endforeach

    </ul>
</section>
@endsection