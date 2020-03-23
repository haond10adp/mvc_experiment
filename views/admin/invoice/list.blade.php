@extends('layouts.admin-layout')
@section('title', 'Invoice List')
@section('style')
<style>
    .sidebar nav ul li:nth-of-type(4) {
        background: white;
        color: #000058;
    }
</style>
@push('scripts')
<script src="public/js/confirm.js" defer></script>
@endpush
@endsection
@section('main')
<h2>Invoice Management</h2>
<table>
    <caption>Invoices</caption>
    <thead>
        <th>ID</th>
        <th>Customer Name</th>
        <th>Customer Address</th>
        <th>Total price</th>
        <th>Payment method</th>
        <th>Order date</th>
        <th></th>
    </thead>
    <tbody>
        @foreach ($invoices as $invoice)
        <tr>
            <td>{{$invoice->id}}</td>
            <td>{{$invoice->customer_name}}</td>
            <td>{{$invoice->customer_address}}</td>
            <td>${{$invoice->total_price}}</td>
            <td>{{getPaymentMethod()[$invoice->payment_method]}}</td>
            <td>{{date_format($invoice->created_at, "d/m/Y")}}</td>
            <td>
                <a href="admin/invoice/invoice-detail/{{$invoice->id}}">Detail</a>
                <a href="admin/invoice/remove/{{$invoice->id}}" class="remove">✘ Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
