<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.6.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.6.1/js/bootstrap.min.js"></script>
    <title>Laravel</title>
    <style>
        nav ul {
            justify-content: center;
        }
    </style>
</head>
<body>
<div>
    @extends("admin.nav")
    @section("admin.nav")
        @parent
    @endsection
    <br/>
    <br/>
    <br/>
    <br/>
    <div class="text-center">
        <h2>订单列表</h2>
        <table class="table table-bordered table-hover">
            <tr>
                <th>订单号</th>
                <th>总价</th>
                <th>商品详情</th>
                <th>收货信息</th>
                <th>订单状态</th>
                <th>订单备注</th>
                <th>支付方式</th>
                <th>下单时间</th>
            </tr>
            @foreach($orderlist->items() as $order)
                <tr>
                    <td><p>{{$order->ono}}</p></td>
                    <td><p>{{$order->total_amount}}元</p></td>
                    <td>
                        @foreach($order->orderitem as $orderitem)
                            <p>{{$orderitem->product->name}}×{{$orderitem->count}}</p>
                        @endforeach
                    </td>
                    <td>
                        <p>{{$order->oname}}</p>
                        <p>{{$order->ophone}}</p>
                        <p>{{$order->oaddress}}</p>
                    </td>
                    <td>
                        <p>
                            @if($order->status==0)
                                <span style="color: red;">未付款</span>
                            @endif
                            @if($order->status==1)
                                <span style="color: blue;">已付款</span>
                            @endif
                        </p>
                    </td>
                    <td>{{$order->obeizhu}}</td>
                    <td>
                        <p>支付宝</p>
                    </td>
                    <td><p>{{$order->create_time}}</p></td>
                </tr>
            @endforeach
        </table>
    </div>
    <br/>
    {{$orderlist->links()}}
</div>
</body>
</html>
