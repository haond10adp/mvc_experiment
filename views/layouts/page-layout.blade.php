<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="{{BASE_URL}}">
    <link rel="stylesheet" type="text/css" href="public/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="public/css/layout-site-style.css">
    <title>@yield('title') | OnlinX Shop</title>
</head>

<body>
    <header>
        <h1><a href="">Welcome to OnlinX Shop</a></h1>
        <nav>
            <ul>
                @foreach ($categories as $category)
                <li><a href="category/{{$category->slug}}">{{$category->cate_name}}({{$category->countProducts()}})</a>
                </li>
                @endforeach
                <li><a href="cart-detail">Cart ({{getTotalProductInCart()}})</a></li>
            </ul> 
        </nav>
        <div>
            @if (isset($_SESSION['user']))
            <p>
                Hello, <?= $_SESSION['user']['name'] ?>
                <a href="admin" target="_blank"> ↱ Admin site</a>
            </p>
            <a href="logout">Logout</a>
            @else
            <p><a href="login">Login</a></p>
            @endif
        </div>
    </header>
    <main>
        @yield('main')
    </main>
    <footer>
        <p>Online shopping. All rights reserved</p>
    </footer>
</body>

</html>