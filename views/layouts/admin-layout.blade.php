<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="{{BASE_URL}}">
    <link rel="stylesheet" type="text/css" href="public/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="public/css/layout-admin-style.css">

    @yield('style')
    @stack('scripts')

    <title>@yield('title') | Admin</title>
</head>

<body>
    <header class="sidebar">
        <h1>Admin site</h1>
        <p>Hello, {{$_SESSION['user']['name']}}!</p>
        <hr>
        @section('sidebar')
        <nav>
            <ul>
                <li>
                    <img src="public/images/page-images/icons8-statistics-96.png" alt=""><a href="admin"></a>
                    <a href="admin">Dashboard</a>
                </li>
                <li>
                    <a href="admin/category/list"><img src="public/images/page-images/icons8-list-96.png" alt=""></a>
                    <a href="admin/category/list">Category</a>
                </li>
                <li>
                    <a href="admin/product/list"><img src="public/images/page-images/icons8-product-96.png" alt=""></a>
                    <a href="admin/product/list">Product</a>
                </li>
                <li>
                    <a href="admin/invoice/list"><img src="public/images/page-images/icons8-invoice-64.png" alt=""></a>
                    <a href="admin/invoice/list">Invoice</a>
                </li>
                {{-- <li>
                    <a href="admin/user/list"><img src="public/images/page-images/icons8-customer-96.png" alt=""></a>
                    <a href="admin/user/list">User</a>
                </li> --}}
                <li>
                    <a href="" target="_blank"><img src="public/images/page-images/icons8-home-96.png" alt=""></a>
                    <a href="" target="_blank">Homepage</a>
                </li>
            </ul>
        </nav>
        @show
    </header>
    <main class="page">
        <div class="main">
            @yield('main')
        </div>
    </main>

    <footer>
        <p>Online shopping. All rights reserved</p>
    </footer>
</body>

</html>