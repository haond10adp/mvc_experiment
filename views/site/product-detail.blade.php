@extends('layouts.page-layout')
@section('title')
{{$product->name}}
@endsection

@section('main')
<section class="product-detail">
    <img src="{{$product->image}}" alt="">
    <ul>
        <li>
            <h3>
                Product: {{$product->name}}
                @if (isset($_SESSION['user']))
                @if ($_SESSION['user']['role'] == 900)
                <span>
                    <a target="_blank" href="admin/product/edit/{{$product->id}}">Edit</a>
                    @endif
                </span>
                @endif
            </h3>
        </li>
        <li>Price: ${{$product->price}}</li>
        <li>Category: {{$product->cate->cate_name}}</li>
        <p>Description: <span>{{$product->short_desc}}</span></p>
        <li>Star: {{$product->star}}</li>
        <li>Views: {{$product->views}}</li>
    </ul>
</section>
@endsection