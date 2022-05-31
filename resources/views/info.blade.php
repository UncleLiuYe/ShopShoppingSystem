<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.6.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.6.1/js/bootstrap.min.js"></script>
    <title>商品详情</title>
    <style>
        figure {
            margin: 0;
            padding: 0;
        }

        figure img {
            width: 100%;
            height: 100%;
        }

        .main {
            width: 100%;
            height: 333px;
        }

        .left {
            width: 30%;
            float: left;
        }

        .right {
            width: 70%;
            float: right;
        }
    </style>
    <script>
        function incr() {
            let count = parseInt($("#count").text());
            $("#count").text(count + 1);
        }

        function decr() {
            let count = parseInt($("#count").text());
            if (count === 0) {
                count = 0;
            } else {
                count--;
            }
            $("#count").text(count);
        }
    </script>
</head>

<body>
@extends("nav")
@section("nav")
    @parent
@endsection
<br/>
<div class="container" style="margin-top: 77px;">
    <div class="main">
        <div class="left">
            <img src="/storage/images/{{$product->cover}}" alt="" style="width:100%;height: 100%;">
        </div>
        <div class="right">
            <div style="margin-left: 30px">
                <h2>{{$product->name}}</h2>
                <p>价格：<span style="color: red; font-size: 24px;">{{$product->price}}元</span></p>
                <p>{{$product->short_depiction}}</p>
                购买数量：
                <button style="width: 38px;" class="btn btn-outline-danger" onclick="incr()">+</button>&nbsp;&nbsp;
                <span id="count">0</span>&nbsp;&nbsp;
                <button style="width: 38px;" class="btn btn-outline-danger" onclick="decr()">-</button>
                <br/>
                <br/>
                <a class="btn btn-primary" href="javascript:add({{$product->id}});">加入购物车</a>
                <br/><br/>
                <span class="badge badge-danger">自营</span>
                <span class="badge badge-danger">厂商配送</span>
            </div>
        </div>
    </div>
    <hr/>
    <div class="mt-3">
        {!! $product->depiction !!}
    </div>
</div>
<hr/>
@extends("footer")
@section("footer")
    @parent
@endsection
<script>
    /**
     * 加入购物车
     */
    function add(pid) {
        if ($("#count").text() === "0") {
            alert("数量不能为0!");
        } else {
            $.post("{{route("cart.store")}}", {
                pid: pid,
                num: $("#count").text()
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
    }
</script>
</body>
</html>
