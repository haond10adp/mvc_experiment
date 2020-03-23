@extends('layouts.admin-layout')
@section('title', 'Add Product')
@section('style')
<style>
    .sidebar nav ul li:nth-of-type(3) {
        background: white;
        color: #000058;
    }
</style>
@endsection
@push('scripts')
<script src="public/js/previewImage.js" defer></script>
@endpush
@section('main')
<h2>Add a Product</h2>
<form action="admin/product/saveAdd" method="post" enctype="multipart/form-data">
    <div>
        <label>ID</label>
        <input name="id" value="auto number" readonly type="text">
    </div>
    <div>
        <label>Product name</label>
        <input name="name" type="text">
    </div>
    <div>
        <label for="image">Image</label>
        <input type="file" name="image" id="image" onchange="previewImage(event);">
        <img id="output_image" alt="" width="100">
    </div>
    <div>
        <label for="cate_select">Category</label>
        <select name="cate_id" id="cate_select">
            @foreach ($categories as $category)
        <option value="{{$category->id}}">{{$category->cate_name}}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="price">Price</label>
        <input type="number" name="price" id="price" min="0">
    </div>
    <div>
        <label for="short_desc">Short description</label>
        <textarea id="short_desc" name="short_desc" rows="2" cols="70"></textarea>
    </div>
    <div>
        <label for="detail">Detail</label>
        <textarea id="detail" name="detail" rows="5" cols="70"></textarea>
    </div>
    <div class="functions">
        <button type="submit">✔ Save</button>
        <button type="reset">✘ Reset</button>
        <a href="admin/product/list">▤ List</a>
    </div>
</form>
@endsection