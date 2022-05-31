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
</head>
<body>
<div class="container text-center">
    @extends("nav")
    @section("nav")
        @parent
    @endsection
    <br/>
    <br/>
    <br/>
    <br/>
    <h2>确认收货信息</h2>
    <form class="card" action="{{route("order.store")}}" method="post" id="payform">
        <div class="form-group">
            <input type="text" class="form-control" name="oname"
                   value="{{session("user")[0]->name}}" style="padding: 10px;" placeholder="输入收货人"
                   required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="ophone"
                   value="{{session("user")[0]->phone}}" style="padding: 10px;" placeholder="输入收货电话"
                   required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="oaddress"
                   value="{{session("user")[0]->address}}" style="padding: 10px;"
                   placeholder="输入收货地址" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="obeizhu"
                   style="padding: 10px;"
                   placeholder="订单备注">
        </div>
        <br>
        <h2>选择支付方式</h2>
        <h3>支付金额: {{$totalprice}}元</h3>
        <br> <br>
        <div class="row">
            <div class="col-sm-4 ">
                <input type="radio" name="paytype" value="2" required/><img width="150" height="150"
                                                                            src="/storage/images/alipay.jpg"
                                                                            alt="支付宝支付">
            </div>
        </div>
        <div class="text-center">
            <input type="submit" class="btn btn-primary" value="确认订单"> <br/>
        </div>
    </form>
</div>
<br/>
</body>
</html>
