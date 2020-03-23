@extends('layouts.admin-layout')
@section('title', 'Dashboard')
@section('style')
<style>
    .sidebar nav ul li:nth-of-type(1) {
        background: white;
        color: #000058;
    }
</style>
@endsection
@section('main')
<h2>Dashboard</h2>
<ul>
    <li>Total product: <span>{{$totalProduct}}</span></li>
    <li>Total category: <span>{{$totalCategory}}</span></li>
    <li>Total user: <span>{{$totalUser}}</span></li>
</ul>
@endsection