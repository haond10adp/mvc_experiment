<!DOCTYPE html>
<html lang="vn">

<head>
    <base href="{{BASE_URL}}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab&display=swap" rel="stylesheet">
    {{-- @php
    echo '<style>
        ';
include 'public/css/mail.css';
        echo '
    </style>'
    @endphp --}}

</head>

<body>
    <div class="container">
        <header>
            <h2>OnlinxShop.vn</h2>
        </header>
        <main>
            <h2>Yêu cầu đặt hàng đã được tiếp nhận</h2>
            <img src="https://ci3.googleusercontent.com/proxy/ZgXE-2-TOBcRsjnTGWiLWmUvJzHxoK7BpB0g1Hi4HduaCqZRy7R_Ox8v0t1ccZ7WZtjV--8OM1m-9VbrmckQrz85hQ7sUU7PoEIQPEcebmm_T94AoM0c8nm3afA7Gix-cLE4oEPWScInxV7mSyKdvYgtwpyauQ5o1GkWYIJjmW5zgaEKCTvKXR15SbvR=s0-d-e1-ft#http://static.cdn.responsys.net/i5/responsysimages/lazada/contentlibrary/!images/vn_progressbar_2018/vn-progressbar-03.jpg" alt="" width="430">
            <section>
                <h3>{{ucfirst($invoice->customer_name)}} thân mến,</h3>
                <p>
                    Yêu cầu đặt hàng cho đơn hàng #{{$invoice->id}} của bạn đã được tiếp nhận, thời gian đặt hàng là
                    {{rebuild_date('H:i l, d/m/Y', strtotime($invoice->created_at))}} với hình thức thanh toán là
                    <strong>{{getPaymentMethod()[$invoice->payment_method]}}</strong>. Chúng tôi sẽ tiếp tục cập nhật
                    với
                    bạn về trạng thái tiếp theo của đơn hàng.
                </p>
            </section>
            <hr>
            <section>
                <h3>Bước tiếp theo</h3>
                <ul>
                    <li>Bạn vui lòng chuẩn bị sẵn số tiền mặt tương ứng để thuận tiện cho việc thanh toán.</li>
                    <li>Trong một số trường hợp, Lazada sẽ thực hiện cuộc gọi tự động hoặc gửi tin nhắn đến số điện
                        thoại
                        bạn đã đăng ký để xác nhận đơn hàng. Để đơn hàng được xử lý nhanh chóng, bạn vui lòng thực hiện
                        theo
                        hướng dẫn của cuộc gọi hoặc nội dung tin nhắn nhận được. Nếu Lazada không nhận được phản hồi từ
                        bạn,
                        đơn hàng sẽ được ngưng thực hiện do xác nhận không thành công.</li>
                    <li>Trong trường hợp đơn hàng có dịch vụ kèm theo, nhà cung cấp dịch vụ sẽ liên hệ với bạn để xác
                        nhận
                        một số thông tin liên quan đến việc thực hiện dịch vụ (thời gian, địa điểm,...).</li>
                    <li>Bạn không cần phải trả bất kỳ khoản tiền đặt cọc nào. Vui lòng liên hệ chúng tôi tại trang Liên
                        hệ
                        nếu bạn nhận được yêu cầu trả tiền đặt cọc từ Nhà bán hàng.</li>
                </ul>
            </section>
            <hr>
            <section>
                <h3>Đơn hàng được giao đến</h3>
                <div>
                    <div>
                        <p>{{$invoice->customer_name}}</p>
                        <p>{{$invoice->customer_address}}</p>
                    </div>
                    <div>
                        <p>Điện thoại: {{$invoice->customer_phone_number}}</p>
                        <p>Email: {{$invoice->customer_email}}</p>
                    </div>
                </div>
            </section>
            <hr>
            <section>
                <h3>Chi tiết đơn hàng</h3>
                <div>
                    <ul>
                        @foreach ($products as $product)
                        <li>
                            <img src="{{$product->product->image}}" alt="" width="100">
                            <div>
                                <h4><a href="#">{{$product->product->name}}</a></h4>
                                <p>${{$product->unit_price}}</p>
                                <p>Số lượng: {{$product->quantity}}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <p>Tổng cộng: <span>${{$invoice->total_price}}<span></p>
            </section>
        </main>
    </div>

</body>

</html>