@extends('layouts.page-layout')
@section('title', 'Cart detail')
@section('main')
<form id="cartForm">
    <table>
        <caption>Cart Detail</caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cart as $pro)
            <tr>
                <td>{{$pro['id']}}</td>
                <td>{{$pro['name']}}</td>
                <td>
                    <img src="{{$pro['image']}}" width="100">
                </td>
                <td class="price">${{$pro['price']}}</td>
                <td><input type="number" name="quantity[]" value="{{$pro['quantity']}}" min="1" class="quantity">
                </td>
                <td class="priceSum">${{$pro['quantity'] * $pro['price']}}</td>
                <td>
                    <a href="remove-cart-item/{{$pro['id']}}" class="remove">✘ Delete</a>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="5">Total Price</td>
                <td colspan="2" id="totalPrice">
                    ${{getCartTotalPrice()}}
                </td>
            </tr>
        </tbody>
    </table>
</form>
<section class="checkout">
    <h2>Checkout information</h2>
    <form action='check-out' method="post">
        <div>
            <label>Customer name</label>
            <input type="text" name="customer_name" @isset($customer->name) value="{{$customer->name}}" @endisset>
            @isset($errors['name'])
			<ul class="error">
				@foreach ($errors['name'] as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
			@endisset
        </div>
        <div>
            <label>Phone number</label>
            <input type="text" name="customer_phone_number" @isset($customer->phone_number) value="{{$customer->phone_number}}" @endisset>
            @isset($errors['phone_number'])
			<ul class="error">
				@foreach ($errors['phone_number'] as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
			@endisset
        </div>
        <div>
            <label>Email</label>
            <input type="email" name="email" @isset($customer->email) value="{{$customer->email}}" @endisset>
            @isset($errors['email'])
			<ul class="error">
				@foreach ($errors['email'] as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
			@endisset
        </div>
        <div>
            <label>Address</label>
            <input type="text" name="customer_address" @isset($customer->address) value="{{$customer->address}}" @endisset>
            @isset($errors['address'])
			<ul class="error">
				@foreach ($errors['address'] as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
			@endisset
        </div>
        <div>
            <label>Payment method</label>
            <div>
                @foreach (getPaymentMethod() as $key => $value)
                @php
                $checked = $key == 1 ? "checked" : "";
                @endphp
                <input type="radio" {{$checked}} name="payment_method" value="{{$key}}" placeholder="" id="{{$value}}">
                <label for="{{$value}}">{{$value}}</label>
                @endforeach
            </div>
        </div>
        <div>
            <button type="submit">Checkout</button>
        </div>
    </form>
</section>
<script defer>
    // Confirm deletion
    var remove_items = document.querySelectorAll(".remove");
    remove_items.forEach((remove_item) => {
        remove_item.addEventListener("click", function () {
            var sure = confirm('Bạn có chắc chắn muốn xóa không?');
            if (!sure) {
                event.preventDefault();
            }
        })
    });

    //Ajax update quantity
    window.addEventListener("load", function () {
            function sendData() {
                var XHR = new XMLHttpRequest();

                // Bind the FormData object and the form element
                var FD = new FormData(form);

                // Define what happens on successful data submission
                XHR.addEventListener("load", function (event) {
                    totalPrice.textContent = event.target.responseText;
                });

                // Define what happens in case of error
                XHR.addEventListener("error", function (event) {
                    alert('Oops! Something went wrong.');
                });

                // Set up our request
                XHR.open("POST", "updateQuantity");

                // The data sent is what the user provided in the form
                XHR.send(FD);
            }

            // Access the form element...
            var form = document.getElementById("cartForm");
            var quantity = document.querySelectorAll('.quantity');
            var totalPrice = document.getElementById('totalPrice');
            var priceSum = document.querySelectorAll('.priceSum');
            var price = document.querySelectorAll('.price');
            
            quantity.forEach((element, index) => {
                element.addEventListener("change", function (event) {
                event.preventDefault();
                sendData();
                priceSum[index].textContent = '$'+ element.value * parseInt(price[index].textContent.replace(/\D/g,''));
            });
            });

            // ...and take over its submit event.
            
        });
</script>
@endsection