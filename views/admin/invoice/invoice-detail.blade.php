@extends('layouts.admin-layout')
@section('title', 'Invoice Detail')
@section('style')
<style>
    .sidebar nav ul li:nth-of-type(4) {
        background: white;
        color: #000058;
    }
</style>
@endsection
@section('main')
<h2>Invoice detail</h2>
<ul>
    <li>ID: {{$invoice->id}}</li>
    <li>Customer Name: {{$invoice->customer_name}}</li>
    <li>Customer Phone number: {{$invoice->customer_phone_number}}</li>
    <li>Customer Email: {{$invoice->customer_email}}</li>
    <li>Customer Address: {{$invoice->customer_address}}</li>
    <li>Total price: ${{$invoice->total_price}}</li>
    <li>Payment method: {{getPaymentMethod()[$invoice->payment_method]}}</li>
    <li>Order date: {{date_format($invoice->created_at, "d/m/Y")}}</li>
</ul>
<table>
    <caption>Products</caption>
    <thead>
        <th>Product name</th>
        <th>Image</th>
        <th>Unit price</th>
        <th>Quantity</th>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{$product->product->name}}</td>
            <td><img src="{{$product->product->image}}" alt="" width="100"></td>
            <td>{{$product->unit_price}}</td>
            <td>{{$product->quantity}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<a href="admin/invoice/sendMail/{{$invoice->id}}">Send mail</a>
@endsection