@extends('layouts.admin-layout')
@section('title', 'Category List')
@section('style')
<style>
    .sidebar nav ul li:nth-of-type(2) {
        background: white;
        color: #000058;
    }
</style>
@endsection
@push('scripts')
<script src="public/js/xshop-list.js" defer></script>
@endpush
@section('main')
<h2>Category Management</h2>
<form action="admin/category/removeMultiple" method="post">
    <table>
        <caption>Category list<a href="admin/category/add">✚ Add</a></caption>
        <thead>
            <tr>
                <th><input type="checkbox" id="btn_checkAll"></th>
                <th>ID</th>
                <th>Category Name</th>
                <th>Show menu</th>
                <th><button id="btn-delete" name="btn_delete" type="submit">✘ Delete checked items</button></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <th><input type="checkbox" name="ids[]" value="{{$category->id}}"></th>
                <td>{{$category->id}}</td>
                <td>{{$category->cate_name}}</td>
                <td>@if ($category->show_menu)
                    ✔
                    @endif
                </td>
                <td>
                    <a href="admin/category/edit/{{$category->id}}">✎ Edit</a>
                    <a href="admin/category/remove/{{$category->id}}" class="remove">✘ Delete</a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</form>
@endsection