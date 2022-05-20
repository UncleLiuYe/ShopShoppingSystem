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
<div class="container">
    @extends("nav")
    @section("nav")
        @parent
    @endsection
    <br/>
    <div class="container text-center">
        <h2>我的购物车</h2>
        <div class="row row-cols-1 row-cols-4">
            @foreach($cartlist as $cart)
                <div class="col-3" style="margin-top: 30px;">
                    <div class="card border-primary">
                        <a href="{{route("product.show",[$cart->product->id])}}">
                            <img src="/storage/images/{{$cart->product->cover}}" class="card-img-top img-fluid"
                                 width="100%" alt="">
                        </a>
                        <div class="card-body">
                            <h3>
                                <a href="{{route("product.show",[$cart->product->id])}}">{{$cart->product->name}}</a>
                            </h3>
                            <h3>
                                <span>单价: ¥ {{$cart->product->price}}</span>
                            </h3>
                            <h3>
                                <span>数量: {{$cart->num}}</span>
                            </h3>
                        </div>
                    </div>
                    <br/> <a class="btn btn-info" href="javascript:incr({{$cart->product->id}});">增加</a>
                    <a class="btn btn-warning" href="javascript:decr({{$cart->product->id}});">减少</a>
                    <a class="btn btn-danger"
                       href="javascript:var x;x=confirm('确定删除吗?');if(x){deletes({{$cart->id}})}">删除</a>
                </div>
            @endforeach
        </div>
        <hr/>
        <h3>订单总金额: {{$totalprice}}元</h3>
        @if(count($cartlist)>0)
            <a class="btn btn-success btn-lg" href="{{route("order.create")}}">提交订单</a>
        @endif
    </div>
    <br/>
</div>
<script>
    /**
     * 增加
     */
    function incr(pid) {
        $.post("{{route("cart.store")}}", {
            pid: pid,
            type: "incr",
            num: 1,
        }, function (data) {
            if (data === "ok") {
                alert("添加到购物车!");
                window.location.reload();
            } else if (data === "numlesszero") {
                alert("库存不足，请购买其他商品!");
            } else if (data === "fail") {
                alert("网络错误!");
            }
        });
    }

    /**
     * 减少
     */
    function decr(pid) {
        $.post("{{route("cart.store")}}", {
            pid: pid,
            type: "decr",
            num: 1,
        }, function (data) {
            if (data === "ok") {
                alert("操作成功!");
                window.location.reload();
            } else {
                alert("网络错误!");
            }
        });
    }

    /**
     * 删除
     */
    function deletes(id) {
        $.post("./cart/delete/" + id, function (data) {
            if (data === "ok") {
                alert("删除成功!");
                window.location.reload();
            } else {
                alert("网络错误!");
            }
        });
    }
</script>
</body>
</html>
