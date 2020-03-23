@extends('layouts.admin-layout')
@section('title', 'Product List')
@section('style')
<style>
    .sidebar nav ul li:nth-of-type(3) {
        background: white;
        color: #000058;
    }
</style>
@endsection
@push('scripts')
<script src="public/js/xshop-list.js" defer></script>
@endpush
@section('main')
<h2>Product Management</h2>
<form action="admin/product/removeMultiple" method="post">
    <table>
        <caption>Product list<a href="admin/product/add">✚ Add</a></caption>
        <thead>
            <tr>
                <th><input type="checkbox" id="btn_checkAll"></th>
                <th>ID</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stars</th>
                <th>Views</th>
                <th><button id="btn-delete" name="btn_delete" type="submit">✘ Delete checked items</button></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <th><input type="checkbox" name="ids[]" value="{{$product->id}}"></th>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->cate->cate_name}}</td>
                <td>${{$product->price}}</td>
                <td>{{$product->star}}★</td>
                <td>{{$product->views}}</td>
                <td>
                    <a href="admin/product/edit/{{$product->id}}">✎ Edit</a>
                    <a href="admin/product/remove/{{$product->id}}" class="remove">✘ Delete</a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</form>
@endsection