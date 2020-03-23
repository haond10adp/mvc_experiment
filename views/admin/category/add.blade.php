@extends('layouts.admin-layout')
@section('title', 'Add Category')
@section('style')
<style>
    .sidebar nav ul li:nth-of-type(2) {
        background: white;
        color: #000058;
    }
</style>
@endsection
@section('main')
<h2>Add a category</h2>
<form action="admin/category/saveAdd" method="post">
    <div>
        <label>ID</label>
        <input name="id" value="auto number" readonly type="text">
    </div>
    <div>
        <label>Category name</label>
        <input name="cate_name" type="text">
    </div>
    <div>
        <label for="show-menu">Show menu</label>
        <input type="checkbox" name="show_menu" value='1' id="show-menu">
    </div>
    <div>
        <label for="slug">Slug</label>
        <input type="text" name="slug" id="slug">
    </div>
    <div class="functions">
        <button type="submit">✔ Save</button>
        <button type="reset">✘ Reset</button>
        <a href="admin/category/list">▤ List</a>
    </div>
</form>
@endsection