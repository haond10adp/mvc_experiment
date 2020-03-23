@extends('layouts.admin-layout')
@section('title', 'Edit Category')
@section('style')
<style>
    .sidebar nav ul li:nth-of-type(2) {
        background: white;
        color: #000058;
    }
</style>
@endsection
@section('main')
<h2>Edit Category</h2>
<form action="admin/category/saveEdit" method="post">
    <div>
        <label>ID</label>
        <input name="id" value="{{$category->id}}" readonly type="number">
    </div>
    <div>
        <label>Category name</label>
        <input name="cate_name" type="text" value="{{$category->cate_name}}">
    </div>
    <div>
        <label for="show-menu">Show menu</label>
        <input type="checkbox" name="show_menu" value='1' id="show-menu" @if ($category->show_menu == 1)
        checked
        @endif>
    </div>
    <div>
        <label for="slug">Slug</label>
        <input type="text" name="slug" id="slug" value="{{$category->slug}}">
    </div>
    <div class="functions">
        <button type="submit">✔ Save</button>
        <button type="reset">✘ Reset</button>
        <a href="admin/category/add">✚ Add</a>
        <a href="admin/category/list">▤ Danh sách</a>
    </div>
</form>
@endsection